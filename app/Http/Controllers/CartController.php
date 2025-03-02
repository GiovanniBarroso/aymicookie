<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        $addresses = Auth::check() ? Auth::user()->addresses : [];
        Log::info('Direcciones del usuario:', $addresses->toArray());

        return view('cart.index', compact('cart', 'total', 'addresses'));
    }

    public function getCartPreview()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return response()->json([
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($request->product_id);
            $cart = session()->get('cart', []);

            $descuento = $product->discount()
                ->where('activo', true)
                ->where('fecha_inicio', '<=', now())
                ->where('fecha_fin', '>=', now())
                ->first();

            $precio_final = $product->precio;
            if ($descuento) {
                $precio_final -= ($product->precio * ($descuento->valor / 100));
            }

            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id]['cantidad']++;
            } else {
                $cart[$request->product_id] = [
                    'nombre' => $product->nombre,
                    'precio' => $precio_final,
                    'cantidad' => 1,
                    'image' => $product->image
                ];
            }

            session()->put('cart', $cart);

            DB::commit();

            return response()->json([
                'success' => true,
                'cart_count' => count($cart)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar producto al carrito: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al agregar el producto.']);
        }
    }

    public function removeFromCart($id)
    {
        try {
            DB::beginTransaction();

            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar producto del carrito: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Error al eliminar el producto.');
        }
    }

    public function clearCart()
    {
        try {
            DB::beginTransaction();

            session()->forget('cart');

            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al vaciar carrito: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Error al vaciar el carrito.');
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['cantidad'] = $request->cantidad;
                session()->put('cart', $cart);

                $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'new_total' => $cart[$id]['precio'] * $cart[$id]['cantidad'],
                    'grand_total' => $total
                ]);
            }

            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Producto no encontrado en el carrito']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar cantidad en carrito: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al actualizar el producto.']);
        }
    }

    public function confirmPurchase(Request $request)
    {
        $request->validate([
            'address' => 'required|exists:addresses,id'
        ]);

        try {
            DB::beginTransaction();

            session(['selected_address_id' => $request->address]);

            Log::info('Dirección guardada en sesión:', ['selected_address_id' => session('selected_address_id')]);

            DB::commit();

            return redirect()->route('checkout.review');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al confirmar compra: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Error al confirmar la compra.');
        }
    }

    public function reviewCheckout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        $address = session()->get('selected_address_id');

        if (!$address) {
            return redirect()->route('cart.index')->with('error', 'No has seleccionado una dirección de envío.');
        }

        return view('checkout.review', compact('cart', 'total', 'address'));
    }
}
