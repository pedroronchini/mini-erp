<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
     public function handle(Request $request) {
        $order = Orders::find($request->id);
        if (! $order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($request->status === 'canceled') {
            $order->delete();
        } else {
            $order->update(['status' => $request->status]);
        }

        return response()->json(['ok' => true]);
    }
}
