@extends('layouts.app')

@section('title', 'Anuncios Disponibles')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Anuncios Disponibles</h1>

    <form method="GET" action="{{ route('sales.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las Categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    @if($sales->isEmpty())
        <div class="alert alert-info text-center">No hay anuncios disponibles en este momento.</div>
    @else
        <div class="row justify-content-center">
            @foreach($sales as $sale)
                @if(!$sale->isSold)
                    <div class="col-md-4 my-3">
                        <div class="card">
                            @if($sale->img)
                                <img src="storage/{{$sale->img}}" class="card-img-top" alt="{{ $sale->product }}">
                            @else
                                <img src="{{ asset('images/default-thumbnail.jpg') }}" class="card-img-top" alt="Sin imagen">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $sale->product }}</h5>
                                <p class="card-text">{{ $sale->description }}</p>
                                <p class="card-text">
                                    <strong>Precio:</strong> ${{ number_format($sale->price, 2) }} <br>
                                    <strong>Categoría:</strong> {{ $sale->category->name }} <br>
                                    <strong>Vendedor:</strong> {{ $sale->user->name }} <br>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-ver-mas">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="d-flex justify-content-center pt-3">
            {{ $sales->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection