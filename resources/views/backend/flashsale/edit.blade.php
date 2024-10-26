@extends('backend.layouts.master')

@section('main-content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Flash Sale for {{ $product->title }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('flashsale.update', $product->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="flash_sale_discount">Discount(%)</label>
                    <input type="number" class="form-control" name="flash_sale_discount" id="flash_sale_discount"
                        value="{{ $product->flash_sale_discount }}" required>
                </div>

                <div class="form-group">
                    <label for="flash_sale_start">Start Time</label>
                    <input type="datetime-local" class="form-control" name="flash_sale_start" id="flash_sale_start"
                        value="{{ $product->flash_sale_start }}" required>
                </div>

                <div class="form-group">
                    <label for="flash_sale_end">End Time</label>
                    <input type="datetime-local" class="form-control" name="flash_sale_end" id="flash_sale_end"
                        value="{{ $product->flash_sale_end }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Apply Flash Sale</button>
            </form>
        </div>
    </div>
@endsection
