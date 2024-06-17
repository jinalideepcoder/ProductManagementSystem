@extends('layout.master')
@push('header')
    <title>category</title>
    <style>
        #categoryTable_wrapper .row {
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
        <a href="{{ route('categories.create') }}"><button class="btn btn-primary me-5 mb-3">Create</button></a>
    </div>
    @if (\Session::has('success'))
        <div class="alert alert-success text-center m-auto w-25 ">
            <p>{!! \Session::get('success') !!}</p>
        </div>
    @endif
    <table id="categoryTable" class="table table-striped text-center table-bordered">

        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Action</th>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
@push('footer')
    <script>
        $('#categoryTable').DataTable({
            ajax: {
                url: '{{ route('categories.index') }}',
                dataSrc: 'data'
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "name"
                },
                {
                    data: "action_button"
                },


            ]
        })
    </script>
@endpush
