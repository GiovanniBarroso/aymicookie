<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            Category::create($request->all());

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear categoría: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Error al crear la categoría. Intenta de nuevo.');
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update($request->all());

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar categoría: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Error al actualizar la categoría. Intenta de nuevo.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar categoría: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Error al eliminar la categoría. Intenta de nuevo.');
        }
    }
}
