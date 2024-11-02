@extends('backend.layouts.master')

@section('title', 'Order Detail')

@section('main-content')
    {{--  <div class="card">
        <h5 class="card-header">Order Edit</h5>
        <div class="card-body">
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    @dd($order->cart)
                    <label for="status">Status :</label>
                    <select name="status" id="" class="form-control">
                        <option value="unconfirmed" {{ $order->status == 'unconfirmed' ? 'selected' : '' }}>Unconfirm
                        </option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>  --}}
    <div class="card">
        <h5 class="card-header">Order Edit</h5>
        <div class="card-body">
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" id="" class="form-control">
                        <option value="unconfirmed" {{ $order->status == 'unconfirmed' ? 'selected' : '' }}>Unconfirm
                        </option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                    </select>
                </div>

                @foreach ($order->cart as $cartItem)
                    @if ($cartItem->variant)
                        <!-- Menyimpan ID varian sebagai input tersembunyi -->
                        <input type="hidden" name="variants[{{ $cartItem->id }}][id]" value="{{ $cartItem->variant->id }}">
                        <input type="hidden" name="variants[{{ $cartItem->id }}][size]" value="{{ $cartItem->size }}">

                        <!-- Input untuk quantity -->
                        <input type="hidden" name="variants[{{ $cartItem->id }}][quantity]"
                            value="{{ $cartItem->quantity }}">
                    @endif
                @endforeach

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
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
