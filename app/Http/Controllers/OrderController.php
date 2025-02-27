<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Validar que el usuario tenga una dirección registrada
        $address = Address::where('users_id', Auth::id())->first();
        if (!$address) {
            return redirect()->route('cart.index')->with('error', 'Debes configurar una dirección antes de comprar.');
        }

        // Validar si se aplicó un cupón de descuento
        $voucher = null;
        if ($request->has('voucher_code')) {
            $voucher = Voucher::where('codigo', $request->voucher_code)->first();
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'users_id' => Auth::id(),
                'addresses_id' => $address->id,
                'vouchers_id' => $voucher ? $voucher->id : null,
                'fecha_pedido' => now(),
                'estado' => 'Pendiente',
                'total' => collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']),
            ]);

            foreach ($cart as $id => $item) {
                $order->products()->attach($id, [
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ]);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('orders.show', $order->id)->with('success', 'Pedido realizado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Hubo un error al procesar el pedido.');
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pedido eliminado correctamente.');
    }
}
