<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->paginate(10);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $categories = Category::all();
        return view('products.create', ['user_id' => $user_id, 'categories' => $categories]);
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
            //'slug' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        /*$product->slug = $request->slug;
        $product->sku = $request->sku;*/
        $product->description = $request->description;
        $product->price = $request->price;
        //$product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect()->route('products.index')->with('success','Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user_id = auth()->user()->id;
        $categories = Category::all();
        return view('products.edit', ['user_id' => $user_id, 'product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            //'slug' => 'required'
        ]);

        $product->name = $request->name;
        /*$product->slug = $request->slug;
        $product->sku = $request->sku;*/
        $product->description = $request->description;
        $product->price = $request->price;
        //$product->sale_price = $request->sale_price;
        $product->category_id = $request->category_id;
        $product->update();
        return redirect()->route('products.index')->with('success','Product added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }

    public function destroy_bulk(Request $request)
    {

        die("123");
        //$ids = explode(",", $id);

        //Product::whereIn('id', $ids)->delete();
        //$product->delete();
        //return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
