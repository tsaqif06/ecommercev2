@extends('frontend.layouts.master')

@section('title', 'E-SHOP || PAYMENT')

@section('main-content')
    @if (!Auth::check())
        <div class="container" style="margin: 150px 0 50px">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4" style="border: 0;">
                        <div class="card-body" style="text-align: center">
                            <h5 class="card-title text-center">GET VIP SERVICE WITH OUR 1-STEP LOGIN:</h6>
                                <h6 class="card-text">★ BE THE FIRST TO GET SPECIAL DISCOUNTS</h6>
                                <h6 class="card-text">★ NEVER LOSE ANY OF YOUR ORDERS</h6>
                                <div class="d-flex justify-content-center mt-4">
                                    <button data-toggle="modal" data-target="#registerModal"
                                        class="btn btn-outline-custom mr-2 rounded" style="width: 100%">SIGNUP</button>
                                    <button data-toggle="modal" data-target="#loginModal"
                                        class="btn btn-custom ml-2 rounded" style="width: 100%">LOGIN</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content container-fluid rounded" style="max-width: 500px; max-height: 430px;">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h5 class="modal-title mb-3" id="registerModalLabel">Register</h5>
                        <p style="font-weight: bold;">Create an account to become our member, earn points, get free
                            vouchers,
                            and hear our news earlier.
                        </p>

                        <form class="mt-3" method="post" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="form-floating-custom mb-3 position-relative">
                                <input type="text" class="form-control" placeholder=" " id="name" name="name"
                                    value="{{ old('name') }}" style="padding-left: -40px;" required>
                                <label for="registerFullName">Your Full Name*</label>
                            </div>
                            <div class="form-floating-custom mb-3 position-relative">
                                <input type="text" class="form-control" placeholder=" " id="registerEmail" name="email"
                                    value="{{ old('email') }}" required>
                                <label for="registerEmailPhone">Your email</label>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="form-floating-custom mb-3 position-relative">
                                <input type="password" class="form-control" placeholder=" " id="registerPassword"
                                    name="password" value="{{ old('password') }}" required>
                                <label for="registerPassword">Password</label>
                                <i class="fas fa-lock"></i>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="border-radius: 10px">Create New
                                Account</button>
                        </form>

                        <p class="text-center mt-3">
                            Already have an account?
                            <a href="#" class="switch-to-login">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal container-fluid rounded" style="max-width: 500px; max-height: 300px;">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h5 class="modal-title mb-3" id="loginModalLabel">Login</h5>

                        <form class="mt-3" method="post" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="form-floating-custom mb-3 position-relative">
                                <input type="email" class="form-control" placeholder=" " id="loginEmail" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="loginEmailPhone">Your email</label>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="form-floating-custom mb-3 position-relative">
                                <input type="password" class="form-control" placeholder=" " id="loginPassword"
                                    name="password" value="{{ old('password') }}" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="loginPassword">Password</label>
                                <i class="fas fa-lock"></i>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"
                                style="border-radius: 10px">Login</button>
                        </form>

                        <p class="text-center mt-3">
                            Dont have an account?
                            <a href="#" class="switch-to-register">Signup here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container profile-container" style="margin: 150px 0 50px">
            <div class="row w-100">
                <div class="col-md-12">
                    <div class="profile-card">
                        <div class="row g-0">
                            <!-- Profile Display Column -->
                            <div class="col-md-4 profile-header position-relative">
                                <div class="text-center">
                                    <!-- Display Profile Image -->
                                    @if ($profile->photo)
                                        <img src="{{ $profile->photo }}" alt="Profile Picture"
                                            class="rounded-circle profile-img mb-3" id="profileImage">
                                    @else
                                        <img src="{{ asset('backend/img/avatar.png') }}" alt="Profile Picture"
                                            class="rounded-circle profile-img mb-3" id="profileImage">
                                    @endif

                                    <!-- Display Profile Name and Email -->
                                    <h3 id="displayName" class="mb-0">{{ $profile->name }}</h3>
                                    <p id="displayEmail" class="mb-2" style="color: white;">{{ $profile->email }}</p>
                                    <span id="displayRole" class="badge bg-light text-primary"
                                        style="color: #5b5b5b; font-size: 16px; font-weight: bold;">
                                        {{ $profile->role }}
                                    </span>
                                </div>

                                <!-- Logout Icon (Positioned in Bottom Left Corner) -->
                                <form action="{{ route('user.logout') }}" class="position-absolute"
                                    style="bottom: 10px; left: 10px;">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent ml-4" title="Log Out">
                                        <i class="fa fa-power-off" style="font-size: 24px; color: white;"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Profile Update Form Column -->
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-4">Update Profile</h4>
                                    <form id="profileForm" method="POST"
                                        action="{{ route('user-profile-update', $profile->id) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control pl-3" id="name"
                                                name="name" value="{{ $profile->name }}"
                                                style="height: 50px; border-radius: 50px" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control pl-3" id="email"
                                                name="email" value="{{ $profile->email }}"
                                                style="height: 50px; border-radius: 50px" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="inputPhoto" class="form-label">Update Profile Picture</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-custom"
                                                        style="color: white; border-radius: 50px 0 0 50px">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail" class="form-control pl-3" type="text"
                                                    name="photo" value="{{ $profile->photo }}"
                                                    style="border-radius: 0 50px 50px 0">
                                            </div>
                                            @error('photo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-custom btn-update w-100">Update
                                            Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                <form id="order-filter-form" method="GET" action="{{ route('user.order.index') }}"
                    class="form-inline">
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

        .profile-container {
            display: flex;
            align-items: center;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background-color: #5b5b5b;
            color: white;
            padding: 30px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .form-control,
        .btn {
            border-radius: 20px;
        }

        .btn-update {
            background-color: red;
            border: none;
        }

        /* Custom floating label styling */
        .form-floating-custom {
            position: relative;
        }

        .form-floating-custom input {
            cursor: pointer;
            padding-left: 40px;
            /* Space for icon */
            padding-top: 16px;
            height: 45px;
            border-radius: 10px;
        }

        .form-floating-custom input:focus {
            border: 1px solid red;
        }

        .form-floating-custom label {
            position: absolute;
            top: 50%;
            left: 40px;
            /* Adjusted for space after the icon */
            transform: translateY(-50%);
            transition: all 0.2s ease;
            background: #fff;
            padding: 0 5px;
            color: black;
            font-size: 14px;
            pointer-events: none;
            font-weight: bold;
        }

        input:-webkit-autofill {
            background-color: white !important;
            color: black !important;
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
            box-shadow: 0 0 0 1000px white inset !important;
            border-color: #ced4da !important;
        }

        /* Move label when input is focused or has content */
        .form-floating-custom input:focus+label,
        .form-floating-custom input:not(:placeholder-shown)+label {
            top: -10px;
            transform: translateY(0);
            font-size: 12px;
            color: black;
        }

        /* Icon positioning */
        .form-floating-custom i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: black;
            pointer-events: none;
            font-size: 18px;
        }
    </style>
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#footer').addClass('d-none'); // Menyembunyikan footer

            @if (session('showLoginModal'))
                $('#loginModal').modal('show');
            @endif

            // Inisialisasi DataTables
            $('#orders-table').DataTable({
                "scrollX": true,
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

            $('.switch-to-login').on('click', function(e) {
                e.preventDefault();
                $('#registerModal').modal('hide');
                $('#registerModal').on('hidden.bs.modal', function() {
                    $('#loginModal').modal('show');
                    $(this).off(
                        'hidden.bs.modal'); // Clean up event listener to avoid multiple triggers
                });
            });

            // Switch from login modal to register modal
            $('.switch-to-register').on('click', function(e) {
                e.preventDefault();
                $('#loginModal').modal('hide');
                $('#loginModal').on('hidden.bs.modal', function() {
                    $('#registerModal').modal('show');
                    $(this).off(
                        'hidden.bs.modal'); // Clean up event listener to avoid multiple triggers
                });
            });
        });
    </script>
@endpush
