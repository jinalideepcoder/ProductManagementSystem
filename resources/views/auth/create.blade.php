@extends('layout.master')
@section('header')
    <title>login</title>
@endsection
@section('content')
    <div class="card d-flex m-auto mt-5" style="width: 25rem;">
        <div class="card-body">

            <form action="{{ route('login.store') }}" id="loginForm" method="post">
                @csrf
                <h5 class="card-title text-center">Login</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <label class="w-100" for="">Email</label>
                <input type="email" class="form-control" type="email" name="email" id="email">

                <label class="w-100" for="">Password</label>
                <input type="password" class="form-control" type="password" name="password" id="password">

                <div class="text-end">
                    <button class="btn btn-primary mt-3" type="submit">Login</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('footer')
    <script>
        $("#loginForm").validate({
            rules: {
                password: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                password: {
                    required: "Please Enter Password",
                },
                email: {
                    required: "Please Enter Email",
                    email: "Your email address must be in the format of name@domain.com"
                }
            }
        });
    </script>
@endsection
