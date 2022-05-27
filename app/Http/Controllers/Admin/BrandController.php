<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('id' , 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.brands.index' , compact('brands'));
    }
    public function create(){
        return view('admin.brands.create');
    }
    public function store(BrandRequest $request){
        //validation
        // return $request;
        //insert
        try{
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            $filePath = '';
            if($request->has('photo')){
                $filePath = uploadImage('brands' , $request->photo);
            }
            DB::beginTransaction();
            $brand = Brand::create([
                "photo"=>$filePath,
                "is_active"=>$request->is_active
            ]);
            // save translation
            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(["success"=>"تم حفظ الماركة بنجاح"]);
        }catch(Exception $ex){
            // return $ex;
            return redirect()->route('admin.brands')->with(["error"=>"لم يتم حفظ الماركة حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $brand = Brand::find($id);
        if(!$brand){
            return redirect()->route('admin.brands')->with(["error"=>"هذة الماركة غير موجودة"]);
        }
        return view('admin.brands.edit' , compact('brand'));
    }
    public function update(BrandRequest $request , $id){
        // return $request;
        try{
            $brand = Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands')->with(["error"=>"هذة الماركة غير موجودة"]);
            }
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            DB::beginTransaction();
            if($request->has('photo')){
                $filePath = uploadImage('brands' , $request->photo);
                $brand->update([
                    "photo"=>$filePath,
                ]);
            }
            $brand->is_active=$request->is_active;
            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(["success"=>"تم تحديث الماركة بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.brands')->with(["error"=>"لم يتم تحديث الماركة حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $brand = Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands')->with(["error"=>"هذة الماركة غير موجودة"]);
            }
            $brand->delete();
            return redirect()->route('admin.brands')->with(["success"=>"تم حذف الماركة بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.brands')->with(["error"=>"لم يتم حذف الماركة حاول مرة اخرى"]);
        }
    }
    public function ChangeStatus($id){
        try{
            $brand = Brand::find($id);
            if(!$brand){
                return redirect()->route('admin.brands')->with(["error"=>"هذة الماركة غير موجودة"]);
            }
            if($brand->is_active == 1){
                $brand->update(["is_active"=>0]);
            }else{
                $brand->update(["is_active"=>1]);
            }
            return redirect()->route('admin.brands')->with(["success"=>"تم تغير حالة الماركة بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.brands')->with(["error"=>"لم يتم تغير حالة الماركة حاول مرة اخرى"]);
        }
    }
}
