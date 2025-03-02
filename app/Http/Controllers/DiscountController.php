<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        try {
            DB::beginTransaction();

            Discount::create($request->all());

            DB::commit();

            return redirect()->route('discounts.index')->with('success', 'Descuento agregado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear descuento: ' . $e->getMessage());
            return redirect()->route('discounts.index')->with('error', 'Error al crear el descuento. Intenta de nuevo.');
        }
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

        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->route('discounts.index')->with('success', 'Descuento actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar descuento: ' . $e->getMessage());
            return redirect()->route('discounts.index')->with('error', 'Error al actualizar el descuento. Intenta de nuevo.');
        }
    }

    public function destroy(Discount $discount)
    {
        try {
            DB::beginTransaction();

            $discount->delete();

            DB::commit();

            return redirect()->route('discounts.index')->with('success', 'Descuento eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar descuento: ' . $e->getMessage());
            return redirect()->route('discounts.index')->with('error', 'Error al eliminar el descuento. Intenta de nuevo.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();

            $discount = Discount::findOrFail($id);
            $discount->activo = !$discount->activo;
            $discount->save();

            DB::commit();

            return redirect()->route('discounts.index')->with('success', 'Estado del descuento actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al cambiar estado del descuento: ' . $e->getMessage());
            return redirect()->route('discounts.index')->with('error', 'Error al cambiar el estado del descuento.');
        }
    }
}
