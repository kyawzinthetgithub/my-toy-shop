@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-muted fw-bold my-3">Profile</h4>
            @if (session('updated'))
                <div class="col-md-3 offset-md-7">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>{{ session('updated') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="col-md-7 offset-md-3">
                <div class="card shadow p-3 rounded">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/account/' . Auth::user()->image) }}" width="50%"
                            class="img-thumbnail mx-auto my-3">
                    @else
                        @if (Auth::user()->gender == 'male')
                            <img src="{{ asset('assets/images/profile/user-1.jpg') }}" width="50%"
                                class="img-thumbnail mx-auto my-3">
                        @else
                            <img src="{{ asset('assets/images/profile/default-female.jpg') }}" width="50%"
                                class="img-thumbnail mx-auto my-3">
                        @endif
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Informations</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th class="">Name</th>
                                <td class="text-capitalize">{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th class="">Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th class="">Address</th>
                                <td class="text-capitalize">{{ Auth::user()->address }}</td>
                            </tr>
                            <tr>
                                <th class="">Phone</th>
                                <td class="text-capitalize">{{ Auth::user()->phone }}</td>
                            </tr>
                            <tr>
                                <th class="">Gender</th>
                                <td class="text-capitalize">{{ Auth::user()->gender }}</td>
                            </tr>
                            <tr>
                                <th class="">Role</th>
                                <td class="text-capitalize">{{ Auth::user()->role }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin#profileEdit') }}">
                            <button class="btn btn-success"><i class="fa-solid fa-user-pen me-2"></i> Edit</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
