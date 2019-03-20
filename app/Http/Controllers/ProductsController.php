<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Product;
use App\ProductsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(8);
        return view('products.index', compact('products'));
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
     * @param  StoreProduct $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {


        // Handle Main Image File Upload
        if ($request->hasFile('main_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('main_image')->storeAs('public/images/products/main_image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Product
        $product =  Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'main_image' => $fileNameToStore,
            'description' => $request->get('description')
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                // Get filename with the extension
                $filenameWithExt = $image->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $image->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $image->storeAs('public/images/products/' . $product->id, $fileNameToStore);

                ProductsImage::create([
                    'product_id' => $product->id,
                    'filename' => $fileNameToStore
                ]);

            }

        }

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product', $product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product', $product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProduct $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, Product $product)
    {

        // Handle File Upload
        if ($request->hasFile('main_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('main_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('main_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('main_image')->storeAs('public/images/products/main_image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Update Product
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        if ($request->hasFile('main_image')) {
            $product->main_image = $fileNameToStore;
        }
        $product->description = $request->get('description');

        $product->save();



        return redirect()->route('products.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        if ($product->main_image != 'noimage.jpg') {
            Storage::delete('public/images/products/main_image/' . $product->main_image);
        }
        $product->images()->delete();
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


}
