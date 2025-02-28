<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Mostrar el carrito completo
    public function index()
    {
        // Obtener el carrito desde la sesión
        $cart = session()->get('cart', []);

        // Calcular el total
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return view('cart.index', compact('cart', 'total'));
    }

    // Obtener la vista previa del carrito (para el modal)
    public function getCartPreview()
    {
        // Obtener el carrito desde la sesión
        $cart = session()->get('cart', []);

        // Calcular el total
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return response()->json([
            'cart' => $cart, // Asegúrate de que 'cart' tiene los productos correctos
            'total' => $total
        ]);
    }


    // Agregar un producto al carrito
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Verificar si el producto tiene un descuento activo
        $descuento = $product->discount()
            ->where('activo', true) // Solo los descuentos activos
            ->where('fecha_inicio', '<=', now())
            ->where('fecha_fin', '>=', now())
            ->first();

        $precio_final = $product->precio;
        if ($descuento) {
            $precio_final -= ($product->precio * ($descuento->valor / 100));
        }

        // Si el producto ya está en el carrito, incrementamos la cantidad
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['cantidad']++;
        } else {
            // Si no está en el carrito, lo agregamos con cantidad 1
            $cart[$request->product_id] = [
                'nombre' => $product->nombre,
                'precio' => $precio_final,
                'cantidad' => 1,
                'image' => $product->image
            ];
        }

        // Guardamos el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart)
        ]);
    }




    // Eliminar un producto del carrito
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    // Vaciar el carrito
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
    }



    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $request->cantidad;
            session()->put('cart', $cart);

            // Calcular el nuevo total del carrito
            $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

            // Responder con el nuevo total y la cantidad actualizada
            return response()->json([
                'success' => true,
                'new_total' => $cart[$id]['precio'] * $cart[$id]['cantidad'],
                'grand_total' => $total
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Producto no encontrado en el carrito']);
    }
}
