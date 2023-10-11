<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Shop</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" sizes="16x16" />
    {{-- bootstrap cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/my_shop.css') }}">
    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar sidebarBgcolors">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between shadow">
                    <a href="" class="text-nowrap logo-img d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/images/logos/logo.png') }}" width="50px" alt="" />
                        <p class="ms-2 my-auto fs-6 fw-medium text-info">My Shop</p>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'dashboard' == request()->path() ? 'active' : ''}}" href="{{ route('admin#dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Product Manangments</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/category/list' == request()->path() ? 'active' : ''}}" href="{{ route('admin#categoryList') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/product/list' == request()->path() ? 'active' : ''}}" href="{{ route('admin#productList') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-shop"></i>
                                </span>
                                <span class="hide-menu">Products</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/order/list' == request()->path() ? 'active' : ''}}" href="{{route('admin#orderList')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Orders</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Others</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/AdminList' == request()->path() ? 'active' : ''}}" href="{{route('admin#adminList')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Admin Lists</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/userList' == request()->path() ? 'active' : ''}}" href="{{route('admin#userList')}}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-users"></i>
                                </span>
                                <span class="hide-menu">User Lists</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link links {{'admin/customer/contact' == request()->path() ? 'active' : ''}}" href="{{route('admin#contactMessage')}}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-comment-dots"></i>
                                </span>
                                <span class="hide-menu">Contact Message</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="sidebar-link border-0 w-100 links" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </span>
                                    <span class="hide-menu">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header shadow">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="d-flex justify-content-center align-items-center">
                            <h3 class="text-nowrap fs-6">My Shop Admin
                                Pannel</h3>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/account/' . Auth::user()->image) }}"
                                            alt="" width="50" height="50" class="rounded-circle">
                                    @else
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                                width="20px" height="20px" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/images/profile/default-female.jpg') }}"
                                                alt="" width="20px" height="20px" class="rounded-circle">
                                        @endif
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('admin#profile') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>

                                        <button type="button" id="modalbtns"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-solid fa-key"></i>
                                            Change Password
                                        </button>



                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button
                                                class="btn btn-outline-primary mx-3 mt-2 d-block w-75">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            @yield('content')

            {{-- modal --}}
            <div id="passwordmodals" class="modals fades">
                <div class="modal-dialogs">
                    <div class="modal-contents">
                        <div class="modal-headers">
                            <span id="closemodalbtns">&times;</span>
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/account/' . Auth::user()->image) }}">
                            @else
                                @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}">
                                @else
                                    <img src="{{ asset('assets/images/profile/default-female.jpg') }}"
                                    >
                                @endif
                            @endif
                        </div>
                        <div class="modal-bodys">
                            @if (session('notMatch'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p>{{ session('notMatch') }}</p>
                                </div>
                            @endif
                            <form action="{{ route('admin#changePassword') }}" method="POST">
                                @csrf
                                <div class="form-group my-3">
                                    <label for="oldpassword" class="mb-2">Old Password</label>
                                    <input type="password" name="oldPassword" id="oldpassword" class="form-control"
                                        placeholder="Enter Old Password...">
                                    @error('oldPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="newpassword" class="mb-2">New Password</label>
                                    <input type="password" name="newPassword" id="newpassword" class="form-control"
                                        placeholder="Enter New Password...">
                                    @error('newPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group my-3">
                                    <label for="confirmPassword" class="mb-2">Confirm Password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword"
                                        class="form-control" placeholder="Enter Confirm Password...">
                                    @error('confirmPassword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal --}}

        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/my_shop.js') }}"></script>
</body>

@yield('script_source')

</html>
