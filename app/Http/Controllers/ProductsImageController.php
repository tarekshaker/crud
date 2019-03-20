<?php

namespace App\Http\Controllers;

use App\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductsImage  $productsImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsImage $productsImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductsImage  $productsImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsImage $productsImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductsImage  $productsImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsImage $productsImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductsImage $productsImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ProductsImage $productsImage)
    {

        if ($productsImage->filename != 'noimage.jpg') {
            Storage::delete('public/images/products/'.$productsImage->product_id.'/' . $productsImage->filename);
        }
        $productsImage->delete();
        return redirect()->back()->with('success', 'Product Image deleted successfully');

    }
}
