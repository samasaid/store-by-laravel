<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index(){
        $defaultLang = lacaleLanguage();
        $categories = Category::child()->orderBy('id' , 'DESC')->paginate(PAGINATION_COUNT);
        // $categories = $categories->where('locale' , $defaultLang);
        return view('admin.subcategories.index' , compact('categories'));
    }
    public function create(){
         $mainCategories = Category::parent()->get();
        return view('admin.subcategories.create' , compact('mainCategories'));
    }
    public function store(SubCategoryRequest $request){
        //validation
        // return $request;
        //insert
        try{
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            $filePath = '';
            if($request->has('photo')){
                $filePath = uploadImage('maincategories' , $request->photo);
            }
            DB::beginTransaction();
            $category = Category::create([
                "photo"=>$filePath,
                "slug"=>removeWhiteSpace($request->slug),
                // "patent_id"=>$request->parent_id,
                "is_active"=>$request->is_active
            ]);
            $category->parent_id = $request->parent_id;
            // save translation
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.subCategories')->with(["success"=>"تم حفظ القسم بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.subCategories')->with(["error"=>"لم يتم حفظ القسم حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $mainCategories = Category::parent()->get();
        $category = Category::find($id);
        if(!$category){
            return redirect()->route('admin.mainCategories')->with(["error"=>"هذا القسم غير موجود"]);
        }
        return view('admin.subcategories.edit' , compact(['category' , 'mainCategories']));
    }
    public function update(SubCategoryRequest $request , $id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.subCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            DB::beginTransaction();
            if($request->has('photo')){
                $filePath = uploadImage('maincategories' , $request->photo);
                $category->update([
                    "photo"=>$filePath,
                ]);
            }
            $category->update(['slug'=>removeWhiteSpace($request->slug),'is_active'=>$request->is_active]);
            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->save();
            DB::commit();
            return redirect()->route('admin.subCategories')->with(["success"=>"تم تحديث القسم بنجاح"]);
        }catch(Exception $ex){
            return redirect()->route('admin.subCategories')->with(["error"=>"لم يتم تحديث القسم حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.subCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            $category->delete();
            return redirect()->route('admin.subCategories')->with(["success"=>"تم حذف القسم بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.subCategories')->with(["error"=>"لم يتم حذف القسم حاول مرة اخرى"]);
        }
    }
    public function ChangeStatus($id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.subCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            if($category->is_active == 1){
                $category->update(["is_active"=>0]);
            }else{
                $category->update(["is_active"=>1]);
            }
            return redirect()->route('admin.subCategories')->with(["success"=>"تم تغير حالة القسم بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.subCategories')->with(["error"=>"لم يتم تغير حالة القسم حاول مرة اخرى"]);
        }
    }
}
