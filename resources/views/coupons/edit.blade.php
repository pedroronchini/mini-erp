@extends('layout')

@section('content')
<h1>Editar Cupom</h1>

@if($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">
    @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
    @endforeach
  </ul></div>
@endif

<form action="{{ route('coupons.update', $coupon) }}" method="POST">
  @csrf
  @method('PUT')
  @include('coupons._form', ['coupon'=>$coupon])
  <button class="btn btn-success">Atualizar</button>
  <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
