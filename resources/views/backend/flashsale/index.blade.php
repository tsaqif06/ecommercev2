@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">All Products with Flash Sale</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($products->count() > 0)
                    <table class="table table-bordered" id="flash-sale-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Image</th> <!-- Kolom untuk gambar -->
                                <th>Title</th>
                                <th>Discount</th>
                                <th>Flash Sale Start</th>
                                <th>Flash Sale End</th>
                                <th>Status</th>
                                @if (auth()->user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->photo)
                                            @php
                                                $photos = explode(',', $product->photo);
                                            @endphp
                                            <img src="{{ $photos[0] }}" class="img-fluid" style="max-width:80px"
                                                alt="{{ $product->title }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                                style="max-width:80px" alt="No Image">
                                        @endif
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->flash_sale_discount ?? 'N/A' }}%</td>
                                    <td>{{ $product->flash_sale_start ?? 'N/A' }}</td>
                                    <td>{{ $product->flash_sale_end ?? 'N/A' }}</td>
                                    <td>
                                        @if ($product->status == 'active')
                                            <span class="badge badge-success">{{ $product->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $product->status }}</span>
                                        @endif
                                    </td>
                                    @if (auth()->user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('flashsale.edit', $product->id) }}"
                                                class="btn btn-primary btn-sm float-left mr-1"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="Add Flash Sale" data-placement="bottom"><i
                                                    class="fas fa-edit"></i></a>
                                            @if ($flashSaleProducts->contains($product->id))
                                                <form method="POST"
                                                    action="{{ route('flashsale.destroy', $product->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm dltBtn"
                                                        data-id={{ $product->id }}
                                                        style="height:30px; width:30px;border-radius:50%"
                                                        data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{--  <span style="float:right">{{ $products->links() }}</span>  --}}
                @else
                    <h6 class="text-center">No Products found!!!</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css" />
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
    <script>
        $(document).ready(function() {
            $('#flash-sale-dataTable').DataTable();
            // Sweet alert for delete confirmation
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            });
        });
    </script>
@endpush
