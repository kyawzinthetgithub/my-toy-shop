@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card p-5" style="box-shadow: 0px 0px 3px #b6b3b3">
                    <a href="{{ route('admin#productDetail', $product->id) }}" class="text-black"><i
                            class="fa-solid fa-circle-arrow-left fa-2x"></i></a>
                    <h3 class="text-muted my-3">Update Product</h3>
                    <form action="{{ route('admin#updateProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-2">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <label for="productName" class="mb-2">Name</label>
                            <input type="text" name="productName" id="productName" class="form-control"
                                placeholder="Enter Name..." value="{{ old('name', $product->product_name) }}">
                            @error('productName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="categoryId" class="mb-2">Category</label>
                            <select name="categoryId" id="categoryId" class="form-control">
                                <option selected disabled>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productSize" class="mb-2">Size</label>
                            <input type="text" name="productSize" id="productSize" class="form-control"
                                placeholder="Enter Size..." value="{{ old('name', $product->size) }}">
                            @error('productSize')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productDetails" class="mb-2">Details</label>
                            <input type="text" name="productDetails" id="productDetails" class="form-control"
                                placeholder="Enter Details..." value="{{ old('name', $product->product_detail) }}">
                            @error('productDetails')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productImage" class="mb-2">Image</label>
                            <input type="file" name="productImage" id="productImage" class="form-control">
                            @error('productImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productMade" class="mb-2">Made</label>
                            <input type="text" name="productMade" id="productMade" class="form-control"
                                placeholder="Enter Made Material..." value="{{ old('name', $product->made_by) }}">
                            @error('productMade')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productMadeCountry" class="mb-2">Made Country</label>
                            <input type="text" name="productMadeCountry" id="productMadeCountry" class="form-control"
                                placeholder="Enter Made Country..." value="{{ old('name', $product->made_country) }}">
                            @error('productMadeCountry')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="productPrice" class="mb-2">Price</label>
                            <input type="text" name="productPrice" id="productPrice" class="form-control"
                                placeholder="Enter Price..." value="{{ old('name', $product->product_price) }}">
                            @error('productPrice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
