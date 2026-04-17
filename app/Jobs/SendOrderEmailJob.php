<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderApprovedMail;


class SendOrderEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $order;

    public function __construct($order)
    {
    $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle()
{
    Mail::to($this->order->user->email)
        ->send(new OrderApprovedMail($this->order));
}
}
