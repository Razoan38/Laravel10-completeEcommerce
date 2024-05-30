@component('mail::message')
@component('mail::message')

<p> Dear {{ $order->first_name }},</p>

<p>Order Status : <b>
@if ($order->status == 0)
    pending 
@elseif ($order->status == 1)
    In Progress
@elseif ($order->status == 2)
    Delivered
@elseif ($order->status == 3)
    Completed
@elseif ($order->status == 4)
    Cancelled
@endif
</b>
</p>

<h3>Order Details</h3>

<p>Thank you for your recent purchase with E-Commerce. We are pleased to confirm your order and have attached the invoice for your records.</p>

<div style="margin-bottom: 20px;">
    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Date:</strong> {{ date('d-m-y', strtotime($order->created_at)) }}</p>
</div>

<table style="width: 100%; border-collapse: collapse;">
    <tbody>
        @foreach ($order->getItem as $item)
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                {{ $item->getProduct->title }}<br>
                Color: {{ $item->color_name }}
                @if (!empty($item->size_name))
                <br>
                Size Name: {{ $item->size_name }}<br>
                Size Amount: {{ $item->size_amount }}
                @endif
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->getProduct->quantity }}</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">${{ $item->getProduct->total_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>Shipping Name: {{ $order->getShipping->name }}</p>
<p>Shipping Amount: {{ number_format($order->shipping_amount, 2) }}</p>

@if (!empty($order->discount_code))          
    <p>Discount Code: {{ $order->discount_code }}</p>              
    <p>Discount Amount: {{ number_format($order->discount_amount, 2) }}</p>
@endif              

<p>Total: {{ $order->total_amount }}</p>
<p>Payment Method: {{ $order->payment_method }}</p>

<hr style="border-top: 1px solid #ccc;">
<p style="text-align: center;">Thank you for your order!</p>



Thanks,<br>
{{ config('app.name') }}

@endcomponent