<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCartController extends Controller
{
    //add product to cart
    public function addProduct(Request $request){
        $data = $this->cartdata($request);
        Cart::create($data);
        return response()->json([
            'status' => 'success',
        ]);
    }

    //get cart items
    public function getCartItems(Request $request){
       $getCart = Cart::select('carts.*','products.id as product_id','products.product_name','products.made_by','products.size','products.made_country')->leftJoin('products','carts.product_id','products.id')->where('user_id',$request->userId)->get();
       return response()->json([
        'cartItems' => $getCart,
        'status' => 'success'
       ]);
    }

    //remove current cart
    public function removeCurrentCart(Request $request){
        Cart::where('id',$request->cartId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }



    // return cartdata
    private function cartdata($request){
        return [
            'user_id' => $request->user,
            'product_id' => $request->productId,
            'category_id' => $request->productCat,
            'qty' => $request->qty,
            'price' => $request->price,
            'image' => $request->image,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
