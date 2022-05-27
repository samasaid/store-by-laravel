<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    public function index(){
        $defaultLang = lacaleLanguage();
        $categories = Category::with('_parent')->orderBy('id' , 'DESC')->paginate(PAGINATION_COUNT);
        // $categories = $categories->where('locale' , $defaultLang);
        return view('admin.maincategories.index' , compact('categories'));
    }
    public function create(){
        $categories = Category::select('id' , 'parent_id')->get();
        return view('admin.maincategories.create' , compact('categories'));
    }
    public function store(MainCategoryRequest $request){
        //validation
        // return $request;
        //insert
        try{
            if($request->type == CategoryType::mainCategory){
                $request->request->add(['parent_id' , null]);
            }elseif($request->type == CategoryType::subCategory){
                $request->request->add(["parnet_id" , $request->parent_id]);
            }else{
                return redirect()->back()->with(["error"=>"هذا الاختيار غير موجود حاول مرة اخرى"]);
            }
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
                "is_active"=>$request->is_active,
                "parent_id"=>$request->parent_id
            ]);
            // save translation
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.mainCategories')->with(["success"=>"تم حفظ القسم بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.mainCategories')->with(["error"=>"لم يتم حفظ القسم حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $categories = Category::select('id' , 'parent_id')->get();
        $category = Category::find($id);
        if(!$category){
            return redirect()->route('admin.mainCategories')->with(["error"=>"هذا القسم غير موجود"]);
        }
        return view('admin.maincategories.edit' , compact(['category' ,'categories']));
    }
    public function update(MainCategoryRequest $request , $id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.mainCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            if($request->type == 1){
                $request->request->add(['parent_id' , null]);
            }elseif($request->type == 2){
                $request->request->add(["parnet_id" , $request->parent_id]);
            }else{
                return redirect()->back()->with(["error"=>"هذا الاختيار غير موجود حاول مرة اخرى"]);
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
            $category->update([
                'slug'=>removeWhiteSpace($request->slug),
                'is_active'=>$request->is_active,
                "parent_id"=>$request->parent_id
            ]);
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.mainCategories')->with(["success"=>"تم تحديث القسم بنجاح"]);
        }catch(Exception $ex){
            return redirect()->route('admin.mainCategories')->with(["error"=>"لم يتم تحديث القسم حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.mainCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            $category->delete();
            return redirect()->route('admin.mainCategories')->with(["success"=>"تم حذف القسم بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.mainCategories')->with(["error"=>"لم يتم حذف القسم حاول مرة اخرى"]);
        }
    }
    public function ChangeStatus($id){
        try{
            $category = Category::find($id);
            if(!$category){
                return redirect()->route('admin.mainCategories')->with(["error"=>"هذا القسم غير موجود"]);
            }
            if($category->is_active == 1){
                $category->update(["is_active"=>0]);
            }else{
                $category->update(["is_active"=>1]);
            }
            return redirect()->route('admin.mainCategories')->with(["success"=>"تم تغير حالة القسم بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.mainCategories')->with(["error"=>"لم يتم تغير حالة القسم حاول مرة اخرى"]);
        }
    }
}
