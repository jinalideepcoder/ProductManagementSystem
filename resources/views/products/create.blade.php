@extends('layout.master')
@push('header')
    <title>product/create</title>
@endpush
@section('content')
    <div class="card d-flex m-auto mt-5" style="width: 25rem;">
        <div class="card-body">

            <form action="{{ route('products.store') }}" id="productForm" method="post" enctype="multipart/form-data">
                @csrf
                <h5 class="card-title text-center">Create Product</h5>
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
                <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name">
                <label class="w-100" for="">Category<span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ 'category_id' === old('category_id') ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <label class="w-100" for="">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="6">{{ old('description') }}</textarea>
                <label class="w-100" for="">Price<span class="text-danger">*</span></label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" class="form-control" value="{{ old('price') }}" id="price" name="price">
                </div>
                <label id="price-error" class="error" for="price"></label>
                <label class="w-100" for="">Image</label>
                <input type="file" class="form-control" name="thumb_image" id="thumb_image">
                <button class="btn btn-primary mt-3" type="submit">Save</button>
        </div>

        </form>

    </div>
    </div>
@endsection
@push('footer')
    <script>
        $("#productForm").validate({

            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                price: {
                    required: true,
                    maxlength: 12,
                    digits: true,
                },
                description: {
                    required: false,
                    maxlength: 255,
                },
            },


            messages: {
                name: {
                    required: "Please Enter Name",
                    maxlength: "max 255 character allows"
                },

                price: {
                    required: "Please Enter price",
                    maxlength: "max 12 digit allows",
                    digit: "price should be in digits only"
                },
                description: {
                    maxlength: "max 255 character allows"
                }

            }
        });
        $('#thumb_image').bind('change', function() {
            var size = (this.files[0].size);
            if (size > 2000000) {
                alert('file size should be less than 2MB');
            };
        });
    </script>
@endpush
