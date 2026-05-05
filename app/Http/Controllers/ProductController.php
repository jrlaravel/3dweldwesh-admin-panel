<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MediaManager;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('image')->get();
        return view('product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        $path = $request->file('image')->store('products','public');

        $media = MediaManager::create([
            'path' => $path,
            'name' => $request->file('image')->getClientOriginalName()
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request-description,
            'image_id' => $media->id
        ]);

        return back()->with('success','Product added');
    }

    public function edit($id)
    {
        return Product::with('image')->findOrFail($id);
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products','public');
            $media = MediaManager::create(['path'=>$path, 'name' => $request->file('image')->getClientOriginalName() ]);
            $product->image_id = $media->id;
        }

        $product->update([
            'name'=>$request->name,
            'description' => $request->description
            ]);

        return back()->with('success','Product updated');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success','Product deleted');
    }
}
