<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //rating product
    public function ratingProduct(Request $request){
        $data = $this->returnRating($request);
        Rating::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    //get rating
    public function getRating(Request $request){
        $returnData = Rating::where('user_id',$request->userId)->where('product_id',$request->productId)->orderBy('created_at','desc')->first();
        return response()->json([
            'ratings' => $returnData
        ]);
    }

    //get average Rating
    public function averageRating(Request $request){
        $avRating = Rating::select('rating_count')->where('product_id',$request->productId)->avg('rating_count');
        return response()->json([
            'average' => $avRating
        ]);
    }

    // return rating data
    private function returnRating($request){
        return [
            'user_id' => (int)$request->userId,
            'product_id' => (int)$request->productId,
            'rating_count' => $request->ratingVal
        ];
    }
}
