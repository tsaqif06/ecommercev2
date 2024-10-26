@extends('frontend.layouts.master')

@section('title', 'Darcey || PAYMENT')

@section('main-content')
    <div class="container" style="margin: 150px 0 50px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('main.payment_details') }} {{ $invoice_id }}</div>

                    <div class="card-body">
                        <h5>{{ __('main.order_summary') }}</h5>
                        <ul class="list-group mb-3">
                            @foreach ($items as $item)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $item['qty'] }}</small>
                                    </div>
                                    <span class="text-muted currency_convert">{{ $item['price'] }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ __('main.shipping_type') }} : </h6>
                                    <small class="text-muted">{{ $shipping_name }}</small>
                                </div>
                                <span class="text-muted currency_convert">{{ $shipping_price }}</span>
                            </li>
                            @if (isset($shipping_discount))
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ __('main.coupon_discount') }}</span>
                                    <span class="text-success currency_convert">{{ $shipping_discount }}</span>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total</span>
                                <strong class="currency_convert">{{ $total }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ __('main.account_number') }}</span>
                                <strong>{{ $no_rekening }}</strong>
                            </li>
                        </ul>
                        <form id="payment-form" action="{{ route('payment.success') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $order_id }}" id="order_id" name="order_id">
                            <div class="form-group">
                                <label for="proof_payment"
                                    style="cursor: pointer">{{ __('main.upload_proof_payment') }}:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="proof_payment" name="proof_payment"
                                        accept="image/*" capture="camera" onchange="previewImage(this)">
                                    <label class="custom-file-label" for="proof_payment"
                                        style="cursor: pointer">{{ __('main.choose_file') }}</label>
                                </div>
                                @error('proof_payment')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <img id="img-preview" src="#" alt="Preview Gambar"
                                    style="max-width: 100%; height: auto; display: none;">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>
                                <button type="button" class="btn btn-secondary"
                                    id="cancel-button">{{ __('main.cancel') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function previewImage(input) {
            var preview = document.getElementById('img-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block'; // Menampilkan gambar setelah diunggah
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.style.display = 'none'; // Menyembunyikan gambar jika file dihapus
            }
        }

        $(document).ready(function() {
            $('#footer').addClass('d-none');
        });

        $('#cancel-button').on('click', function() {
            $.ajax({
                url: '{{ route('payment.cancel') }}',
                type: 'POST',
                data: {
                    order_id: '{{ $order_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '{{ route('home') }}';
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    </script>
@endsection
