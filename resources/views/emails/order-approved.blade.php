<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Approved</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<!-- CONTAINER -->
<table width="500" cellpadding="0" cellspacing="0" style="background:#ffffff; margin:40px 0; border-radius:12px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05);">

    <!-- HEADER -->
    <tr>
        <td style="background:#1f2937; padding:20px; text-align:center;">
            <h1 style="margin:0; color:#ffffff; font-size:20px; letter-spacing:1px;">
                🔫 IronRidge Arms
            </h1>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:30px; color:#374151;">

            <h2 style="margin-top:0; color:#111827;">
                Order Approved ✅
            </h2>

            <p style="margin:10px 0;">
                Hello <strong>{{ $order->user->name }}</strong>,
            </p>

            <p style="margin:10px 0;">
                Your order has been successfully approved and is now being processed.
            </p>

            <!-- ORDER DETAILS -->
            <div style="margin:20px 0; padding:15px; background:#f9fafb; border-radius:8px; border:1px solid #e5e7eb;">
                <p style="margin:5px 0;"><strong>Product:</strong> {{ $order->product->name }}</p>
                <p style="margin:5px 0;"><strong>Quantity:</strong> {{ $order->quantity }}</p>
            </div>

            <p style="margin:20px 0;">
                Thank you for choosing <strong>IronRidge Arms</strong>. We appreciate your trust.
            </p>

            <!-- BUTTON -->
            <div style="text-align:center; margin-top:25px;">
                <a href="{{ url('/orders') }}"
                   style="background:#c2410c; color:#ffffff; text-decoration:none; padding:10px 20px; border-radius:6px; font-size:14px;">
                    View My Orders
                </a>
            </div>

        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#9ca3af;">
            © {{ date('Y') }} IronRidge Arms. All rights reserved.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
