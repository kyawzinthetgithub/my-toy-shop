@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h3 class="text-muted my-3">Ordered Product Lists</h3>

    <div class="row my-3">
        <div class="col-md-4">
            <div class="card border-1 shadow p-3">
                <h5 class="text-muted my-2">Order Info</h5>
                <table>
                    <div class="row my-2">
                        <div class="col"><i class="fa-solid fa-id-card-clip me-2"></i> Customer Name</div>
                        <div class="col text-capitalize">{{$orderLists[0]->user_name}}</div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><i class="fa-solid fa-qrcode me-2"></i> Ordered Code</div>
                        <div class="col">{{$orderLists[0]->order_code}}</div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><i class="fa-solid fa-clock me-2"></i></i> Ordered Date </div>
                        <div class="col">{{$orderLists[0]->created_at->format('d-M-Y')}}</div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><i class="fa-solid fa-dollar-sign me-2"></i> Total Price </div>
                        <div class="col">{{$order->total_price}} <span>MMK</span> <small class="d-block text-danger">Include Delivery Freed (3000)</small></div>
                    </div>
                </table>
            </div>
        </div>
    </div>

        <div class="table-responsive mt-3">
            <table class="table table-hover table-responsive text-center">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Order Code</th>
                        <th>qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orderLists as $orderList)
                    <tr>
                        <td class="align-middle">
                            @if ($orderList->product_image)
                                <img src="{{asset('storage/products/'.$orderList->product_image)}}" width="60px" class="img-thumbnail" style="height: 70px;">
                            @else
                                <img src="{{asset('storage/products/defaultImg.jpg')}}" width="60px" class="img-thumbnail" style="height: 70px;">
                            @endif
                        </td>
                        <td class="align-middle">{{$orderList->user_name}}</td>
                        <td class="align-middle">{{$orderList->product_name}}</td>
                        <td class="align-middle">{{$orderList->created_at->format('d-M-Y | h:i:a')}}</td>
                        <td class="align-middle">{{$orderList->qty}}</td>
                        <td class="align-middle">{{$orderList->total}}</td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            <div class="">{{ $orderLists->links() }}</div>
        </div>
</div>
@endsection
