<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    // get order list for customer
    public function getOrderList(Request $request){
        $allLists = OrderList::select('order_lists.*','products.product_name','products.product_price','products.image')
                    ->join('products','order_lists.product_id','products.id')
                    ->where('order_lists.order_code',$request->ListCode)->orderBy('created_at','desc')->get();
        return response()->json([
            'allLists' => $allLists
        ]);
    }
}
