@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container">
        <h1 class="mb-4">Carrito de Compras</h1>

        @if (empty($cart))
            <p>No tienes productos en tu carrito.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr id="cart-item-{{ $id }}">
                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ number_format($item['precio'], 2) }}€</td>
                            <td>
                                <button class="btn btn-sm btn-light" onclick="updateQuantity({{ $id }}, 'decrease')">-</button>
                                <span id="quantity-{{ $id }}">{{ $item['cantidad'] }}</span>
                                <button class="btn btn-sm btn-light" onclick="updateQuantity({{ $id }}, 'increase')">+</button>
                            </td>
                            <td><span id="total-{{ $id }}">{{ number_format($item['precio'] * $item['cantidad'], 2) }}€</span></td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Total: </strong><span id="grand-total">{{ number_format($total, 2) }}€</span></p>

            <a href="{{ route('cart.clear') }}" class="btn btn-warning">Vaciar Carrito</a>
        @endif
    </div>

    <!-- Agregar script para manejar la actualización de la cantidad -->
    <script>
        function updateQuantity(id, action) {
            const url = `{{ url('/cart/update') }}/${id}`;
            const quantityElement = document.getElementById(`quantity-${id}`);
            const totalElement = document.getElementById(`total-${id}`);
            const grandTotalElement = document.getElementById('grand-total');

            let newQuantity = parseInt(quantityElement.innerText);
            if (action === 'increase') {
                newQuantity++;
            } else if (action === 'decrease' && newQuantity > 1) {
                newQuantity--;
            }

            // Enviar la nueva cantidad al servidor via AJAX
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cantidad: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar la cantidad y el total
                    quantityElement.innerText = newQuantity;
                    totalElement.innerText = (data.new_total).toFixed(2) + '€';

                    // Actualizar el total del carrito
                    grandTotalElement.innerText = (data.grand_total).toFixed(2) + '€';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection
