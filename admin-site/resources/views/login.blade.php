@extends('layouts.master')

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0 loginCards">
                            <div class="card-body">
                                @if (session('changeSuccess'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <p>{{ session('changeSuccess') }}</p>
                                    </div>
                                @endif
                                <a href=""
                                    class="text-nowrap logo-img text-center d-block py-3 w-100 d-flex justify-content-center align-item-center">
                                    <img src="{{ asset('assets/images/logos/logo.png') }}" width="80px" alt="">
                                    <h5 class="my-auto text-primary">My Shop</h5>
                                </a>
                                <p class="text-center">Enjoy Shopping with us.</p>
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Email...">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Enter Password...">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New User?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('admin#register') }}">Create an
                                            account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
