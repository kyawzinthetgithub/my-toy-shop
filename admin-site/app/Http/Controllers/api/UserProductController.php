<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProductController extends Controller
{
    //get all product
    public function getAllProduct(){
        $products = Product::paginate(6);
        return response()->json([
            'products' => $products,
            'status' => 'success'
        ]);
    }

    // product search
    public function searchProduct(Request $request){
       $searchProduct = Product::when(request('Key'),function($query){
        $query->where('product_name','LIKE','%'.request('Key').'%');
       })->paginate(6);
       return response()->json([
        'products' => $searchProduct,
        'status' => 'success'
    ]);
    }

    //product details
    public function productDetails(Request $request){
        $product = Product::select('products.*','categories.category_name')->leftJoin('categories','products.category_id','categories.id')->where('products.id',$request->productId)->first();
        return response()->json([
            'product' => $product,
        ]);

    }
}
