<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('products.create');
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories_id' => 'required|exists:categories,id',
            'brands_id' => 'required|exists:brands,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulario de edición
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar un producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories_id' => 'required|exists:categories,id',
            'brands_id' => 'required|exists:brands,id',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
