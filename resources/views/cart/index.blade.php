@extends('layout')

@section('content')
    <div class="container py-4">
        <h1>Seu Carrinho</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (count($cart) === 0)
            <p>Seu carrinho está vazio.</p>
        @else
            {{-- 1) Itens --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Variação</th>
                        <th>Qtd.</th>
                        <th>Preço</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>R$ {{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($item['price'] * $item['qty'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- 2) Subtotal / Frete / Total --}}
            <div class="mb-4">
                <p><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
                <p><strong>Frete:</strong> <span id="shipping-text">R$ {{ number_format($shipping, 2, ',', '.') }}</span></p>
                <p><strong>Total:</strong> <span id="total-text">R$
                        {{ number_format($subtotal + $shipping, 2, ',', '.') }}</span></p>
            </div>

            {{-- 3) Form de cupom --}}
            <form id="coupon-form" action="{{ route('cart.coupon') }}" method="POST" class="mb-4">
                @csrf
                <div class="input-group">
                    <input name="code" type="text" class="form-control" placeholder="Código do cupom">
                    <button class="btn btn-outline-secondary" type="submit">Aplicar Cupom</button>
                </div>
            </form>

            {{-- 4) Validação de CEP via ViaCEP --}}
            <div class="mb-4">
                <label for="cep" class="form-label">Digite seu CEP para calcular entrega:</label>
                <div class="input-group">
                    <input id="cep" type="text" class="form-control" placeholder="00000-000" maxlength="9">
                    <button id="btn-validate-cep" class="btn btn-primary" type="button">Validar CEP</button>
                </div>
                <small class="text-muted">Exemplo: 01001-000</small>
                <div id="address-info" class="mt-2"></div>
            </div>

            {{-- 5) Form de checkout --}}
            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="address" value="">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input name="name" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input name="email" type="email" class="form-control" required>
                </div>
                <button id="btn-checkout" class="btn btn-success" type="submit" disabled>
                    Finalizar Pedido
                </button>
            </form>
        @endif
    </div>
@endsection
