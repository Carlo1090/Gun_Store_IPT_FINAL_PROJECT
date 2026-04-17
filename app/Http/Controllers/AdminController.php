<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function exportDashboardPdf()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $approvedOrders = Order::where('status', 'approved')->count();

        $totalSales = Order::where('status', 'approved')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->selectRaw('SUM(products.price * orders.quantity) as total')
            ->value('total');

        $salesData = Order::where('status', 'approved')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->selectRaw('MONTH(orders.created_at) as month, SUM(products.price * orders.quantity) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $pdf = Pdf::loadView('pdf.dashboard-report', compact(
            'totalOrders',
            'totalProducts',
            'pendingOrders',
            'approvedOrders',
            'totalSales',
            'salesData'
        ));

        return $pdf->stream('dashboard_report.pdf');
    }
}
