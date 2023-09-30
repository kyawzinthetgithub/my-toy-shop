@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card shadow p-5 rounded-2">
                    <h4 class="text-muted my-4">Create New Toy</h4>
                    <form action="{{ route('admin#productPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="productName" class="my-2 fw-medium">Name</label>
                            <input type="text" name="productName" id="productName" class="form-control"
                                value="{{ old('productName') }}" placeholder="Enter Name...">
                            @error('productName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="categoryId" class="my-2 fw-medium">Category Name</label>
                            <select name="categoryId" id="categoryId" class="form-control">
                                <option selected disabled>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productSize" class="my-2 fw-medium">Size</label>
                            <input type="text" name="productSize" id="productSize" class="form-control"
                                value="{{ old('productSize') }}" placeholder="Enter Size...">
                            @error('productSize')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productDetails" class="my-2 fw-medium">Product Details</label>
                            <input type="text" name="productDetails" id="productDetails" class="form-control"
                                value="{{ old('productDetails') }}" placeholder="Enter Details...">
                            @error('productDetails')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productPrice" class="my-2 fw-medium">Price</label>
                            <input type="text" name="productPrice" id="productPrice" class="form-control"
                                value="{{ old('productPrice') }}" placeholder="Enter Price...">
                            @error('productPrice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productMade" class="my-2 fw-medium">Made</label>
                            <input type="text" name="productMade" id="productMade" class="form-control"
                                value="{{ old('productMade') }}" placeholder="Enter Made...">
                            @error('productMade')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productMadeCountry" class="my-2 fw-medium">Made Country</label>
                            <input type="text" name="productMadeCountry" id="productMadeCountry" class="form-control"
                                value="{{ old('productMadeCountry') }}" placeholder="Enter Made Country...">
                            @error('productMadeCountry')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="productImage" class="my-2 fw-medium">Image</label>
                            <input type="file" name="productImage" id="productImage" class="form-control">
                            @error('productImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin#productList') }}">
                                <button type="button" class="btn btn-danger me-3">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
