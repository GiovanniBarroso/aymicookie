<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('fecha_pedido', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['products'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function showUser($id)
    {
        $order = Order::where('id', $id)
            ->where('users_id', auth()->id())
            ->with('address')
            ->firstOrFail();

        return view('profile.show', compact('order'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $address = Address::where('users_id', Auth::id())->first();
        if (!$address) {
            return redirect()->route('cart.index')->with('error', 'Debes configurar una dirección antes de comprar.');
        }

        $voucher = null;
        if ($request->has('voucher_code')) {
            $voucher = Voucher::where('codigo', $request->voucher_code)->first();
        }

        try {
            DB::beginTransaction();

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
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order->id)->with('success', 'Pedido realizado con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar pedido: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Hubo un error al procesar el pedido. Intenta de nuevo.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $order->products()->detach(); // ✅ Importante: eliminar relación con productos
            $order->delete();

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pedido eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar pedido: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'Error al eliminar el pedido. Intenta de nuevo.');
        }
    }

    public function myOrders()
    {
        $orders = Order::where('users_id', auth()->id())->latest()->get();
        return view('profile.orders', compact('orders'));
    }
}
