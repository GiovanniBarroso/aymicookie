<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>¡Gracias por tu compra!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #fafafa; padding: 40px; margin: 0;">

    <!-- CABECERA CON LOGO -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="https://i.imgur.com/b29CVt4.png" alt="Ay Mi Cookie" style="width: 150px; margin-bottom: 10px;">
        <h1 style="color: #4caf50; margin: 0;">¡Gracias por tu compra, {{ $order->user->name }}! 🎉</h1>
        <p style="color: #555;">Tu pedido #{{ $order->id }} ha sido recibido y está siendo procesado.</p>
    </div>

    <!-- RESUMEN DEL PEDIDO -->
    <div
        style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h2 style="color: #333; text-align: center;">🧾 Resumen del pedido</h2>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: left;">Producto</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: center;">Cantidad</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: right;">Precio Unitario</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd; text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $product->nombre }}</td>
                        <td style="padding: 10px; text-align: center; border-bottom: 1px solid #eee;">
                            {{ $product->pivot->cantidad }} ud(s)</td>
                        <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">
                            {{ number_format($product->pivot->precio, 2) }} €</td>
                        <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">
                            {{ number_format($product->pivot->cantidad * $product->pivot->precio, 2) }} €
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-size: 20px; text-align: right; margin-top: 20px;">
            <strong>Total pagado: {{ number_format($order->total, 2) }} €</strong>
        </p>

        <!-- BOTÓN -->
        <div style="text-align: center; margin-top: 30px;">
            <a href="https://aymicookie.com/mis-pedidos"
                style="background-color: #ff9800; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 18px; font-weight: bold;">
                📦 Ver mi pedido
            </a>
        </div>

        <p style="text-align: center; margin-top: 20px;">📩 Te enviaremos novedades del envío muy pronto.</p>
    </div>

    <!-- FOOTER -->
    <div style="text-align: center; color: #888; font-size: 14px; margin-top: 40px;">
        <p>Síguenos en nuestras redes sociales:</p>
        <p>
            <a href="https://instagram.com/aymicookie" style="text-decoration: none; margin: 0 10px;">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" alt="Instagram" width="24">
            </a>
            <a href="https://facebook.com/aymicookie" style="text-decoration: none; margin: 0 10px;">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384053.png" alt="Facebook" width="24">
            </a>
            <a href="https://twitter.com/aymicookie" style="text-decoration: none; margin: 0 10px;">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384065.png" alt="Twitter" width="24">
            </a>
        </p>
        <p style="margin-top: 20px;">© {{ date('Y') }} Ay Mi Cookie. Todos los derechos reservados.</p>
    </div>

</body>

</html>
