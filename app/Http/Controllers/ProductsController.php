<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products= Product::all();
        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
		$product->Name = $request->input('Name');
        $product->Price = $request->input('Price') ? $request->input('Price') : 0;
        $product->Quantity = $request->input('Quantity') ? $request->input('Quantity') : 0;
        $product->Image =  $request->input('Image') ? $request->input('Image') : "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png";
        $product->Description = $request->input('Description') ? $request->input('Description') : "None";
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //dd($request);
        $product = Product::findOrFail($id);
		$product->Name = $request->input('Name');
        $product->Price = $request->input('Price') ? $request->input('Price') : 0;
        $product->Quantity = $request->input('Quantity') ? $request->input('Quantity') : 0;
        $product->Image =  $request->input('Image') ? $request->input('Image') : "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png";
        $product->Description = $request->input('Description') ? $request->input('Description') : "None";
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
