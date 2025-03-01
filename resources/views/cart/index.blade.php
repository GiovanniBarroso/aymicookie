@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-primary text-center fw-bold">🛒 Carrito de Compras</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (empty($cart))
                <div class="alert alert-warning text-center fw-bold py-3">Tu carrito está vacío. 🛍️</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered text-center shadow-sm rounded-3">
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
                                    <td class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" width="50" height="50">
                                        {{ $item['nombre'] }}
                                    </td>
                                    <td class="text-success fw-bold">{{ number_format($item['precio'], 2) }}€</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="updateQuantity({{ $id }}, 'decrease')">-</button>
                                            <span id="quantity-{{ $id }}"
                                                class="px-3">{{ $item['cantidad'] }}</span>
                                            <button class="btn btn-sm btn-outline-success"
                                                onclick="updateQuantity({{ $id }}, 'increase')">+</button>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-primary"><span
                                            id="total-{{ $id }}">{{ number_format($item['precio'] * $item['cantidad'], 2) }}€</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.remove', $id) }}"
                                            class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Dirección de envío -->
                @if (isset($addresses) && count($addresses) > 0)
                    <form action="{{ route('cart.confirm') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <label for="address" class="fw-bold">📍 Selecciona tu Dirección de Envío:</label>
                            <select id="address" name="address" class="form-control">
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->calle ?? 'Dirección sin calle' }},
                                        {{ $address->ciudad ?? 'Ciudad no definida' }},
                                        {{ $address->provincia ?? 'Provincia no definida' }},
                                        {{ $address->codigo_postal ?? 'Código postal no definido' }},
                                        {{ $address->pais ?? 'País no definido' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Confirmar Compra</button>
                    </form>
                @else
                    <p class="text-danger mt-3">No tienes direcciones guardadas. <a href="{{ route('addresses.create') }}"
                            class="fw-bold">Añadir una nueva dirección</a></p>
                @endif

            @endif
        </div>
    </div>

    <script>
        function updateQuantity(id, action) {
            const url = `{{ url('/cart/update') }}/${id}`;
            const quantityElement = document.getElementById(`quantity-${id}`);
            const totalElement = document.getElementById(`total-${id}`);

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
                    body: JSON.stringify({
                        cantidad: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        quantityElement.innerText = newQuantity;
                        totalElement.innerText = (data.new_total).toFixed(2) + '€';
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
