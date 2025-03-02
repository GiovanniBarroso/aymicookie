@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4 p-4">
            <h1 class="mb-4 text-warning text-center fw-bold">
                <i class="fas fa-shopping-cart"></i> Carrito de Compras
            </h1>

            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            @if (empty($cart))
                <div class="alert alert-warning text-center fw-bold py-3">
                    <i class="fas fa-shopping-basket"></i> ¡Tu carrito está vacío!
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover text-center shadow-sm rounded-3">
                        <thead class="table-warning text-dark">
                            <tr class="align-middle">
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalGeneral = 0; @endphp
                            @foreach ($cart as $id => $item)
                                @php $subtotal = $item['precio'] * $item['cantidad']; @endphp
                                @php $totalGeneral += $subtotal; @endphp
                                <tr id="cart-item-{{ $id }}">
                                    <td class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $item['image']) }}" width="50" height="50"
                                            class="rounded shadow-sm">
                                        <span class="fw-bold text-dark">{{ $item['nombre'] }}</span>
                                    </td>
                                    <td class="text-success fw-bold">{{ number_format($item['precio'], 2) }}€</td>
                                    <td>
                                        <div class="input-group input-group-sm justify-content-center">
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="updateQuantity({{ $id }}, 'decrease')">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span id="quantity-{{ $id }}"
                                                class="px-3 fw-bold">{{ $item['cantidad'] }}</span>
                                            <button class="btn btn-outline-success btn-sm"
                                                onclick="updateQuantity({{ $id }}, 'increase')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-primary">
                                        <span id="total-{{ $id }}">
                                            {{ number_format($subtotal, 2) }}€
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.remove', $id) }}"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- 🏡 Dirección de envío -->
                @if (isset($addresses) && count($addresses) > 0)
                    <div class="mt-4 p-3 bg-light rounded shadow-sm">
                        <h5 class="fw-bold text-dark">
                            <i class="fas fa-map-marker-alt text-danger"></i> Dirección de Envío:
                        </h5>
                        <form action="{{ route('cart.confirm') }}" method="POST">
                            @csrf
                            <select id="address" name="address" class="form-control rounded-pill shadow-sm">
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

                            <!-- 📦 Resumen del Pedido -->
                            <div class="mt-4 p-3 bg-white shadow-sm rounded text-center">
                                <h5 class="fw-bold">Resumen del Pedido</h5>
                                <p class="mb-1">Total de Productos: <span class="fw-bold">{{ count($cart) }}</span></p>
                                <p class="fs-4 fw-bold text-success">
                                    Total: {{ number_format($totalGeneral, 2) }}€
                                </p>
                            </div>

                            <!-- 🟢 Confirmar Compra -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-warning fw-bold w-100 py-3 rounded-pill shadow-lg">
                                    <i class="fas fa-check-circle"></i> Confirmar Compra
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="text-danger mt-3 text-center">
                        No tienes direcciones guardadas. 
                        <a href="{{ route('addresses.create') }}" class="fw-bold">Añadir una nueva dirección</a>
                    </p>
                @endif

            @endif
        </div>
    </div>

    <!-- 📜 Script para actualizar cantidad -->
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
