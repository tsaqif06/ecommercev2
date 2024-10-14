<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class PaypalController extends Controller
{
    public function payment()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get()->toArray();

        $data = [];
        $data['items'] = array_map(function ($item) {
            $name = Product::where('id', $item['product_id'])->pluck('title')->first();
            return [
                'name' => $name,
                'price' => $item['price'],
                'desc' => 'Thank you for using PayPal',
                'qty' => $item['quantity']
            ];
        }, $cart);

        $data['invoice_id'] = 'ORD-' . strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');

        $total = array_reduce($data['items'], function ($sum, $item) {
            return $sum + ($item['price'] * $item['qty']);
        }, 0);

        $data['total'] = $total;

        if (session('coupon')) {
            $data['shipping_discount'] = session('coupon')['value'];
        }

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function cancel()
    {
        return response()->json(['message' => 'Your payment is canceled. You can create a cancel page here.']);
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success', 'You successfully paid through PayPal! Thank you.');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('home');
        }

        request()->session()->flash('error', 'Something went wrong. Please try again.');
        return redirect()->back();
    }
}
