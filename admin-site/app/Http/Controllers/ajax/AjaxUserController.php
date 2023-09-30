<?php

namespace App\Http\Controllers\ajax;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxUserController extends Controller
{
    // direct user list
    public function userList(){
        $users = User::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%')->orWhere('address','like','%'.request('searchKey').'%');
        })->where('role','user')->paginate(5);
        $users->appends(request()->all());
        return view('admin.other.userList',compact('users'));
    }

    // user delete
    public function userDelete(Request $request){
        User::where('id',$request->DelId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //user change role
    public function userChangeRole(Request $request){
        User::where('id',$request->usrId)->update([
            'role' => $request->Role,
            'updated_at' => Carbon::now()
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
