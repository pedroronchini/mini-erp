@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Order Placed Successfully!</h1>
  <p>Your order #{{ $order->id }} has been placed.</p>

  <h4>Items:</h4>
  <ul>
    @foreach($order->items as $item)
      <li>{{ $item['name'] }} x {{ $item['quantity'] }} — R$ {{ number_format($item['price'],2) }}</li>
    @endforeach
  </ul>

  <p><strong>Subtotal:</strong> R$ {{ number_format($order->subtotal,2) }}</p>
  <p><strong>Shipping:</strong> R$ {{ number_format($order->shipping,2) }}</p>
  <p><strong>Total:</strong> R$ {{ number_format($order->total,2) }}</p>

  <p>Delivery to: {{ $order->delivery_address }}</p>
</div>
@endsection
