<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; }
        h1 { text-align: center; }
        .box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1> Sales Report</h1>

<div class="box">
    <p>Total Orders: {{ $totalOrders }}</p>
    <p>Total Products: {{ $totalProducts }}</p>
    <p>Pending Orders: {{ $pendingOrders }}</p>
    <p>Approved Orders: {{ $approvedOrders }}</p>
    <p><strong>Total Sales: (PHP){{ number_format($totalSales, 2) }}</strong></p>
</div>

<h3>Monthly Sales</h3>

<table>
    <thead>
        <tr>
            <th>Month</th>
            <th>Total Sales (PHP)</th>
        </tr>
    </thead>
   <tbody>

@php
$months = [
    1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
    5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',
    9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec'
];
@endphp

@foreach($salesData as $month => $total)
<tr>
    <td>{{ $months[$month] ?? $month }}</td>
    <td>(PHP){{ number_format($total, 2) }}</td>
</tr>
@endforeach

</tbody>
</table>

</body>
</html>
