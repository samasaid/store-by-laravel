<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute as ModelsAttribute;
use App\Models\Option;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
    public function index(){
        $options = Option::orderBy('id' , 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.options.index' , compact('options'));
    }
    public function create(){
        $date = [];
        $data['products']= Product::active()->select('id')->get();
        $data['attributes'] = ModelsAttribute::select('id')->get();
        return view('admin.options.create' , $data);
    }
    public function store( OptionRequest $request){
        //validation
        // return $request;
        //insert
        try{

            DB::beginTransaction();
            $option = Option::create([
                "attribute_id"=>$request->attribute_id,
                "product_id"=>$request->product_id,
                "price"=>$request->price
            ]);
            // save translation
            $option->name = $request->name;
            $option->save();
            DB::commit();
            return redirect()->route('admin.options')->with(["success"=>"تم حفظ القيمة بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.options')->with(["error"=>"لم يتم حفظ القيمة حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $date = [];
        $data['option'] = Option::find($id);
        $data['products']= Product::active()->select('id')->get();
        $data['attributes'] = ModelsAttribute::select('id')->get();
        if(!$data['option']){
            return redirect()->route('admin.options')->with(["error"=>"هذة القيمة غير موجودة"]);
        }
        return view('admin.options.edit' , $data);
    }
    public function update(OptionRequest $request , $id){
        // return $request;
        try{
            $option = Option::find($id);
            if(!$option){
                return redirect()->route('admin.options')->with(["error"=>"هذة القيمة غير موجودة"]);
            }

            DB::beginTransaction();
            $option->update([
                "attribute_id"=>$request->attribute_id,
                "product_id"=>$request->product_id,
                "price"=>$request->price
            ]);
            $option->name = $request->name;
            $option->save();
            DB::commit();
            return redirect()->route('admin.options')->with(["success"=>"تم تحديث القيمة بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.options')->with(["error"=>"لم يتم تحديث القيمة حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $option = Option::find($id);
            if(!$option){
                return redirect()->route('admin.options')->with(["error"=>"هذة القيمة غير موجودة"]);
            }
            $option['translation']->delete();
            $option->delete();
            return redirect()->route('admin.options')->with(["success"=>"تم حذف القيمة بنجاح"]);
        }catch(Exception $ex ){
            return $ex;
            return redirect()->route('admin.options')->with(["error"=>"لم يتم حذف القيمة حاول مرة اخرى"]);
        }
    }

}
