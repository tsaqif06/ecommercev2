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
                                <button data-toggle="modal" data-target="#registerModal"
                                    class="btn btn-outline-custom mr-2 rounded" style="width: 100%">SIGNUP</button>
                                <button data-toggle="modal" data-target="#loginModal" class="btn btn-custom ml-2 rounded"
                                    style="width: 100%">LOGIN</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content container-fluid rounded" style="width: 500px; height: 400px">
                <div class="modal-body">
                    <h5 class="modal-title mt-2" id="sortModalLabel">Sort Products By</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- Tombol atas -->
                    <div class="d-flex mb-3">
                        <button type="button" class="btn btn-outline-custom rounded">All</button>
                        <button type="button" class="btn btn-outline-custom rounded">Available</button>
                    </div>

                    <!-- Tombol pilihan di bawah -->
                    <button type="button" class="btn btn-sort">Featured</button>
                    <button type="button" class="btn btn-sort">Recent</button>
                    <button type="button" class="btn btn-sort">Oldest</button>
                    <button type="button" class="btn btn-sort">Most Popular</button>
                    <button type="button" class="btn btn-sort">Lowest Price</button>
                    <button type="button" class="btn btn-sort">Highest Price</button>
                    <button type="button" class="btn btn-sort">Product Name (A-Z)</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content container-fluid rounded" style="width: 500px; height: 400px">
                <div class="modal-body">
                    <h5 class="modal-title mt-2" id="sortModalLabel">Sort Products By</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- Tombol atas -->
                    <div class="d-flex mb-3">
                        <button type="button" class="btn btn-outline-custom rounded">All</button>
                        <button type="button" class="btn btn-outline-custom rounded">Available</button>
                    </div>

                    <!-- Tombol pilihan di bawah -->
                    <button type="button" class="btn btn-sort">Featured</button>
                    <button type="button" class="btn btn-sort">Recent</button>
                    <button type="button" class="btn btn-sort">Oldest</button>
                    <button type="button" class="btn btn-sort">Most Popular</button>
                    <button type="button" class="btn btn-sort">Lowest Price</button>
                    <button type="button" class="btn btn-sort">Highest Price</button>
                    <button type="button" class="btn btn-sort">Product Name (A-Z)</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Orders Section -->
    <div class="card mt-2" style="width: 100%;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2 class="card-title">
                    @php
                        $orderCount = 0;

                        if ($orders != null) {
                            $orderCount = count($orders);
                        }
                    @endphp
                    My Orders ({{ $orderCount }})
                </h2>
                <form id="order-filter-form" method="GET" action="{{ route('user.order.index') }}" class="form-inline">
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
