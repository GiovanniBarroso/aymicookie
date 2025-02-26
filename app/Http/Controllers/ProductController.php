<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.index', compact('products')); // Ajustado para admin
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands')); // Ajustado para admin
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categories_id' => 'required|exists:categories,id',
            'brands_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'nombre' => $request->nombre,
            'description' => $request->description,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categories_id' => $request->categories_id,
            'brands_id' => $request->brands_id,
            'image' => $imagePath
        ]);

        return redirect()->route('products.index')->with('success', 'Producto agregado correctamente');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product')); // Ajustado para admin
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands')); // Ajustado para admin
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categories_id' => 'required|exists:categories,id',
            'brands_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'nombre' => $request->nombre,
            'description' => $request->description,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categories_id' => $request->categories_id,
            'brands_id' => $request->brands_id,
            'image' => $product->image
        ]);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente');
    }



    public function shop()
{
    $products = Product::all(); // Puedes filtrar solo los productos disponibles si quieres
    return view('shop', compact('products'));
}

}
