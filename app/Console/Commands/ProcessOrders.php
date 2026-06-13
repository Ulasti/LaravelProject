<?php

namespace App\Console\Commands;

use App\Mail\OrderConfirmation;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessOrders extends Command
{
    protected $signature = 'app:process-orders';
    protected $description = 'Progress order statuses and send notifications';

    public function handle(): void
    {
        $this->processPending();
        $this->processProcessing();
    }

    private function processPending(): void
    {
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<=', now()->subMinute())
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'processing']);

            try {
                Mail::to($order->user)->send(new OrderConfirmation($order));
                $this->info("Order #{$order->id}: processing + confirmation email sent");
            } catch (\Exception $e) {
                $this->error("Order #{$order->id}: mail failed - {$e->getMessage()}");
            }
        }
    }

    private function processProcessing(): void
    {
        $orders = Order::where('status', 'processing')
            ->where('updated_at', '<=', now()->subMinutes(30))
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'shipped']);

            try {
                Mail::to($order->user)->send(new OrderShipped($order));
                $this->info("Order #{$order->id}: shipped + shipment email sent");
            } catch (\Exception $e) {
                $this->error("Order #{$order->id}: mail failed - {$e->getMessage()}");
            }
        }
    }
}
