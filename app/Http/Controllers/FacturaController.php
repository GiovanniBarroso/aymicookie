<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class FacturaController extends Controller
{
    public function generarFactura()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('cart.index')->with('error', 'No estás autenticado.');
        }

        // Obtener el último pedido pagado
        $order = Order::where('users_id', $user->id)->where('estado', 'Pagado')->latest()->first();

        if (!$order) {
            return redirect()->route('cart.index')->with('error', 'No se encontró un pedido reciente.');
        }

        // Verificar si el pedido tiene productos
        if ($order->products->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El pedido no tiene productos.');
        }

        // Crear un nuevo objeto TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Ay Mi Cookie');
        $pdf->SetAuthor('Ay Mi Cookie S.L.');
        $pdf->SetTitle('Factura del Pedido');
        $pdf->SetSubject('Factura - Ay Mi Cookie');

        // Configuración de la cabecera del PDF
        $pdf->SetHeaderData('', 0, 'Factura - Ay Mi Cookie', 'Fecha: ' . now()->format('d/m/Y'), [0, 64, 128], [0, 64, 128]);
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->SetMargins(15, 30, 15);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->AddPage();

        // Fuente para el contenido
        $pdf->SetFont('helvetica', 'B', 14);

        // Título de la factura
        $pdf->Cell(0, 10, 'Factura del Pedido', 0, 1, 'C');
        $pdf->Ln(5);

        // Información de la empresa
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Información de la Empresa:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, 'Nombre: Ay Mi Cookie S.L.', 0, 1);
        $pdf->Cell(0, 10, 'Dirección: Calle José León, 123, Sevilla, España', 0, 1);
        $pdf->Cell(0, 10, 'Teléfono: +34 912 345 678', 0, 1);
        $pdf->Cell(0, 10, 'Email: info@aymicookie.com', 0, 1);
        $pdf->Ln(10);

        // Información del cliente
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Información del Cliente:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, 'Nombre: ' . $user->name, 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $user->email, 0, 1);
        $pdf->Cell(0, 10, 'Dirección: ' . $order->address->calle . ', ' . $order->address->ciudad . ', ' . $order->address->codigo_postal, 0, 1);
        $pdf->Ln(10);

        // Detalles del pedido
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Detalles del Pedido', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Ln(5);
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(65, 7, 'Producto', 1, 0, 'C', true);
        $pdf->Cell(30, 7, 'Cantidad', 1, 0, 'C', true);
        $pdf->Cell(30, 7, 'Precio Unitario', 1, 0, 'C', true);
        $pdf->Cell(30, 7, 'Total', 1, 1, 'C', true);

        foreach ($order->products as $product) {
            $pdf->Cell(65, 7, $product->nombre, 1, 0, 'L');
            $pdf->Cell(30, 7, $product->pivot->cantidad, 1, 0, 'C');
            $pdf->Cell(30, 7, number_format($product->pivot->precio, 2) . '€', 1, 0, 'C');
            $pdf->Cell(30, 7, number_format($product->pivot->precio * $product->pivot->cantidad, 2) . '€', 1, 1, 'C');
        }

        $pdf->Ln(5);

        // Método de pago
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(100, 10, 'Método de Pago:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(100, 10, 'Método: Transferencia Bancaria', 0, 1);
        $pdf->Cell(100, 10, 'Banco: Banco Santander', 0, 1);
        $pdf->Cell(100, 10, 'Titular: Ay Mi Cookie S.L.', 0, 1);
        $pdf->Cell(100, 10, 'IBAN: ES52 0410 3525 5519 2040', 0, 1);
        $pdf->Ln(10);

        // Resumen del pedido
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(100, 10, 'Resumen del Pedido:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(100, 10, 'Subtotal: ' . number_format($order->total / 1.21, 2) . '€', 0, 1);
        $pdf->Cell(100, 10, 'IVA (21%): ' . number_format($order->total - ($order->total / 1.21), 2) . '€', 0, 1);
        $pdf->Cell(100, 10, 'Total Final: ' . number_format($order->total, 2) . '€', 0, 1);

        // Pie de página
        $pdf->SetY(-15);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Gracias por confiar en Ay Mi Cookie', 0, 0, 'C');

        // Descargar PDF
        $pdf->Output('factura.pdf', 'D');
    }
}
