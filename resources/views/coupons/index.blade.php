@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Cupons</h1>
  <a href="{{ route('coupons.create') }}" class="btn btn-primary">Novo Cupom</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Código</th>
      <th>Tipo</th>
      <th>Valor</th>
      <th>Subtotal Mínimo</th>
      <th>Expira em</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($coupons as $coupon)
      <tr>
        <td>{{ $coupon->code }}</td>
        <td>{{ ucfirst($coupon->type) }}</td>
        <td>
          @if($coupon->type=='fixed')
            R$ {{ number_format($coupon->value,2,',','.') }}
          @else
            {{ $coupon->value }}%
          @endif
        </td>
        <td>R$ {{ number_format($coupon->min_subtotal,2,',','.') }}</td>
        <td>{{ $coupon->expires_at->format('d/m/Y') }}</td>
        <td>
          <a href="{{ route('coupons.edit',$coupon) }}" class="btn btn-sm btn-warning">Editar</a>
          <form action="{{ route('coupons.destroy',$coupon) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Remover cupom?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Excluir</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
