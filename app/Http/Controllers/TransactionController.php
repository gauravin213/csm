<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
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
                if ( !in_array($key, ['page']) ) {
                    if ($value!='') {
                        $args_filter[$key] = $value;
                    }
                }
            }
            if ($user_type != 'administrator') {
                $args_filter['placed_by'] = $user_id;
            }
        }

        //echo "<pre>"; print_r($args_filter); echo "</pre>"; die;

        if (count($args_filter)!=0) {
            unset($args_filter['from_date']);
            unset($args_filter['to_date']);
             //$orders = Order::where($args_filter)->orderBy('id', 'DESC')->get();
            if ( (isset($_GET['from_date']) && $_GET['from_date'] !='') && (isset($_GET['to_date']) && $_GET['to_date'] !='') ) {
                $from_date = date("Y-m-d", strtotime($_GET['from_date']));
                $to_date = date("Y-m-d", strtotime($_GET['to_date']));
                //$orders = Order::where($args_filter)->whereBetween('created_at',[$from_date, $to_date])->orderBy('id', 'DESC')->paginate(10);
                $transactions = Transaction::with(['order', 'customer', 'user'])->where($args_filter)->whereBetween('created_at',[$from_date, $to_date])->orderBy('id', 'DESC')->paginate(10);
            }else{
                //$orders = Order::where($args_filter)->orderBy('id', 'DESC')->paginate(10);
                 $transactions = Transaction::with(['order', 'customer', 'user'])->where($args_filter)->orderBy('id', 'DESC')->paginate(10);
            }
            
        }else{
            if ($user_type == 'administrator') {
                //$orders = Order::orderBy('id', 'DESC')->get();
                 $transactions = Transaction::with(['order', 'customer', 'user'])->orderBy('id', 'DESC')->paginate(10);
            }else{
                //$orders = Order::where('placed_by', $user_id)->orderBy('id', 'DESC')->get();
                $transactions = Transaction::with(['order', 'customer', 'user'])->where('placed_by', $user_id)->orderBy('id', 'DESC')->paginate(10);
            }
        }


       /* $order_ids = [];
        if (count($orders)!=0) {
            foreach ($orders as $order) {
               $order_ids[] = $order->id;
            }
        }
        $transactions = Transaction::with(['order', 'customer', 'user'])->whereIn('order_id', $order_ids)->orderBy('id', 'DESC')->paginate(10);*/

        return view('transactions.index', ['transactions'=>$transactions, 'customers'=>$customers, 'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        return view('transactions.create', ['user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $res = $this->calculate_balance($data);
        //echo "<pre>"; print_r($res); echo "</pre>";  die;

        $request->validate([
            'order_id' => 'required',
            'paid_amount' => 'required'
        ]);

        if ($res['ballance_amount'] < 0) {
            return redirect()->route('transactions.index')->with('warning','All transaction has been completed');
        }

        $transaction = new Transaction();
        $transaction->order_id = $res['order_id'];
        $transaction->customer_id = $res['customer_id'];
        $transaction->placed_by = $res['placed_by'];
        $transaction->paid_amount = $res['paid_amount'];
        $transaction->ballance_amount = $res['ballance_amount'];
        $transaction->save();

        //update balance amount
        Order::where('id',$res['order_id'])->update([
            'balance_amount' => $res['ballance_amount'],
            'payment_status' => ($res['ballance_amount'] > 0 )? 'pending' : 'processing'
        ]);

        return redirect()->route('transactions.index')->with('success','Transaction added successfully');
        //return redirect('admin/orders/'.$res['order_id'].'/edit')->with('success','Payment added successfully');
    }

    public function calculate_balance($data)
    {

        $order = Order::find($data['order_id']);
        $order_total = $order->total;

        $total_paid = $data['paid_amount'];
        $total_ballance_amount = 0;
        $transactions = Transaction::where('order_id', $data['order_id'])->get();
        foreach ($transactions as $transaction) {
            $paid_amount = $transaction->paid_amount;
            $total_paid = $total_paid + $paid_amount;
        }
        //echo "order_total: ".$order_total; echo "<br>";
        //echo "total_paid: ".$total_paid; echo "<br>";

        $total_ballance_amount = $order_total - $total_paid;
        //echo "total_ballance_amount: ".$total_ballance_amount; echo "<br>";
        //die;

        //set balance
        $data['ballance_amount'] = $total_ballance_amount;

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $user_id = auth()->user()->id;
        return view('transactions.edit', ['user_id' => $user_id, 'transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //$data = $request->all();
        
        $request->validate([
            'order_id' => 'required',
            'paid_amount' => 'required'
        ]);

        /*$order = Order::find($request->order_id);
        if (is_object($order)) {
            Customer::where('id',$order->customer_id)->update(['balance_amount' => $request->ballance_amount]);
        }*/

        $transaction->order_id = $request->order_id;
        $transaction->customer_id = $request->customer_id; 
        $transaction->placed_by = $request->placed_by;
        $transaction->paid_amount = $request->paid_amount;
        $transaction->ballance_amount = $request->ballance_amount;
        $transaction->update();
        return redirect()->route('transactions.index')->with('success','Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success','Transaction deleted successfully');
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
