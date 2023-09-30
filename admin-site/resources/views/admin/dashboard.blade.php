@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <h3 class="mb-3 fs-5">Admin Dashboard</h3>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#adminList') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">Admin
                                    List <i class="ti ti-file-description fs-6"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#userList') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">User
                                    List <i class="fa-solid fa-users"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#categoryList') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">Category <i
                                        class="fa-solid fa-bars-staggered"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#productList') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">Products <i
                                        class="fa-solid fa-shop"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#orderList') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">Orders <i
                                        class="ti ti-cards"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100 bg-danger">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="card-title fw-semibold"><a href="{{ route('admin#contactMessage') }}"
                                    class="nav-link d-flex justify-content-between align-items-center">Contact Message <i
                                        class="fa-solid fa-comment-dots"></i></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($datas) != 0)
        <div class="row">
            <div class="col-md-6">
                <h3>Ordered Product Chart</h3>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('script_source')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        var datas = {!! $datas !!}
        var total_order = [];
        var product = [];
        $.each(datas, function(key, val) {
            total_order.push(val.total_order);
            product.push(val.product_name);
        });
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: product,
                datasets: [{
                    label: 'Totat order products',
                    data: total_order,
                    borderWidth: 1,
                    backgroundColor: ['#FFB1C1','#eb6434','#5c6348','#1d216e','#9c0c78','#2c5a6b'],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
