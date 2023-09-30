<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //create order List and order with order code
    public function createOrder(Request $request)
    {
        $total = 0;
        foreach ($request->all() as $lists) {
            $orders = OrderList::create([
                'user_id' => $lists['userId'],
                'product_id' => $lists['productId'],
                'qty' => $lists['qty'],
                'total' => $lists['total'],
                'order_code' => $lists['orderCode']
            ]);
            $total += $orders->total;
        }

        Cart::where('user_id', $request[0]['userId'])->delete();

        Order::create([
            'user_id' => $orders->user_id,
            'order_code' => $orders->order_code,
            'total_price' => $total + 3000,
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }

    //get order datas for customer
    public function getOrder(Request $request)
    {
        $orders = Order::where('user_id', $request->userId)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'orders' => $orders
        ]);
    }

    //______________________________________________________________________________________________

    // admin direct order List
    public function orderList()
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $orders->append(request()->all());
        return view('admin.order.orderList', compact('orders'));
    }

    //sorting order
    public function sortOrder(Request $request)
    {
        // dd($request->orderStatus);
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('created_at', 'desc');

        if ($request->orderStatus == null) {
            $orders = $orders->paginate(5);
        }else{
            $orders = $orders->where('orders.status',$request->orderStatus)->paginate(5);
        }
        return view('admin.order.orderList', compact('orders'));
    }

    //check order List
    public function checkOrderList($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderLists = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.product_name')
            ->leftJoin('users','order_lists.user_id','users.id')
            ->leftJoin('products','order_lists.product_id','products.id')
            ->where('order_lists.order_code',$orderCode)
            ->paginate(5);
        return view('admin.order.orderProductList',compact('orderLists','order'));
    }
}
