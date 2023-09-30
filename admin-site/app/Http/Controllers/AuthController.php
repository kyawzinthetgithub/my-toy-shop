<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login page

    public function login(){
        return view('login');
    }

    //direct register page
    public function register(){
        return view('register');
    }

    //direct dashboard page
    public function dashboard(){
        if (Auth::user()->role == 'admin') {
            $datas = OrderList::select(DB::raw('SUM(order_lists.qty) as total_order'),'products.product_name')
                        ->groupBy('products.product_name')
                        ->leftJoin('products','order_lists.product_id','products.id')
                        ->get();

            return view('admin.dashboard',compact('datas'));
        }
        return abort(403);
    }
}
