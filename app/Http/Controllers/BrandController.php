<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            Brand::create($request->all());

            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Marca creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear marca: ' . $e->getMessage());
            return redirect()->route('brands.index')->with('error', 'Error al crear la marca. Intenta de nuevo.');
        }
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.show', compact('brand'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $brand = Brand::findOrFail($id);
            $brand->update($request->all());

            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Marca actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar marca: ' . $e->getMessage());
            return redirect()->route('brands.index')->with('error', 'Error al actualizar la marca. Intenta de nuevo.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $brand = Brand::findOrFail($id);
            $brand->delete();

            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Marca eliminada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar marca: ' . $e->getMessage());
            return redirect()->route('brands.index')->with('error', 'Error al eliminar la marca. Intenta de nuevo.');
        }
    }
}
