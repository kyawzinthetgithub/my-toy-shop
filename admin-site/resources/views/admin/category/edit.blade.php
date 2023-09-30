@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-5 offset-md-3">
                <div class="card shadow p-5 rounded-2">
                    <h4 class="text-muted my-4">Edit Category</h4>
                    <form action="{{ route('admin#categoryUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="hidden" name="categoryId" value="{{ $data->id }}">
                            <label for="categoryName" class="my-2 fw-medium">Category Name</label>
                            <input type="text" name="categoryName" id="categoryName" class="form-control"
                                value="{{ old('categoryName', $data->category_name) }}"
                                placeholder="Enter Category Name...">
                            @error('categoryName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="categoryImage" class="my-2 fw-medium">Image</label>
                            <input type="file" name="categoryImage" id="categoryImage" class="form-control">
                            @error('categoryImage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin#categoryList') }}">
                                <button type="button" class="btn btn-danger me-3">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
