@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h3 class="text-muted my-3">Order Lists</h3>

    <div class="d-flex justify-content-between">
        <p class="text-muted fw-bold">Total Order - {{$orders->total()}}</p>
        <form action="{{route('admin#sortOrder')}}" method="get">
            @csrf
            <div class="input-group">
                <select name="orderStatus" id="orderStatus" class="form-select">
                    <option value="" @if(request('orderStatus') == null || request('orderStatus') == "") selected @endif>All</option>
                    <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                    <option value="1" @if(request('orderStatus') == '1') selected @endif>Success</option>
                    <option value="2" @if(request('orderStatus') == '2') selected @endif>Deny</option>
                </select>
                <button type="submit" class="btn btn-dark btn-sm input-group-text">Search</button>
            </div>
        </form>
    </div>

    @if (count($orders) != 0)
        <div class="table-responsive mt-3">
            <table class="table table-hover table-responsive text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order Date</th>
                        <th>User Name</th>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)
                        <tr>
                            <input type="hidden" name="" id="" class="orderId" value="{{$order->id}}">
                            <td class="align-middle">{{$order->id}}</td>
                            <td class="align-middle">{{$order->created_at->format('d-M-Y')}}</td>
                            <td class="align-middle text-capitalize">{{$order->user_name}}</td>
                            <td class="align-middle">
                                <a href="{{route('admin#checkOrderList',$order->order_code)}}">{{$order->order_code}}</a>
                            </td>
                            <td class="align-middle">{{$order->total_price}}</td>
                            <td class="align-middle">
                                <select name="status" class="form-select text-center changeStatus">
                                    <option value="0" @if ($order->status == '0') selected @endif>Pending</option>
                                    <option value="1" @if ($order->status == '1') selected @endif>Success</option>
                                    <option value="2" @if ($order->status == '2') selected @endif>Deny</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">{{ $orders->links() }}</div>
        </div>
    @else
        <div class="d-flex justify-content-center mt-5">
            <h5 class="text-danger text-center">There is no Order !</h5>
        </div>
    @endif
</div>
@endsection

@section('script_source')
    <script>
        $(document).ready(function(){
            $('.changeStatus').change(function(){
                let parentNode = $(this).parents('tr');
                let OrderId = parentNode.find('.orderId').val();
                let currentVal = $(this).val();
                console.log(OrderId,currentVal);
                $.ajax({
                    type : 'get',
                    url : '/admin/change/order/status',
                    data : {
                        'orderId' : OrderId,
                        'currentVal' : currentVal
                    },
                    datatype : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endsection
