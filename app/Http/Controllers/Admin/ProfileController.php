<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit_profile(){
        $id = auth('admin')->user()->id;
        $admin = Admin::find($id);
        return view('admin.profile.edit' , compact('admin'));
    }
    public function update_profile(ProfileRequest $request){
        try{
            // return $request;
            $id = auth('admin')->user()->id;
            $admin = Admin::find($id);
            // return $admin;
            //  return $admin->password;
            if($request->filled('password')){
                    $request->merge(['password'=> bcrypt($request->password)]);
            }else{
                $request->merge(['password'=>$admin->password]);
            }
            unset($request['id']);
            unset($request['password_confirmation']);
            $admin->update($request->all());
            // return $request;
            return redirect()->back()->with(['success'=>'تم تحديث البيانات بنجاح']);
        }catch(Exception $ex){
            return$ex;
            return redirect()->back()->with(['error'=>'لم يتم تحديث البيانات حاول مرة اخرى ']);
        }
    }
}
