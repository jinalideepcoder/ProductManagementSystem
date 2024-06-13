@extends('layout.master')
@section('header')
    <title>product/edit</title>
@endsection
@extends('layout.header')
@extends('layout.sidebar')
@section('content')
    <div class="card d-flex m-auto mt-5" style="width: 25rem;">
        <div class="card-body">

            <form action="{{ url('products' . "/$id") }}" id="productUpdateForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h5 class="card-title text-center">Edit Product</h5>
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
                <label class="w-100" for="">Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ $product->name }}" class="form-control" name="name" id="name">
                <label class="w-100" for="">Category<span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label class="w-100" for="">Description</label>
                <textarea class="form-control" value="{{ $product->description }}" name="description" id="description" cols="30"
                    rows="6">{{ $product->description }}</textarea>
                <label class="w-100" for="">Price<span class="text-danger">*</span></label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" value="{{ $product->price }}" class="form-control" id="price" name="price">
                </div>
                <label id="price-error" class="error" for="price"></label>
                <label class="w-100" for="">Image</label>
                <img src="{{ asset('/storage/images/' . $product->thumb_image) }}"
                    style="height: 50px;width:50px; margin-bottom:5px;" alt="" title="">
                <a href="{{ asset('/storage/images/' . $product->thumb_image) }}"
                    target="blank">{{ $product->thumb_image }}</a>
                <input type="file" class="form-control" value="{{ $product->thumb_image }}" name="thumb_image"
                    id="thumb_image">
                <button class="btn btn-primary mt-3" type="submit">Save</button>
        </div>

        </form>

    </div>
    </div>
@endsection
@section('footer')
    <script>
        $("#productUpdateForm").validate({
            rules: {
                name: ["required", "max:255"],
                price: 'required'
                description: "max:255"
            },

            messages: {
                name: {
                    required: "Please Enter Name",
                    max: "max 255 characters allow"
                },

                price: {
                    required: "Please Enter price",
                },
                description: {
                    max: "max 255 characters allow"
                }
            }
        });
    </script>
@endsection
