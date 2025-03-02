@extends('layouts.app')

@section('title', 'Añadir Producto')

@section('content')

    <div class="container py-5">

        <!-- ENCABEZADO -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-dark">➕ Añadir Nuevo Producto</h1>
            <p class="text-muted">Completa la información para agregar un producto a la tienda.</p>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="card shadow-lg border-0 rounded-4 p-4">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <!-- FORMULARIO -->
                    <div class="col-md-6">
                        @include('admin.products._form')
                    </div>

                    <!-- IMAGEN -->
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="border border-2 border-dashed rounded-4 p-5 text-center text-muted">
                            <i class="fa-solid fa-image fa-3x mb-3"></i>
                            <p class="mb-0">Sin imagen previa disponible</p>
                        </div>
                    </div>

                </div>

                <!-- BOTONES -->
                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('products.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-4 py-2 shadow-sm">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                        <i class="fas fa-save"></i> Guardar Producto
                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection
