<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Orderitem;
use App\Models\Pricelist;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use DB;
class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_type = auth()->user()->user_type;

        if ($user_type == 'administrator') {
            $customers = Customer::all();
            $users = User::all();
        }else{
            $customers = Customer::where('sales_persone_id', $user_id)->get();
            $users = User::where('id', $user_id)->get();
        }

       
        $args_filter = [];
        if (count($_GET)!=0) {
            foreach ($_GET as $key => $value) {
                if ( !in_array($key, ['page', 'from_date', 'to_date']) ) {
                    if ($value!='') {
                        $args_filter[$key] = $value;
                    }
                }
            }
            if ($user_type != 'administrator') {
                $args_filter['placed_by'] = $user_id;
            }
        }

        if (count($args_filter)!=0) {
            if ( (isset($_GET['from_date']) && $_GET['from_date'] !='') && (isset($_GET['to_date']) && $_GET['to_date'] !='') ) {
                $from_date = date("Y-m-d", strtotime($_GET['from_date']));
                $to_date = date("Y-m-d", strtotime($_GET['to_date']));
                $orders = Order::where($args_filter)->whereBetween('created_at',[$from_date, $to_date])->orderBy('id', 'DESC')->paginate(10);
            }else{
                $orders = Order::where($args_filter)->orderBy('id', 'DESC')->paginate(10);
            }
        }else{
            if ($user_type == 'administrator') {
                $orders = Order::orderBy('id', 'DESC')->paginate(10);
            }else{
                $orders = Order::where('placed_by', $user_id)->orderBy('id', 'DESC')->paginate(10);
            }
        }
        return view('orders.index', ['customers' => $customers, 'users' => $users, 'orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user_id = auth()->user()->id;
        $customers = Customer::where('sales_persone_id', $user_id)->get();
        $products = Product::all();
        return view('orders.create', ['customers' => $customers, 'products' => $products, 'user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $request->validate([
            'payment_status' => 'required',
            'placed_by' => 'required',
            'customer_id' => 'required',
            'iten_data' => 'required'
        ]);

    	$data = $request->all();
    	$iten_data = $request->iten_data;
    	$res = $this->calculate_totals($data);
       /* echo "<pre>"; print_r($data); echo "</pre>";  
        echo "<pre>"; print_r($res); echo "</pre>";  
        die;*/

        //save order
        $order = new Order();
        $order->payment_status  = $res['payment_status'];
        $order->placed_by       = $res['placed_by'];
        $order->customer_id     = $res['customer_id'];
        $order->subtotal        = $res['subtotal'];
        $order->discount        = $res['discount'];
        $order->discount_price  = $res['discount_price'];
        $order->shipping        = $res['shipping'];
        $order->total           = $res['total'];
        $order->save();

        //save order items
        $inserted_order_id = $order->id;
        foreach ($res['iten_data'] as $line_item) {
            $order_item = new Orderitem();
            $order_item->product_id = $line_item['product_id'];
            $order_item->name = Product::find($line_item['product_id'])->name;
            $order_item->price = $line_item['price'];
            $order_item->qty = $line_item['qty'];
            $order_item->line_subtotal = $line_item['line_subtotal'];
            $order_item->order_id = $inserted_order_id;
            $order_item->save();
        }

        //return redirect()->route('orders.index')->with('success','Order added successfully');
        return redirect('admin/orders/'.$inserted_order_id.'/edit')->with('success','Order added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $ord_arr = [];
        $user_id = auth()->user()->id;
        $customers = Customer::where('sales_persone_id', $user_id)->get();
        $products = Product::all();
        $order_items = Orderitem::where('order_id', $order->id)->get();
        return view('orders.edit', ['user_id' => $user_id, 'customers' => $customers, 'order' => $order, 'products' => $products, 'order_items' => $order_items]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {	
        $request->validate([
            'payment_status' => 'required',
            'placed_by' => 'required',
            'customer_id' => 'required',
            'iten_data' => 'required'
        ]);

    	$data = $request->all();
    	//$iten_data = $request->iten_data;
        $res = $this->calculate_totals($data);
    	/*echo "<pre>"; print_r($data); echo "</pre>";
        echo "<pre>"; print_r($res); echo "</pre>";
        die;*/

        //update order items
        foreach ($res['iten_data'] as $line_item) {
            $up_arr = [
                'product_id'    => $line_item['product_id'],
                'name'          => Product::find($line_item['product_id'])->name,
                'price'         => $line_item['price'],
                'qty'           => $line_item['qty'],
                'line_subtotal' => $line_item['line_subtotal'],
                'order_id'      => $order->id
            ];
            Orderitem::where('id',$line_item['id'])->update($up_arr);
        }

        //update order
        $order->payment_status  = $res['payment_status'];
        $order->placed_by       = $res['placed_by'];
        $order->customer_id     = $res['customer_id'];
        $order->subtotal        = $res['subtotal'];
        $order->discount        = $res['discount'];
        $order->discount_price  = $res['discount_price'];
        $order->shipping        = $res['shipping'];
        $order->total           = $res['total'];
        $order->update();

        //return redirect()->route('orders.index')->with('success','Order updated successfully');
        return redirect('admin/orders/'.$order->id.'/edit')->with('success','Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success','Order deleted successfully');
    }

    /*
    * Search item ajax
    */
    public function searchitem(Request $request)
    {   
        $searck_key = $request->searck_key;
        $products = Product::where('name', 'LIKE', "%{$searck_key}%") ->get();
        return response()->json($products);
    }

    /*
    * Add item ajax
    */
    public function additem(Request $request)
    {
        $response = [];
        $iten_data = $request->iten_data;
        $product_ids = [];
        $product_qty = [];
        foreach ($iten_data as $data) {
            if (!empty($data['product_id'])) {
               $product_ids[] = $data['product_id'];
               $product_qty[$data['product_id']] = $data['qty'];
            }
        }
        $products = Product::whereIn('id', $product_ids)->get();
        $main_arr = [];
        $subtotal = 0;
        $total = 0;
        foreach ($products as $key => $product) {
        	$price = $product->price;
        	$qty = $product_qty[$product->id];
        	$line_subtotal = $price * $qty;
            $main_arr['iten_data'][] = [
                'id'    => $key,
                'product_id'  => $product->id,
                'name'  => $product->name,
                'price'  => $price,
                'qty'   => $qty,
                'line_subtotal' => $line_subtotal
            ];
            $subtotal = $subtotal + $line_subtotal;
            $total = $total + $line_subtotal;
        }
        $main_arr['subtotal'] = $subtotal;
        $main_arr['discount'] = 0;
        $main_arr['discount_price'] = 0;
        $main_arr['shipping'] = 0;
        $main_arr['total'] = $total;
        return response()->json($main_arr);
    }

    /*
    * 
    */
    public function calculate_order(Request $request)
    {   
        $data = $request->all();
        $res = $this->calculate_totals($data);
        return response()->json($res);
    }


    /*
    * Calculate order totals
    */
    public function calculate_totals($cart_data) 
    {      
        $subtotal = 0;
        $total = 0;
        foreach ($cart_data['iten_data'] as $key => $items) {

            //set name
            $cart_data['iten_data'][$key]['name'] = Product::find($items['product_id'])->name;

            //Pricelist
            if (!empty($cart_data['price_date'])) {
                 $pricelist = Pricelist::select('*')
                ->where('price_date', '=', $cart_data['price_date'])
                ->where('product_id', '=', $items['product_id'])
                ->get();
                if (count($pricelist) !=0) {
                    $cart_data['iten_data'][$key]['price'] = $pricelist[0]->price;
                    $price = $pricelist[0]->price;
                }else{
                    $org_price = Product::find($items['product_id'])->price;
                    $cart_data['iten_data'][$key]['price'] = $org_price;
                    $price = $org_price;
                }
            }else{
                $org_price = Product::find($items['product_id'])->price;
                $cart_data['iten_data'][$key]['price'] = $org_price;
                $price = $org_price;
            }

            //$price = $items['price'];

            $qty = $items['qty'];

            $line_subtotal = $price * $qty;

            //line subtotal cal
            $cart_data['iten_data'][$key]['line_subtotal'] = $line_subtotal;

            //subtotal cal
            $subtotal = $subtotal + $line_subtotal;
        }
        
        $cart_data['subtotal'] = $subtotal;

        //discount cal
        $discount = $cart_data['discount'];
        if ($discount!=0) {
            $discount_price = $subtotal * $discount / 100;
            $cart_data['discount_price'] = $discount_price;
            $final_price = $subtotal - $discount_price;
            $cart_data['total'] = $final_price + $cart_data['shipping'];
        }else{
            $cart_data['discount'] = 0;
            $cart_data['discount_price'] = 0;
            $cart_data['total'] = $subtotal + $cart_data['shipping'];
        }
       
        $temp = [];
        foreach ($cart_data['iten_data'] as $key => $items) {
           $temp[] = $cart_data['iten_data'][$key];
        }
        $cart_data['iten_data'] = [];
        $cart_data['iten_data'] = $temp;

        //echo "<pre>"; print_r($cart_data); echo "</pre>";  die;
        
        return $cart_data;
    }

    public function get_product_name($product_id)
    {
        $product = Product::find($product_id);
        if (is_object($product)) {
            return $product->name;
        }else{
            return '--';
        }
    }

    public function get_user_name($user_id)
    {
        $user = User::find($user_id);
        if (is_object($user)) {
            return $user->name;
        }else{
            return '--';
        }
        
    }

    public function get_customer_name($customer_id)
    {
        $customer = Customer::find($customer_id);
        if (is_object($customer)) {
            return $customer->name;
        }else{
            return '--';
        }
        
    }

}
