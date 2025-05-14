@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Produtos</h1>

  {{-- Formulário de produto --}}
  <form method="POST" action="{{ route('produtos.store') }}">
    @csrf
    <div class="mb-3">
      <label>Nome</label>
      <input name="nome" class="form-control">
    </div>
    <div class="mb-3">
      <label>Preço</label>
      <input name="preco" type="number" step="0.01" class="form-control">
    </div>
    <div class="mb-3">
      <label>Quantidade</label>
      <input name="quantidade" type="number" class="form-control">
    </div>
    <button class="btn btn-primary">Salvar</button>
  </form>

  {{-- Tabela de produtos --}}
  <table class="table mt-4">
    <thead><tr><th>Nome</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr></thead>
    <tbody>
    @foreach($produtos as $p)
      <tr>
        <td>{{ $p->nome }}</td>
        <td>{{ number_format($p->preco,2,',','.') }}</td>
        <td>{{ $p->estoques->sum('quantidade') }}</td>
        <td>
          <form method="POST" action="{{ route('cart.add',$p->id) }}">
            @csrf
            <button class="btn btn-success btn-sm">Comprar</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection
