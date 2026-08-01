<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    
    public function index()
    {
        return Inertia::render('dashboard', [
            'products' => Product::all(),
        ]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        product::create($request->all());
        return redirect()->route('dashboard');
        
    }

    
    public function show(Product $product)
    {
        return Inertia('Products/Show', [
            'product' => $product,
        ]);
        
    }

    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        $product->update($request->all());
        return redirect()->route('dashboard');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard');
    }
}
