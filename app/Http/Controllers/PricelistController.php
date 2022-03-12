<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use App\Models\Product;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pricelists = Pricelist::orderBy('id', 'DESC')->paginate(10);

        /*$pricelist = Pricelist::select('*')
                ->where('price_date', '=', '03-07-2022')
                ->where('product_id', '=', 26)
                ->get();
        echo "<pre>==>"; print_r($pricelist); echo "</pre>"; */


        return view('pricelists.index', ['pricelists' => $pricelists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $products = Product::all();
        return view('pricelists.create', ['user_id' => $user_id, 'products' => $products]);
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
            'product_id' => 'required',
            'price_date' => 'required'
        ]);

        $pricelist = new Pricelist();
        $pricelist->product_id = $request->product_id;
        $pricelist->price_date = $request->price_date;
        $pricelist->price = $request->price;
        $pricelist->save();
        return redirect()->route('pricelists.index')->with('success','Price added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function show(Pricelist $pricelist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricelist $pricelist)
    {
        $user_id = auth()->user()->id;
        $products = Product::all();
        return view('pricelists.edit', ['user_id' => $user_id, 'pricelist' => $pricelist, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pricelist $pricelist)
    {
        $request->validate([
            'product_id' => 'required',
            'price_date' => 'required'
        ]);

        $pricelist->product_id = $request->product_id;
        $pricelist->price_date = $request->price_date;
        $pricelist->price = $request->price;
        $pricelist->update();
        return redirect()->route('pricelists.index')->with('success','Price updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricelist  $pricelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricelist $pricelist)
    {
        $pricelist->delete();
        return redirect()->route('pricelists.index')->with('success','Price deleted successfully');
    }

    public function get_product_name($product_id)
    {
        $product_name = Product::find($product_id);
        return $product_name->name;
    }
}
