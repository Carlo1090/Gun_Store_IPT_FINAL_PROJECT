@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="font-bebas text-3xl tracking-wide text-gray-900">Dashboard</h1>
        <p class="text-xs text-gray-400 mt-1">Overview of your store performance</p>
    </div>

    <a href="{{ route('pdf.dashboard-report') }}"
       class="text-[11px] font-condensed tracking-widest uppercase bg-orange-700 hover:bg-orange-800 text-white px-4 py-2 rounded-lg transition shadow-sm">
        📄 Export Report
    </a>
</div>

{{-- STATS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    {{-- TOTAL ORDERS --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
        <p class="text-[11px] text-gray-400 uppercase tracking-wider">Total Orders</p>
        <h2 class="text-3xl font-bold mt-2 text-gray-900">{{ $totalOrders }}</h2>
    </div>

    {{-- PRODUCTS --}}
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
        <p class="text-[11px] text-gray-400 uppercase tracking-wider">Products</p>
        <h2 class="text-3xl font-bold mt-2 text-gray-900">{{ $totalProducts }}</h2>
    </div>

    {{-- PENDING --}}
    <div class="bg-yellow-50 p-5 rounded-2xl border border-yellow-100 hover:shadow-md transition">
        <p class="text-[11px] text-yellow-600 uppercase tracking-wider">Pending</p>
        <h2 class="text-3xl font-bold mt-2 text-yellow-700">{{ $pendingOrders }}</h2>
    </div>

    {{-- APPROVED --}}
    <div class="bg-green-50 p-5 rounded-2xl border border-green-100 hover:shadow-md transition">
        <p class="text-[11px] text-green-600 uppercase tracking-wider">Approved</p>
        <h2 class="text-3xl font-bold mt-2 text-green-700">{{ $approvedOrders }}</h2>
    </div>

</div>

{{-- SALES + REVENUE --}}
<div class="grid lg:grid-cols-3 gap-6 mt-8">

    {{-- CHART --}}
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold text-gray-800">📊 Monthly Sales</h2>
            <span class="text-xs text-gray-400">This Year</span>
        </div>

        <canvas id="salesChart" height="110"></canvas>

    </div>

    {{-- TOTAL SALES --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-center">

        <p class="text-xs text-gray-400 uppercase tracking-wider">Total Revenue</p>

        <h2 class="text-4xl font-bold text-orange-700 mt-3">
            ₱{{ number_format($totalSales ?? 0, 0) }}
        </h2>

        <p class="text-xs text-gray-400 mt-2">
            Based on approved orders
        </p>

    </div>

</div>

{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const salesData = @json($salesData ?? []);

// Month labels
const labels = [
    'Jan','Feb','Mar','Apr','May','Jun',
    'Jul','Aug','Sep','Oct','Nov','Dec'
];

// Normalize data (important fix)
const data = labels.map((_, i) => {
    return salesData[i + 1] ?? 0;
});

const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            borderColor: '#c2410c',
            backgroundColor: 'rgba(194,65,12,0.08)',
            tension: 0.4,
            fill: true,
            pointRadius: 3,
            pointBackgroundColor: '#c2410c'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f3f4f6'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

@endsection
