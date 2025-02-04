@extends('layouts.app')

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow-sm" style="width: 600px;">
        <div class="img-container" style="height: 400px; overflow: hidden;">
            @if($sale->img)
                <img src="{{ asset('storage/' . $sale->img) }}" class="w-100 h-100" style="object-fit: cover;">
            @else
                <img src="{{ asset('images/default-thumbnail.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Sin imagen">
            @endif
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h5 class="card-title text-center">{{ $sale->product }}</h5>
            <p class="card-text">{{ $sale->description }}</p>
            <ul class="list-unstyled">
                <li><strong>Precio:</strong> ${{ number_format($sale->price, 2) }}</li>
                <li><strong>Categoría:</strong> {{ $sale->category->name }}</li>
                <li><strong>Vendedor:</strong> {{ $sale->user->name }}</li>
            </ul>
            <div class="d-flex justify-content-between">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                @if(!$sale->isSold && Auth::check())
                    @if(Auth::id() !== $sale->user_id)
                        <form action="{{ route('sales.sell', [$sale->id, Auth::id()]) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas marcarlo como vendido?');" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Comprar</button>
                        </form>
                    @else
                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este anuncio?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection