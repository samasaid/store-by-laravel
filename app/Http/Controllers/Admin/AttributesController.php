<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributsRequest;
use App\Models\Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    public function index(){
        $attributs = Attribute::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.attributs.index' , compact('attributs'));
    }
    public function create(){
        return view('admin.attributs.create');
    }
    public function store(AttributsRequest $request){
        //validation
        // return $request;
        //insert
        try{
            DB::beginTransaction();
            $attribut = Attribute::create([]);
            // save translation
            $attribut->name = $request->name;
            $attribut->save();
            DB::commit();
            return redirect()->route('admin.attributs')->with(["success"=>"تم حفظ الخاصية بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.attributs')->with(["error"=>"لم يتم حفظ الخاصية حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $attribut = Attribute::find($id);
        if(!$attribut){
            return redirect()->route('admin.attributs')->with(["error"=>"هذة الخاصية غير موجودة"]);
        }
        return view('admin.attributs.edit' , compact('attribut'));
    }
    public function update(AttributsRequest $request , $id){
        // return $request;
        try{
            $attribut = Attribute::find($id);
            if(!$attribut){
                return redirect()->route('admin.brands')->with(["error"=>"هذة الخاصية غير موجودة"]);
            }

            DB::beginTransaction();

            $attribut->name = $request->name;
            $attribut->save();
            DB::commit();
            return redirect()->route('admin.attributs')->with(["success"=>"تم تحديث الخاصية بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.attributs')->with(["error"=>"لم يتم تحديث الخاصية حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $attribut = Attribute::find($id);
            if(!$attribut){
                return redirect()->route('admin.attributs')->with(["error"=>"هذة الخاصية غير موجودة"]);
            }
            DB::beginTransaction();
            $attribut['translation']->delete();
            $attribut->delete();
            DB::commit();
            return redirect()->route('admin.attributs')->with(["success"=>"تم حذف الخاصية بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.attributs')->with(["error"=>"لم يتم حذف الخاصية حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
}
