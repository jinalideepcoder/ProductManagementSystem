@extends('layout.master')
@section('header')
    <title>category/create</title>
@endsection
@extends('layout.header')
@extends('layout.sidebar')
@section('content')
    <div class="card d-flex m-auto mt-5" style="width: 25rem;">
        <div class="card-body">

            <form action="{{ route('categories.store') }}" id="categoryForm" method="post">
                @csrf
                <h5 class="card-title text-center">Create Category</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif

                <label class="w-100" for="">Name</label>
                <input type="text" class="form-control" type="name" name="name" id="name">
                <div class="text-end">
                    <button class="btn btn-primary mt-3" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('footer')
    <script>
        $("#categoryForm").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: {
                    required: "Please Enter Name",
                },

            }
        });
    </script>
@endsection
