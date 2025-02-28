@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-primary text-center fw-bold">🛒 Carrito de Compras</h1>
            
            @if (empty($cart))
                <div class="alert alert-warning text-center fw-bold py-3">Tu carrito está vacío. ¡Explora nuestros productos y encuentra algo especial! 🛍️</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle shadow-sm rounded-3">
                        <thead class="table-dark">
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
                                    <td class="fw-semibold d-flex align-items-center justify-content-start gap-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['nombre'] }}" class="rounded shadow-sm" width="50" height="50">
                                        {{ $item['nombre'] }}
                                    </td>
                                    <td class="text-success fw-bold">{{ number_format($item['precio'], 2) }}€</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <button class="btn btn-sm btn-outline-danger rounded-circle mx-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;" onclick="updateQuantity({{ $id }}, 'decrease')">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span id="quantity-{{ $id }}" class="fs-5 fw-bold px-3 py-2 border rounded bg-light shadow-sm">{{ $item['cantidad'] }}</span>
                                            <button class="btn btn-sm btn-outline-success rounded-circle mx-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;" onclick="updateQuantity({{ $id }}, 'increase')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-primary"><span id="total-{{ $id }}">{{ number_format($item['precio'] * $item['cantidad'], 2) }}€</span></td>
                                    <td>
                                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg rounded-pill d-flex align-items-center gap-2 shadow-sm">
                        <i class="fas fa-shopping-bag"></i> Seguir Comprando
                    </a>
                    <p class="fw-bold fs-4 mb-0">Total: <span id="grand-total" class="text-success">{{ number_format($total, 2) }}€</span></p>
                    <a href="{{ route('cart.clear') }}" class="btn btn-warning btn-lg rounded-pill d-flex align-items-center gap-2 shadow-sm">
                        <i class="fas fa-trash"></i> Vaciar Carrito
                    </a>
                </div>
            @endif
        </div>
    </div>

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
                    quantityElement.innerText = newQuantity;
                    totalElement.innerText = (data.new_total).toFixed(2) + '€';
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