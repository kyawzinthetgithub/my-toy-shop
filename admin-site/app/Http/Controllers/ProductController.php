<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //direct product list page
    public function productList(){
        $products = Product::select('products.*','categories.category_name')->when(request('key'),function($query){
            $query->where('product_name','like','%'.request('key').'%')->orWhere('category_name','like','%'.request('key').'%');
        })->leftJoin('categories','products.category_id','categories.id')
          ->paginate(4);
        $products->appends(request()->all());
        return view('admin.products.productlists',compact('products'));
    }

    //direct product create page
    public function productCreate(){
        $categories = Category::get();
        return view('admin.products.create',compact('categories'));
    }

    //post product
    public function productPost(Request $request){
        $this->postvalidationCheck($request);
        $products = $this->returnProducts($request);

        if($request->hasFile('productImage')){
            $productImgName = uniqid().'_anitoy_'.$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/products/',$productImgName);
            $products['image'] = $productImgName;
        }

        Product::create($products);
        return redirect()->route('admin#productList');
    }

    //direct detail page
    public function productDetail($id){
        $product = Product::select('products.*','categories.category_name')->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();

        return view('admin.products.detail',compact('product'));
    }

    //direct update page
    public function productUpdate($id){
        $categories = Category::get();
        $product = Product::where('id',$id)->first();
        return view('admin.products.update',compact('categories','product'));
    }

    //update product
    public function updateProduct(Request $request){
        $this->postvalidationCheck($request);
        $products = $this->returnProducts($request);

        if($request->hasFile('productImage')){
            $olddbimg = Product::where('id',$request->productId)->first();
            $olddbimg = $olddbimg['image'];

            if($olddbimg != null){
                Storage::delete('public/products/'.$olddbimg);
            }

            $newImg = uniqid().'_anitoy_'.$request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public/products/',$newImg);
            $products['image'] = $newImg;

        }

        Product::where('id',$request->productId)->update($products);
        return redirect()->route('admin#productList')->with(['update'=>'Product Update Success !']);
    }

    //chart product
    public function productChart(){
        return view('admin.chart.productchart');
    }



    //________________________________________________________________________________________

    //post validation check
    private function postvalidationCheck($request){
        validator::make($request->all(),[
            'productName' => 'required|unique:products,product_name,'.$request->productId,
            'categoryId' => 'required',
            'productSize' => 'required',
            'productDetails' => 'required',
            'productPrice' => 'required',
            'productMade' => 'required',
            'productMadeCountry' => 'required',
            'productImage' => 'mimes:jpg,jpeg,png,gif,webp'
        ])->validate();
    }

    //return product data
    private function returnProducts($request){
        return [
            'product_name' => $request->productName,
            'category_id' => $request->categoryId,
            'size' => $request->productSize,
            'product_price' => $request->productPrice,
            'product_detail' => $request->productDetails,
            'made_by' => $request->productMade,
            'made_country' => $request->productMadeCountry,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
