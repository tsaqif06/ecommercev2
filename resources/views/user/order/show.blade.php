@extends('frontend.layouts.master')

@section('title', 'Order Detail')

@section('main-content')
    <div class="card" style="margin-top: 200px;">
        <h5 class="card-header">Order</h5>
        <div class="card-body">
            @if ($order)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="width: 5px;">Qty</th>
                            <th>Shipping</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
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
                            <td class="currency_convert">{{ $order->shipping->price ?? 0 }}</td>
                            <td class="currency_convert">{{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if ($order->payment_status == 'paid')
                                    <span class="badge badge-primary">{{ $order->payment_status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $order->payment_status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->status == 'confirmed')
                                    <span class="badge badge-success">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.order.delete', [$order->id]) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-custom rounded-circle mx-1"
                                        style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; border: none;"
                                        data-id="{{ $order->id }}" data-toggle="tooltip" data-placement="bottom"
                                        title="Delete">
                                        <i class="fas fa-trash-alt" style="font-size: 14px; color: white;"></i>
                                    </button>
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
                                        <tr class="">
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
                                            @php
                                                $shipping_charge = DB::table('shippings')
                                                    ->where('id', $order->shipping_id)
                                                    ->pluck('price');
                                            @endphp
                                            <td>Shipping Charge</td>
                                            <td> : <span class="currency_convert">${{ $order->shipping->price }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td> : <span
                                                    class="currency_convert">${{ number_format($order->total_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>: Transfer</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Status</td>
                                            <td> : {{ $order->payment_status }}</td>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#footer').addClass('d-none'); // Menyembunyikan footer
        })
    </script>
@endpush
