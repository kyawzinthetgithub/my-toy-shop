<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCategoryController extends Controller
{
    //get all category
    public function getAllCategory()
    {
        $categories = Category::get();
        return response()->json([
            'categories' => $categories,
            'status' => 'success'
        ]);
    }

    // category search
    public function searchCategory(Request $request)
    {
        $searchCate = Category::select('products.*')->join('products', 'categories.id', 'products.category_id')->where('categories.category_name','LIKE','%'.$request->key.'%')->paginate(6);
        return response()->json([
            'categories' => $searchCate,
            'status' => 'success'
        ]);
    }
}
