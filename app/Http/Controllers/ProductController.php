<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
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

        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto agregado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear producto: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'Error al crear el producto.');
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
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
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

        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'Error al actualizar el producto.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'Error al eliminar el producto.');
        }
    }

    public function shop(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();
        $brands = Brand::all();

        if ($request->has('category') && $request->category != '') {
            $query->where('categories_id', $request->category);
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brands_id', $request->brand);
        }

        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('precio', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('precio', '<=', $request->max_price);
        }

        $products = $query->get()->map(function ($product) {
            $descuento = $product->discount()
                ->where('activo', true)
                ->where('fecha_inicio', '<=', now())
                ->where('fecha_fin', '>=', now())
                ->first();

            if ($descuento) {
                $product->precio_descuento = $product->precio - ($product->precio * ($descuento->valor / 100));
            } else {
                $product->precio_descuento = null;
            }

            return $product;
        });

        $user = Auth::user();
        $favorites = $user ? $user->favorites->pluck('product_id')->toArray() : [];

        return view('shop', compact('products', 'categories', 'brands', 'favorites'));
    }
}
