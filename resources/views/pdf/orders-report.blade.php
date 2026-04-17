<!DOCTYPE html>
<html>
<head>
    <title>Order Report</title>
</head>
<body>

<h1>Order #{{ $order->id }}</h1>

<p>User: {{ $order->user->name }}</p>
<p>Product: {{ $order->product->name }}</p>
<p>Quantity: {{ $order->quantity }}</p>
<p>Status: {{ strtoupper($order->status) }}</p>

</body>
</html>
