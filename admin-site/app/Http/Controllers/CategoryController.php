<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //direct category list
    public function categoryList(){
        $datas = Category::when(request('key'),function($query){
            $query->where('category_name','like','%'.request('key').'%');
        })->paginate(4);
        $datas->appends(request()->all());
        return view('admin.category.categorylist',compact('datas'));
    }

    //direct category page
    public function categoryCreate(){
        return view('admin.category.create');
    }

    //create category
    public function createCategory(Request $request){
        $this->checkValidation($request);
        $data = $this->catedata($request);

        if ($request->hasFile('categoryImage')) {
            $imgName = uniqid().'_anitoy_'.$request->file('categoryImage')->getClientOriginalName();
            $request->file('categoryImage')->storeAs('public/category/',$imgName);
            $data['image'] = $imgName;
        }
        Category::create($data);
        return redirect()->route('admin#categoryList');
    }

    //direct edit category page
    public function categoryEdit($id, Request $request){
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    //update category
    public function update(Request $request){
        $this->checkValidation($request);
        $data = $this->catedata($request);

        if($request->hasFile('categoryImage')){
            $dbimg = Category::select('image')->where('id',$request->categoryId)->first();
            $dbimg = $dbimg['image'];

            if($dbimg != null){
                Storage::delete('public/category/'.$dbimg);
            }

            $Image = uniqid().'_anitoy_' . $request->file('categoryImage')->getClientOriginalName();
            $request->file('categoryImage')->storeAs('public/category/',$Image);
            $data['image'] = $Image;
        }

        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('admin#categoryList')->with(['updated' => 'Category Update Success !']);

    }




    //________________________________________________________________________

    //check Create Category Validation
    private function checkValidation($request){
        validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,category_name,'.$request->categoryId,
            'categoryImage' => 'mimes:jpg,jpeg,png,gif,webp'
        ])->validate();
    }

    // return category create data

    private function catedata($request){
        return [
            'category_name' => $request->categoryName,
            'updated_at' => Carbon::now(),
        ];
    }

}
