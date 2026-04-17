<?php

namespace App\Observers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order)
{
}

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
       if ($order->status === 'approved') {
        $pdf = Pdf::loadView('pdf.orders-report', ['order' => $order]);

        $pdf->save(storage_path('app/public/order_'.$order->id.'.pdf'));
    }

    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
