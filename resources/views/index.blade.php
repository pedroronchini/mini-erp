@extends('layout')

@section('content')
    <div class="container py-4">
        <h1>Produtos</h1>
        <form id="product-form" action="{{ route('products.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST" id="form-method">

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input id="product-name" name="name" class="form-control" placeholder="Nome" required>
                </div>
                <div class="col-md-2 mb-3">
                    <input id="product-price" name="price" type="number" step=".01" class="form-control"
                        placeholder="Preço" required>
                </div>
                <div class="col-md-2 mb-3">
                    <input id="product-quantity" name="quantity" type="number" class="form-control" placeholder="Estoque"
                        required>
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" id="form-submit-btn" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{ $product->storages->sum('quantity') }}</td>
                        <td>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="variation" value="default">
                                <button class="btn btn-success btn-sm">Comprar</button>
                            </form>

                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                data-quantity="{{ $product->storages->sum('quantity') }}">
                                Editar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
