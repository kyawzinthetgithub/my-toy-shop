<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //direct admin profile
    public function adminProfile(){
        $admins = User::where('id',Auth::user()->id)->first();
        return view('admin.profile',compact('admins'));
    }

    //direct admin page
    public function profileEdit(){
        return view('admin.edit');
    }

    //update admin account
    public function profileUpdate($id , Request $request){
        $this->personalValidation($request);
        $data = $this->updateInformation($request);

        //update image

        if ($request->hasFile('userImage')) {
            $dbImg = User::where('id',$id)->first();
            $dbImg = $dbImg->image;

            if ($dbImg != null) {
                Storage::delete('public/account/'.$dbImg);
            }

            $inputImage = uniqid().'_anitoy_'.$request->file('userImage')->getClientOriginalName();
            $request->file('userImage')->storeAs('public/account/',$inputImage);
            $data['image'] = $inputImage;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#profile')->with(['updated' => 'Account Update Success...']);

    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashPassword = $user->password;

        if(Hash::check($request->oldPassword, $dbHashPassword)){
            $updatePassword = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($updatePassword);
            return redirect()->route('admin#login')->with(['changeSuccess' => 'Password Change Success! Please Login Again!']);
        }else{
            return back()->with(['notMatch' => 'Old Password and New Password not same...']);
        }
    }

    //direct admin list
    public function adminList(){
        $users = User::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%')->orWhere('address','like','%'.request('searchKey').'%');
        })->where('role','admin')->paginate(5);
        $users->appends(request()->all());
        return view('admin.other.adminList',compact('users'));
    }

    // admin delete
    public function adminDelete(Request $request){
        User::where('id',$request->DelId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //admin change role
    public function adminChangeRole(Request $request){
        User::where('id',$request->usrId)->update([
            'role' => $request->Role,
            'updated_at' => Carbon::now()
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }


    //________________________________________________________________



    //personal validation check
    private function personalValidation($request){
        validator::make($request->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'userPhone' => 'required',
            'userAddress' => 'required',
            'userGender' => 'required',
            'userImage' => 'mimes:jpg,jpeg,png,gif,svg,webp'
        ])->validate();
    }

    //update personal information
    private function updateInformation($request){
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'phone' => $request->userPhone,
            'address' => $request->userAddress,
            'gender' => $request->userGender,
            'role' => $request->userRole,
            'updated_at' => Carbon::now()
        ];
    }

    //password validation check
    private function passwordValidationCheck($request){
        validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:12',
            'newPassword' => 'required|min:6|max:12',
            'confirmPassword' => 'required|min:6|max:12|same:newPassword'
        ])->validate();
    }

}
