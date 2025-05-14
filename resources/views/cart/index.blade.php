@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Shopping Cart</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('cart.applyCoupon') }}" class="mb-4">
    @csrf
    <div class="input-group">
      <input type="text" name="code" class="form-control" placeholder="Coupon code" required>
      <button class="btn btn-secondary">Apply Coupon</button>
    </div>
  </form>

  <table class="table">
    <thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr></thead>
    <tbody>
      @foreach($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ $cartItems[$product->id] }}</td>
          <td>{{ number_format($product->price,2) }}</td>
          <td>{{ number_format($product->price * $cartItems[$product->id],2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h4>Order Summary</h4>
  <p>Subtotal: R$ {{ number_format(collect($products)->sum(function($p) use($cartItems){ return $p->price * $cartItems[$p->id]; }),2) }}</p>
  <p>Shipping: R$ {{ number_format($shipping,2) }}</p>
  <p>Total: R$ {{ number_format((collect($products)->sum(function($p) use($cartItems){ return $p->price * $cartItems[$p->id]; }) + $shipping),2) }}</p>

  <form method="POST" action="{{ route('cart.checkout') }}">
    @csrf
    <div class="mb-3">
      <label for="delivery_address" class="form-label">Delivery Address</label>
      <textarea name="delivery_address" id="delivery_address" class="form-control" required>{{ old('delivery_address') }}</textarea>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input name="email" type="email" id="email" class="form-control" required value="{{ old('email') }}">
    </div>
    <button class="btn btn-primary">Place Order</button>
  </form>
</div>
@endsection
