<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    /**
     * Crear un pago con PayPal.
     */
    public function createPayment(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        if ($total <= 0) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => number_format($total, 2, '.', '')
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('checkout.cancel'),
                "return_url" => route('checkout.success')
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('checkout.cancel')->with('error', 'No se pudo iniciar el pago con PayPal.');
    }





    /**
     * Manejar éxito del pago.
     */
    public function successPayment(Request $request)
    {
        Log::info('✅ Entrando en successPayment()');

        $user = Auth::user();
        if (!$user) {
            Log::error('⛔ Usuario no autenticado.');
            return redirect()->route('cart.index')->with('error', 'No se encontró el usuario después del pago.');
        }

        // 🚨 Evitar pedidos duplicados comprobando si ya existe una orden reciente
        $existingOrder = Order::where('users_id', $user->id)
            ->where('estado', 'Pagado')
            ->where('created_at', '>=', now()->subMinutes(1)) // Evita registrar varias veces en un corto tiempo
            ->latest()
            ->first();

        if ($existingOrder) {
            Log::warning("⚠️ El usuario ya tiene una orden pagada recientemente. No se procesará otra vez.");
            return view('checkout.success', ['order' => $existingOrder, 'success' => 'El pago ya fue procesado.']);
        }

        // 🔹 Recuperar dirección
        $selectedAddressId = session()->pull('selected_address_id');
        if (!$selectedAddressId) {
            Log::warning('⚠️ No se encontró la dirección en la sesión.');
            return redirect()->route('cart.index')->with('error', 'No se ha seleccionado una dirección de envío.');
        }

        // 🔹 Recuperar el carrito
        $cart = session()->pull('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);
        if ($total <= 0) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // 🔥 Guardar la orden en la base de datos
        DB::beginTransaction();
        try {
            $order = Order::create([
                'users_id' => $user->id,
                'addresses_id' => $selectedAddressId,
                'fecha_pedido' => now(),
                'estado' => 'Pagado',
                'total' => $total,
            ]);

            foreach ($cart as $id => $item) {
                $order->products()->attach($id, [
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                ]);
            }

            DB::commit();
            Log::info("✅ Orden guardada en la base de datos. ID del pedido: {$order->id}");

            return view('checkout.success', ['order' => $order, 'success' => 'Pago realizado con éxito.']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("⛔ Error al guardar la orden: " . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'Hubo un error al procesar la orden.');
        }
    }












    /**
     * Manejar cancelación del pago.
     */
    public function cancelPayment()
    {
        return redirect()->route('cart.index')->with('error', 'Pago cancelado.');
    }


    public function showConfirmation(Request $request)
    {
        Log::info("✅ Entrando en showConfirmation()");
        dd("✅ Entrando en showConfirmation()");

        $request->validate([
            'selected_address_id' => 'required|exists:addresses,id',
        ]);

        session(['selected_address_id' => $request->selected_address_id]);

        $selected_address = Auth::user()->addresses->where('id', session('selected_address_id'))->first();

        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return view('checkout.confirm_checkout', compact('selected_address', 'cart', 'total'));
    }









    public function reviewOrder()
    {
        Log::info("✅ Entrando en reviewOrder()");

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('cart.index')->with('error', 'No estás autenticado.');
        }

        // 🔹 Obtener carrito desde la sesión
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // 🔹 Recuperar la dirección seleccionada
        $selected_address_id = session('selected_address_id');
        if (!$selected_address_id) {
            return redirect()->route('cart.index')->with('error', 'No has seleccionado una dirección.');
        }

        $selected_address = $user->addresses->where('id', $selected_address_id)->first();
        if (!$selected_address) {
            return redirect()->route('cart.index')->with('error', 'No se encontró la dirección seleccionada.');
        }

        // 🔹 Calcular los valores del pedido desglosando el IVA
        $subtotal = 0;
        foreach ($cart as $item) {
            $precio_sin_iva = $item['precio'] / 1.21;
            $subtotal += $precio_sin_iva * $item['cantidad'];
        }
        $iva_total = $subtotal * 0.21;
        $total_final = $subtotal + $iva_total;

        // 📌 Pasamos los datos a la vista
        return view('checkout.review', compact('cart', 'selected_address', 'subtotal', 'iva_total', 'total_final'));
    }
}
