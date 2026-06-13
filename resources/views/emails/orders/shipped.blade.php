@component('mail::message')
# Order Shipped

Hi **{{ $order->user->name }}**,

Your order **#{{ $order->id }}** is on its way!

**Tracking Number:** MOCK-{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}  
**Carrier:** MockShip Express  
**Estimated Delivery:** {{ now()->addDays(3)->format('F j, Y') }}

@component('mail::table')
| Product | Qty | Price |
|:--------|:---:|------:|
@foreach ($order->items as $item)
| {{ $item->title }} | {{ $item->quantity }} | ${{ number_format($item->total, 2) }} |
@endforeach
@endcomponent

**Shipping to:**  
{{ $order->shipping_name }}  
{{ $order->shipping_address }}

@component('mail::button', ['url' => route('user.order.show', $order)])
Track Your Order
@endcomponent

Thanks for shopping with us!<br>
{{ config('app.name') }}
@endcomponent
