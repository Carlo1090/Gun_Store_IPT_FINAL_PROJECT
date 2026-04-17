<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Users (CUSTOMER)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // ✅ CUSTOMER DASHBOARD (WITH DATA)
    Route::get('/dashboard', function () {

        $userId = auth()->id();

        return view('dashboard', [
            'totalOrders' => Order::where('user_id', $userId)->count(),

            'pendingOrders' => Order::where('user_id', $userId)
                ->where('status', 'pending')
                ->count(),

            'approvedOrders' => Order::where('user_id', $userId)
                ->where('status', 'approved')
                ->count(),

            'totalSpent' => Order::where('user_id', $userId)
                ->where('status', 'approved')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->selectRaw('SUM(products.price * orders.quantity) as total')
                ->value('total'),

            'products' => Product::latest()->take(4)->get(),

            'recentOrders' => Order::with('product')
                ->where('user_id', $userId)
                ->latest()
                ->take(5)
                ->get(),
        ]);

    })->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SHOP
    Route::get('/shop', function () {
        $products = Product::all();
        return view('shop.index', compact('products'));
    });

    // ORDERS (CUSTOMER)
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'history'])->name('orders.history');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // ✅ ADMIN DASHBOARD
    Route::get('/dashboard', function () {

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
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'pendingOrders',
            'approvedOrders',
            'totalSales',
            'salesData'
        ));
    });

    // ✅ NEW: DASHBOARD PDF EXPORT (FIXED)
    Route::get('/dashboard/pdf', function () {

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
            ->pluck('total', 'month');

        $pdf = Pdf::loadView('pdf.dashboard-report', compact(
            'totalOrders',
            'totalProducts',
            'pendingOrders',
            'approvedOrders',
            'totalSales',
            'salesData'
        ));

        return $pdf->download('dashboard_report.pdf');

    })->name('pdf.dashboard-report');

    // PRODUCTS (ADMIN)
    Route::resource('products', ProductController::class);

    // ORDERS (ADMIN)
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');

    Route::post('/orders/{id}/approve', [OrderController::class, 'approve'])
        ->name('admin.orders.approve');

    // PDF EXPORT (ORDERS)
    Route::get('/orders/pdf', [OrderController::class, 'exportPdf'])
        ->name('admin.orders.pdf');
});

require __DIR__.'/auth.php';
