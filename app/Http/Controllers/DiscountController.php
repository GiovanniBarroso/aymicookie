<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('product')->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:discounts,codigo',
            'description' => 'nullable|string',
            'tipo' => 'required|in:global,categoria,producto',
            'valor' => 'required|numeric|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'products_id' => 'nullable|exists:products,id'
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')->with('success', 'Descuento agregado correctamente.');
    }

    public function edit(Discount $discount)
    {
        $products = Product::all();
        return view('admin.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'codigo' => 'required|string|max:50|unique:discounts,codigo,' . $discount->id,
            'description' => 'nullable|string',
            'tipo' => 'required|in:producto,categoria,global',
            'valor' => 'required|numeric|min:1|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'products_id' => 'nullable|exists:products,id'
        ]);

        $discount->update([
            'codigo' => $request->codigo,
            'description' => $request->description,
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'products_id' => $request->products_id,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('discounts.index')->with('success', 'Descuento actualizado correctamente.');
    }


    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Descuento eliminado correctamente.');
    }

    public function toggleStatus($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->activo = !$discount->activo;
        $discount->save();

        return redirect()->route('discounts.index')->with('success', 'Estado del descuento actualizado.');
    }
}
