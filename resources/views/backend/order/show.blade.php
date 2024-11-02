@extends('backend.layouts.master')

@section('title', 'Order Detail')

@section('main-content')
    <div class="card">
        <div class="card-body">
            @if ($order)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Quantity</th>
                            <th>Charge</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ $order->shipping->price }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if ($order->status == 'confirmed')
                                    <span class="badge badge-primary">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.edit', $order->id) }}"
                                    class="btn btn-primary btn-sm float-left mr-1"
                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                    data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('order.destroy', [$order->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }}
                                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                        data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>

                        </tr>
                    </tbody>
                </table>

                <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                        <div class="row">
                            <div class="col-lg-6 col-lx-4">
                                <div class="order-info">
                                    <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                                    <table class="table">
                                        <tr>
                                            <td>Order Number</td>
                                            <td> : {{ $order->order_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Date</td>
                                            <td> : {{ $order->created_at->format('D d M, Y') }} at
                                                {{ $order->created_at->format('g : i a') }} </td>
                                        </tr>
                                        <tr>
                                            <td>Quantity</td>
                                            <td> : {{ $order->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td> : {{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge</td>
                                            <td> : $ {{ number_format($order->shipping->price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Coupon</td>
                                            <td> : $ {{ number_format($order->coupon, 2) }}</td>
                                        </tr>
                                    </table>

                                    <!-- Tambahkan detail produk di sini setelah coupon -->
                                    <h5 class="mt-4 ml-3">Product Details</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->cart as $product)
                                                <!-- Pastikan 'cart' adalah relasi yang tepat -->
                                                <tr>
                                                    <td>{{ $product->size }}</td>
                                                    <td>$ {{ number_format($product->price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table">
                                        <tr>
                                            <td>Total Amount</td>
                                            <td> : $ {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td> : {{ $order->payment_method }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Status</td>
                                            <td> : {{ $order->payment_status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Proof of Payment</td>
                                            <td>
                                                @if ($order->proof_payment)
                                                    <a href="{{ asset('storage/' . $order->proof_payment) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $order->proof_payment) }}"
                                                            alt="Proof of Payment" style="max-width: 200px;">
                                                    </a>
                                                @else
                                                    No proof of payment uploaded.
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6 col-lx-4">
                                <div class="shipping-info">
                                    <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                                    <table class="table">
                                        <tr class="">
                                            <td>Full Name</td>
                                            <td> : {{ $order->first_name }} {{ $order->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td> : {{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone No.</td>
                                            <td> : {{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td> : {{ $order->address1 }}, {{ $order->address2 }}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td> : {{ $order->country }}</td>
                                        </tr>
                                        <tr>
                                            <td>Post Code</td>
                                            <td> : {{ $order->post_code }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }
    </style>
@endpush
