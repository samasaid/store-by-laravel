<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function edit_shipping($type){
        if($type == "free")
            $shippingMethod = Setting::where('key' , 'free_shipping_label')->first();
        elseif($type == "inner")
            $shippingMethod = Setting::where('key' , 'local_label')->first();
        elseif($type == "outer")
            $shippingMethod = Setting::where('key' , 'outer_label')->first();
        else
            $shippingMethod = Setting::where('key' , 'free_shipping_label')->first();

        return view('admin.settings.shippings.edit' , compact('shippingMethod'));
    }
    public function update_shipping(ShippingsRequest $request , $id){
        //validation in another class called ShippingsRequest
        // return $request;
        //update date
        try{
            $shipping_method = Setting::find($id);
            if(!$shipping_method){
                return redirect()->back()->with(['error'=>'وسيلة التوصيل غير موجودة']);
            }
            DB::beginTransaction();
            $shipping_method->update(["plain_value"=>$request->plain_value]);
            $shipping_method->value = $request->value;
            $shipping_method->save();
            DB::commit();
            return redirect()->back()->with(['success'=>'تم تحديث البيانات بنجاح']);
        }catch(Exception $ex){
            return $ex;
            return redirect()->back()->with(['error'=>'لم يتم تحديث البيانات حاول مرة اخرى ']);
            DB::rollBack();
        }


    }
}
