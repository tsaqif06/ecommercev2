@extends('frontend.layouts.master')

@section('title', 'E-SHOP || PAYMENT')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Details {{ $invoice_id }}</div>

                    <div class="card-body">
                        <h5>Order Summary</h5>
                        <ul class="list-group mb-3">
                            @foreach ($items as $item)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $item['qty'] }}</small>
                                    </div>
                                    <span class="text-muted">${{ $item['price'] }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Shipping Type : </h6>
                                    <small class="text-muted">{{ $shipping_name }}</small>
                                </div>
                                <span class="text-muted">${{ $shipping_price }}</span>
                            </li>
                            @if (isset($shipping_discount))
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Shipping Discount</span>
                                    <span class="text-success">-${{ $shipping_discount }}</span>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>${{ $total }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Nomor Rekening</span>
                                <span>{{ $no_rekening }}</span>
                            </li>
                        </ul>
                        <form id="payment-form" action="{{ route('payment.success') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $order_id }}" id="order_id" name="order_id">
                            <div class="form-group">
                                <label for="proof_payment">Upload Bukti Pembayaran:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="proof_payment" name="proof_payment"
                                        accept="image/*" capture="camera" onchange="previewImage(this)">
                                    <label class="custom-file-label" for="proof_payment">Pilih file</label>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" id="cancel-button">Cancel</button>
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

        $('#cancel-button').on('click', function() {
            $.ajax({
                url: '{{ route('payment.cancel') }}',
                type: 'GET',
                success: function(response) {
                    alert(response.message); // Tampilkan pesan pembatalan
                    window.location.href = '{{ route('home') }}'; // Arahkan ke halaman beranda
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText); // Tampilkan error jika ada
                }
            });
        });
    </script>
@endsection
