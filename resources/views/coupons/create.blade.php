@extends('layout')

@section('content')
<h1>Novo Cupom</h1>

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('coupons.store') }}" method="POST">
  @csrf
  @include('coupons._form')
  <button class="btn btn-primary">Criar</button>
  <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
