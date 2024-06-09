<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::withCount('images')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only(['name', 'description', 'price', 'stock_level', 'category_id']));

        // Store Image
        if ($request->file('images')) {
            foreach ($request->images as $image) {
                $file = Storage::disk('public')->put('product', $image);
                $filename = basename($file);
                $url = asset(Storage::url($file));
                $imageable_id = $product->id;
                $imageable_type = "App\Models\Product";

                Image::create([
                    'name' => $filename,
                    'url' => $url,
                    'imageable_id' => $imageable_id,
                    'imageable_type' => $imageable_type
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'You have successfully created a product.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->only(['name', 'description', 'price', 'stock_level', 'category_id']));

        // Delete and update image

        return redirect()->route('product.index')->with('success', 'You have successfully created a product.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'You have successfully deleted a product.');
    }

}
