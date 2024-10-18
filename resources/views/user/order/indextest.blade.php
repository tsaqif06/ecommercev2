@extends('frontend.layouts.master')

@section('title', 'E-SHOP || PAYMENT')

@section('main-content')
    <div class="container" style="margin: 150px 0 50px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4" style="border: 0;">
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title text-center">GET VIP SERVICE WITH OUR 1-STEP LOGIN:</h6>
                            <h6 class="card-text">★ YOU CAN CHAT WITH HECATESOFFICIAL</h6>
                            <h6 class="card-text">★ BE THE FIRST TO GET SPECIAL DISCOUNTS</h6>
                            <h6 class="card-text">★ NEVER LOSE ANY OF YOUR ORDERS</h6>
                            <div class="d-flex justify-content-center mt-4">
                                <button class="btn btn-outline-custom mr-2 rounded" style="width: 100%">SIGNUP</button>
                                <button class="btn btn-custom ml-2 rounded" style="width: 100%">LOGIN</button>
                            </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h2 class="card-title">My Orders (0)</h2>
                            <select class="form-control w-25 float-right mb-3">
                                <option>ALL STATUS</option>
                                <option>NOT PAID</option>
                                <option>PAID</option>
                                <option>PACKAGED</option>
                                <option>SENT</option>
                                <option>DONE</option>
                                <option>CANCELLED</option>
                            </select>
                        </div>

                        <p class="card-text">YOULL BE ABLE TO CHECK YOUR ORDERS AND THEIR PROGRESS FROM THIS LIST.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#footer').addClass('d-none'); // Menyembunyikan footer
        });
    </script>
@endsection

@push('styles')
    {{--  <style>
        .login-section {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-section p {
            font-size: 14px;
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-transform: uppercase;
            width: calc(50% - 10px);
            transition: background-color 0.3s;
        }

        .button-signup {
            background-color: white;
            color: #333;
            border: 1px solid #ccc;
        }

        .button-signup:hover {
            background-color: #f0f0f0;
        }

        .button-login {
            background-color: #8b0000;
            color: white;
        }

        .button-login:hover {
            background-color: #a50000;
        }

        /* Orders section styles */
        .orders-section {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .orders-section h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .status-select {
            float: right;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .orders-section p {
            font-size: 14px;
            margin-top: 20px;
            color: #666;
        }
    </style>  --}}
@endpush
