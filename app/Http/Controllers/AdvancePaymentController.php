<?php

namespace App\Http\Controllers;

use App\Models\AdvancePayment;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdvancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $customers = Customer::all();
        $advance_payments = AdvancePayment::with('customer')->orderBy('id', 'DESC')->paginate(10);
        //dd($advance_payments);
        return view('advance-payments.index', ['advance_payments' => $advance_payments, 'customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $user_type = $user->user_type;

        if (in_array($user_type, ['administrator'])) {
            $customers = Customer::all();
        }else{
            $customers = Customer::where('sales_persone_id', $user_id)->get();
        }
        return view('advance-payments.create', ['user_id' => $user_id, 'customers' => $customers]);
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
            'customer_id' => 'required',
            'amount' => 'required',
            'mode_of_payment' => 'required'
        ]);

        $AdvancePayment = new AdvancePayment();
        $AdvancePayment->customer_id = $request->customer_id;
        $AdvancePayment->amount = $request->amount;
        $AdvancePayment->mode_of_payment = $request->mode_of_payment;

        if ($request->upload_receipt) {
            $upload_receipt_image = $request->file('upload_receipt')->getClientOriginalName();
            $upload_receipt_image_path = $request->file('upload_receipt')->store('uploads');
            $AdvancePayment->upload_receipt = $upload_receipt_image_path;
        }


        $AdvancePayment->remark = $request->remark;
        $AdvancePayment->save();


        $customer = Customer::find($request->customer_id);
        $total_fund = (is_object($customer)) ? $request->amount + $customer->total_fund : $request->amount;
        //echo "total_fund: ".$total_fund; echo "<br>";
        Customer::where('id',$request->customer_id)->update([
            'total_fund' => $total_fund
        ]);
        //die;

        return redirect()->route('advance-payments.index')->with('success','Payment added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function show(AdvancePayment $advancePayment)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvancePayment $advancePayment)
    {
        $user_id = auth()->user()->id;
        $customers = Customer::all();
        return view('advance-payments.edit', ['user_id' => $user_id, 'advancePayment' => $advancePayment, 'customers' => $customers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvancePayment $advancePayment)
    {
        $request->validate([
            'customer_id' => 'required',
            'amount' => 'required',
            'mode_of_payment' => 'required'
        ]);

        $advancePayment->customer_id = $request->customer_id;
        $advancePayment->amount = $request->amount;
        $AdvancePayment->mode_of_payment = $request->mode_of_payment;
       if ($request->upload_receipt) {
            $upload_receipt_image = $request->file('upload_receipt')->getClientOriginalName();
            $upload_receipt_image_path = $request->file('upload_receipt')->store('uploads');
            $AdvancePayment->upload_receipt = $upload_receipt_image_path;
        }
        $AdvancePayment->remark = $request->remark;
        $advancePayment->update();

        /*$customer = Customer::find($request->customer_id);
        $total_fund = (is_object($customer)) ? $request->amount + $customer->total_fund : $request->amount;
        echo "total_fund: ".$total_fund; echo "<br>";
        Customer::where('id',$request->customer_id)->update([
            'total_fund' => $total_fund
        ]);*/
        //die;

        return redirect()->route('advance-payments.index')->with('success','Payment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvancePayment $advancePayment)
    {
        $advancePayment->delete();
        return redirect()->route('advance-payments.index')->with('success','Payment deleted successfully');
    }

    /*
    * Advance payments
    */
    public function advance_payments(Request $request)
    {   
        $response = ['123'];
       /* $customer_id = $request->customer_id;
        $customer = Customer::find($customer_id);
        $total_fund = (is_object($customer)) ? $customer->total_fund : 0;
        //echo "total_fund: ".$total_fund; echo "<br>";
        $response['total_fund'] = $total_fund;*/
        return response()->json($response);
    }

}
