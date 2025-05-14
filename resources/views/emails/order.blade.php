@component('mail::message')
# Pedido #{{ $order->id }} confirmado

Olá {{ $order->customer_name }},
Seu pedido foi recebido com sucesso.

**Subtotal:** R$ {{ number_format($order->subtotal,2,',','.') }}
**Frete:** R$ {{ number_format($order->shipping_cost,2,',','.') }}
**Total:** R$ {{ number_format($order->total,2,',','.') }}

@component('mail::panel')
Endereço de entrega:
{{ $order->address }}
@endcomponent

Obrigado por comprar conosco!
@endcomponent
