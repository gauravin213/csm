<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
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
            $customers = Customer::orderBy('id', 'DESC')->paginate(10);
        }else{
            $customers = Customer::where('sales_persone_id', $user_id)->orderBy('id', 'DESC')->paginate(10);
        }

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $user_type = auth()->user()->user_type;
        return view('customers.create', ['user_id' => $user_id, 'user_type'=>$user_type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$data = $request->all();
        //echo "<pre>"; print_r($data); echo "</pre>"; die;

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'pan_no' => 'required',
            'aadhar_no' => 'required',
            'gst_no' => 'required',
        ]);


        $customer = new Customer();
        $customer->name = $request->name;
        $customer->company_name = $request->company_name;
        $customer->credit_limit = $request->credit_limit;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->pan_no = $request->pan_no;
        $customer->aadhar_no = $request->aadhar_no;
        $customer->gst_no = $request->gst_no;

        if ($request->profile_image) {
            $profile_image = $request->file('profile_image')->getClientOriginalName();
            $profile_image_path = $request->file('profile_image')->store('uploads');
            $customer->profile_image = $profile_image_path;
        }

        if ($request->pan_no_front_img || $request->pan_no_back_img) {
            $pan_no_front_img = $request->file('pan_no_front_img')->getClientOriginalName();
            $pan_no_front_img_path = $request->file('pan_no_front_img')->store('uploads');
            $pan_no_back_img = $request->file('pan_no_back_img')->getClientOriginalName();
            $pan_no_back_img_path = $request->file('pan_no_back_img')->store('uploads');
            $customer->pan_no_front_img = $pan_no_front_img_path;
            $customer->pan_no_back_img = $pan_no_back_img_path;
        }

        if ($request->aadhar_no_front_img || $request->aadhar_no_back_img) {
            $aadhar_no_front_img = $request->file('aadhar_no_front_img')->getClientOriginalName();
            $aadhar_no_front_img_path = $request->file('aadhar_no_front_img')->store('uploads');
            $aadhar_no_back_img = $request->file('aadhar_no_back_img')->getClientOriginalName();
            $aadhar_no_back_img_path = $request->file('aadhar_no_back_img')->store('uploads');
            $customer->aadhar_no_front_img = $aadhar_no_front_img_path;
            $customer->aadhar_no_back_img = $aadhar_no_back_img_path;
        }

        if ($request->gst_no_front_img || $request->gst_no_back_img || $request->gst_no_third_img) {
            $gst_no_front_img = $request->file('gst_no_front_img')->getClientOriginalName();
            $gst_no_front_img_path = $request->file('gst_no_front_img')->store('uploads');
            $gst_no_back_img = $request->file('gst_no_back_img')->getClientOriginalName();
            $gst_no_back_img_path = $request->file('gst_no_back_img')->store('uploads');
            $gst_no_third_img = $request->file('gst_no_third_img')->getClientOriginalName();
            $gst_no_third_img_path = $request->file('gst_no_third_img')->store('uploads');
            $customer->gst_no_front_img = $gst_no_front_img_path;
            $customer->gst_no_back_img = $gst_no_back_img_path;
            $customer->gst_no_third_img = $gst_no_third_img_path;
        }

        $customer->sales_persone_id = $request->sales_persone_id;
        $customer->save();
        return redirect()->route('customers.index')->with('success','Customer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $user_id = auth()->user()->id;
        $user_type = auth()->user()->user_type;
        return view('customers.edit', ['user_id' => $user_id, 'customer' => $customer, 'user_type'=>$user_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //$fileName = time().'.'.$request->file->extension();  
        //$request->file->move(public_path('uploads'), $fileName);

        //$data = $request->all();
        //echo "<pre>"; print_r($data); echo "</pre>"; die;

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'pan_no' => 'required',
            'aadhar_no' => 'required',
            'gst_no' => 'required',
        ]);
        
        $customer->name = $request->name;
        $customer->company_name = $request->company_name;
        $customer->credit_limit = $request->credit_limit;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->pan_no = $request->pan_no;
        $customer->aadhar_no = $request->aadhar_no;
        $customer->gst_no = $request->gst_no;

        if ($request->profile_image) {
            $profile_image = $request->file('profile_image')->getClientOriginalName();
            $profile_image_path = $request->file('profile_image')->store('uploads');
            $customer->profile_image = $profile_image_path;
        }

        if ($request->pan_no_front_img || $request->pan_no_back_img) {
            $pan_no_front_img = $request->file('pan_no_front_img')->getClientOriginalName();
            $pan_no_front_img_path = $request->file('pan_no_front_img')->store('uploads');
            $pan_no_back_img = $request->file('pan_no_back_img')->getClientOriginalName();
            $pan_no_back_img_path = $request->file('pan_no_back_img')->store('uploads');
            $customer->pan_no_front_img = $pan_no_front_img_path;
            $customer->pan_no_back_img = $pan_no_back_img_path;
        }

        if ($request->aadhar_no_front_img || $request->aadhar_no_back_img) {
            $aadhar_no_front_img = $request->file('aadhar_no_front_img')->getClientOriginalName();
            $aadhar_no_front_img_path = $request->file('aadhar_no_front_img')->store('uploads');
            $aadhar_no_back_img = $request->file('aadhar_no_back_img')->getClientOriginalName();
            $aadhar_no_back_img_path = $request->file('aadhar_no_back_img')->store('uploads');
            $customer->aadhar_no_front_img = $aadhar_no_front_img_path;
            $customer->aadhar_no_back_img = $aadhar_no_back_img_path;
        }

        if ($request->gst_no_front_img || $request->gst_no_back_img || $request->gst_no_third_img) {
            $gst_no_front_img = $request->file('gst_no_front_img')->getClientOriginalName();
            $gst_no_front_img_path = $request->file('gst_no_front_img')->store('uploads');
            $gst_no_back_img = $request->file('gst_no_back_img')->getClientOriginalName();
            $gst_no_back_img_path = $request->file('gst_no_back_img')->store('uploads');
            $gst_no_third_img = $request->file('gst_no_third_img')->getClientOriginalName();
            $gst_no_third_img_path = $request->file('gst_no_third_img')->store('uploads');
            $customer->gst_no_front_img = $gst_no_front_img_path;
            $customer->gst_no_back_img = $gst_no_back_img_path;
            $customer->gst_no_third_img = $gst_no_third_img_path;
        }

        $customer->sales_persone_id = $request->sales_persone_id;
        $customer->update();
        //return redirect()->route('customers.index')->with('success','Customer updated successfully');
        return redirect('admin/customers/'.$customer->id.'/edit')->with('success','Order added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Customer deleted successfully');
    }
}
