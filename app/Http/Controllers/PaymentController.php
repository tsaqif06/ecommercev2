<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function setPaymentSession($id)
    {
        session(['id' => $id]); // Set session 'id'
        return redirect()->route('payment'); // Redirect ke route payment
    }


    public function payment()
    {
        if (!session()->get('id') || session()->get('id') == null) {
            return redirect()->route('user.order.index');
        }
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

        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');


        $orderId = session()->get('id');
        // $orderId = 31;

        // Query untuk mengambil data order berdasarkan id
        $order = Order::find($orderId);
        $total = $order->total_amount;

        $data['invoice_id'] = $order->order_number;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['total'] = $total;
        $data['shipping_name'] = $order->shipping->type;
        $data['shipping_price'] = $order->shipping->price;
        $data['no_rekening'] = env('NO_REKENING');

        if (session('coupon')) {
            $data['shipping_discount'] = session('coupon')['value'];
        }
        $data['cart'] = $cart;
        $data['order_id'] = $orderId;

        return view('payment.index', $data);
    }

    public function cancel(Request $request)
    {
        $userId = auth()->user()->id;
        $orderId = $request->input('order_id'); // Perbaiki di sini

        // Cari order berdasarkan orderId
        $order = Order::find($orderId);
        if ($order) {
            // Hapus order jika ditemukan
            $order->delete();
        }

        // Hapus semua item di cart untuk pengguna yang sesuai
        Cart::where('user_id', $userId)->where('order_id', null)->delete();

        return response()->json(['message' => __('main.payment_canceled')]);
    }


    public function success(Request $request)
    {
        // Validasi dan menyimpan bukti pembayaran
        $request->validate([
            'proof_payment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order_id' => 'required', // Pastikan order_id di-validate sesuai kebutuhan Anda
        ]);

        // Simpan bukti pembayaran
        $imagePath = $request->file('proof_payment')->store('proof_payments', 'public');

        // Update order_id di cart untuk pengguna yang sedang login
        Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->update(['order_id' => $request->order_id]);

        // Simpan path bukti pembayaran ke dalam database
        $order = Order::find($request->order_id); // Sesuaikan dengan model yang sesuai
        $order->proof_payment = $imagePath; // Sesuaikan dengan nama kolom yang Anda gunakan
        $order->payment_status = 'paid'; // Mengubah status pembayaran menjadi "paid"
        $order->save();

        // Flash message sukses
        session()->flash('success', __('messages.success_payment'));

        // Hapus data cart dan coupon dari session
        session()->forget('cart');
        session()->forget('coupon');

        // Redirect ke halaman utama
        return redirect()->route('home');
    }
}
