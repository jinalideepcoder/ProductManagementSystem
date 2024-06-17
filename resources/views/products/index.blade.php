@extends('layout.master')
@push('header')
    <title>category</title>
    <style>
        #productTable_wrapper .row {
            width: 50%;
            margin: auto;
        }

        .pagination {
            margin-top: 5px !important;
        }
    </style>
@endpush
@section('content')
    <div class="text-end mb-2">
        <a href="{{ route('products.create') }}"><button class="btn btn-primary me-5 mb-3">Create</button></a>

    </div>
    @if (\Session::has('success'))
        <div class="alert alert-success text-center m-auto w-25 ">
            <p>{!! \Session::get('success') !!}</p>
        </div>
    @endif

    <table id="productTable" class="table table-striped  table-bordered ">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
@push('footer')
    <script>
        $('#productTable').DataTable({
            ajax: {
                url: '{{ route('products.index') }}',
                dataSrc: 'data'
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "name"
                },
                {
                    data: "price"
                },
                {
                    data: "thumb_image"
                },
                {
                    data: "description"
                },
                {
                    data: "action_button"
                },

            ]
        })
    </script>
@endpush
