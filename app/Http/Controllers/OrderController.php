<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Jobs\SendOrderEmailJob;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{

public function index(Request $request)
{
    $query = Order::with(['user', 'product']);


    if ($request->search) {
        $query->whereHas('product', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }


    if ($request->status) {
        $query->where('status', $request->status);
    }

    $orders = $query->latest()->get();

    return view('admin.orders.index', compact('orders'));
}

public function exportPdf()
{
    $orders = Order::with(['user', 'product'])->get();

    $pdf = Pdf::loadView('pdf.orders-report', compact('orders'));

    return $pdf->download('orders_report.pdf');
}
public function store(Request $request)
{

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $product = Product::find($request->product_id);


    if ($product->stock < $request->quantity) {
        return back()->with('error', 'Not enough stock');
    }


    $order = Order::create([
        'user_id' => auth()->id(),
        'product_id' => $product->id,
        'quantity' => $request->quantity,
    ]);


    $product->decrement('stock', $request->quantity);



    return back()->with('success', 'Order placed!');
}

public function history()
{
    $orders = \App\Models\Order::with('product')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('orders.history', compact('orders'));
}
public function approve($id)
{
    $order = Order::with('user')->findOrFail($id);

    $order->status = 'approved';
    $order->save();


    SendOrderEmailJob::dispatch($order);

    return back()->with('success', 'Order approved and email sent!');
}
}
