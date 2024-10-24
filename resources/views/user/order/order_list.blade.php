@if ($orders == null)
    <p class="card-text">
        YOULL BE ABLE TO CHECK YOUR ORDERS AND THEIR PROGRESS FROM THIS LIST.
    </p>
@else
    <div class="table-responsive">
        <table class="table table-bordered" id="orders-table" width="100%" cellspacing="0">
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
                @foreach ($orders as $order)
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
                        <td class="text-center d-flex justify-content-center">
                            <a href="{{ route('user.order.show', $order->id) }}"
                                class="btn btn-warning rounded-circle mx-1"
                                style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; background-color: #ffc107; border: none;"
                                data-toggle="tooltip" title="View" data-placement="bottom">
                                <i class="fas fa-eye" style="font-size: 14px; color: white;"></i>
                            </a>

                            <form method="POST" action="{{ route('user.order.delete', [$order->id]) }}" class="d-inline">
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
                @endforeach
            </tbody>
        </table>
    </div>
@endif
