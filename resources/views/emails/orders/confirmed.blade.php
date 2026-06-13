@component('mail::message')
# Order Confirmed

Hi **{{ $order->user->name }}**,

Thank you for your order! We've received it and it's now being processed.

**Order #{{ $order->id }}**  
**Total:** ${{ number_format($order->total, 2) }}

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
{{ $order->shipping_phone }}

@component('mail::button', ['url' => route('user.order.show', $order)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
