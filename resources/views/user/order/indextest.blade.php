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
            </div>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="card mt-2" style="width: 100%;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2 class="card-title">
                    My Orders ({{ count($orders) }})
                </h2>
                <form id="order-filter-form" method="GET" action="{{ route('user.order.indeex') }}" class="form-inline">
                    <select name="status" class="form-control mr-2" id="status-filterorder">
                        <option value="">ALL STATUS</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>UNPAID</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>PAID</option>
                        <option value="unconfirmed" {{ request('status') == 'unconfirmed' ? 'selected' : '' }}>UNCONFIRMED
                        </option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>CONFIRMED
                        </option>
                    </select>
                </form>
            </div>

            <div id="orders-list">
                @include('user.order.order_list', ['orders' => $orders])
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#footer').addClass('d-none'); // Menyembunyikan footer

            // Inisialisasi DataTables
            $('#orders-table').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                "order": [
                    [0, 'desc']
                ],
                "language": {
                    "search": "Search Orders:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ orders",
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
        });
    </script>
@endpush
