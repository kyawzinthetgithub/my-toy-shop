<?php

namespace App\Http\Controllers\ajax;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    //get category
    public function deleteCatagory(){
        $data = Category::get();
        return $data;
    }

    //delete category
    public function delete(Request $request){
        $data = Category::where('id',$request->catId)->first();

        if($data['image'] != null){
            Storage::delete('public/category/'.$data['image']);
        }

        Category::where('id',$request->catId)->delete();

        return response()->json([
            'status' => 'success'
        ],200);
    }

    //get products
    public function getProduct(){
        $products = Product::get();
        return $products;
    }

    //delete products
    public function deleteProduct(Request $request){
        $data = Product::where('id',$request->catId)->first();

        if($data['image'] != null){
            Storage::delete('public/products/'.$data['image']);
        }
        Product::where('id',$request->catId)->delete();

        return response()->json([
            'status' => 'success'
        ],200);
    }

    //change order Status
    public function changeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->currentVal
        ]);
        return response()->json([
            'status' => 'success',
        ],200);
    }

}
