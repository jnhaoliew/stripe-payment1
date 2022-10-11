<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function stripepost(Request $request){
        if($request->type === 'charge.succeeded'){
            try {
                Payment::create([
                    'stripe_id' => $request->data['object']['id'],
                    'amount' => $request->data['object']['amount'],
                    'email' => $request->data['object']['billing_details']['email'],
                    'name' => $request->data['object']['billing_details']['name'],
                ]);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }
}
