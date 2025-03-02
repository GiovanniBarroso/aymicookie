<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Product::create($request->all());

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear producto: ' . $e->getMessage());
            return redirect()->route('admin.products.index')->with('error', 'Error al crear el producto. Intenta de nuevo.');
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->update($request->all());

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Producto actualizado.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->route('admin.products.index')->with('error', 'Error al actualizar el producto. Intenta de nuevo.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Product::destroy($id);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Producto eliminado.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            return redirect()->route('admin.products.index')->with('error', 'Error al eliminar el producto. Intenta de nuevo.');
        }
    }

    public function indexPanel()
    {
        return view('admin.panel');
    }

    public function indexBrands()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }
}
