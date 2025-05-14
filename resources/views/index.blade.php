@extends('layout')

@section('content')
<div class="container py-4">
  <h1>Produtos</h1>
  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-4 mb-3">
        <input name="name" class="form-control" placeholder="Nome" required>
      </div>
      <div class="col-md-2 mb-3">
        <input name="price" type="number" step=".01" class="form-control" placeholder="Preço" required>
      </div>
      <div class="col-md-2 mb-3">
        <input name="stocks[default]" type="number" class="form-control" placeholder="Estoque" required>
      </div>
      <div class="col-md-2 mb-3">
        <button class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </form>

  <table class="table mt-4">
    <thead><tr><th>Nome</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr></thead>
    <tbody>
      @foreach($products as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td>R$ {{ number_format($p->price,2,',','.') }}</td>
        <td>{{ $p->stocks->sum('quantity') }}</td>
        <td>
          <form action="{{ route('cart.add', $p) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="variation" value="default">
            <button class="btn btn-success btn-sm">Comprar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
