@if ($orders == null)
    <p class="card-text">
        {{ __('main.youll_be_able') }}
    </p>
@else
    <div class="table-responsive">
        <table class="table table-bordered" id="orders-table" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Order No.</th>
                    <th>{{ __('main.name') }}</th>
                    <th>Email</th>
                    <th style="width: 5px;">Qty</th>
                    <th>{{ __('main.shipping') }}</th>
                    <th>{{ __('main.total_amount') }}</th>
                    <th>{{ __('main.payment_status') }}</th>
                    <th>Status</th>
                    <th>{{ __('main.action') }}</th>
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
                            @if ($order->payment_status != 'paid')
                                <a href="{{ route('set.payment.session', ['id' => $order->id]) }}"
                                    class="btn btn-primary rounded-circle mx-1"
                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; background-color: #007bff; border: none;"
                                    data-toggle="tooltip" title="{{ __('main.pay') }}" data-placement="bottom"
                                    target="_blank">
                                    <i class="fas fa-credit-card" style="font-size: 14px; color: white;"></i>
                                </a>
                            @endif

                            <a href="{{ route('user.order.show', $order->id) }}"
                                class="btn btn-warning rounded-circle mx-1"
                                style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; background-color: #ffc107; border: none;"
                                data-toggle="tooltip" title="{{ __('main.view') }}" data-placement="bottom">
                                <i class="fas fa-eye" style="font-size: 14px; color: white;"></i>
                            </a>

                            <form method="POST" action="{{ route('user.order.delete', [$order->id]) }}"
                                class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-custom rounded-circle mx-1"
                                    style="width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; border: none;"
                                    data-id="{{ $order->id }}" data-toggle="tooltip" data-placement="bottom"
                                    title="{{ __('main.delete') }}">
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
