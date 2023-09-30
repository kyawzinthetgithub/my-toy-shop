@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('admin#update', Auth::user()->id) }}" method="post" enctype="multipart/form-data"
                    class="profileForm">
                    @csrf
                    <h3><i class="fa-solid fa-user-pen me-3 text-primary"></i>Profile Edit</h3>
                    <div class="form-group my-3">
                        <label for="name" class="mb-2">Name</label>
                        <input type="text" name="userName" id="name" class="form-control"
                            value="{{ old('name', Auth::user()->name) }}">
                        @error('userName')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="email" class="mb-2">Email</label>
                        <input type="email" name="userEmail" id="email" class="form-control"
                            value="{{ old('name', Auth::user()->email) }}">
                        @error('userEmail')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="phone" class="mb-2">Phone</label>
                        <input type="tel" name="userPhone" id="phone" class="form-control"
                            value="{{ old('name', Auth::user()->phone) }}">
                        @error('userPhone')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="address" class="mb-2">Address</label>
                        <input type="text" name="userAddress" id="address" class="form-control"
                            value="{{ old('name', Auth::user()->address) }}">
                        @error('userAddress')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="gender" class="d-block mb-2 text-black fw-medium">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="userGender" id="male" value="male"
                                @if (Auth::user()->gender == 'male') @checked(true) @endif>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="userGender" id="female" value="female"
                                @if (Auth::user()->gender == 'female') @checked(true) @endif>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <br>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="role" class="mb-2">Role</label>
                        <input type="text" name="userRole" id="role" class="form-control" readonly
                            value="{{ Auth::user()->role }}">
                    </div>
                    <div class="form-group my-3">
                        <label for="image" class="mb-2">Image</label>
                        <input type="file" name="userImage" id="image" class="form-control">
                        @error('userImage')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('admin#profile') }}">
                            <button type="button" class="btn btn-danger mx-3"><i
                                    class="fa-solid fa-xmark me-2"></i>Cancle</button></a>
                        <button type="submit" class="btn btn-success"><i
                                class="fa-solid fa-floppy-disk me-2"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
