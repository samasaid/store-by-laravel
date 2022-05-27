<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('id' , 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.tags.index' , compact('tags'));
    }
    public function create(){
        return view('admin.tags.create');
    }
    public function store(TagsRequest $request){
        //validation
        // return $request;
        //insert
        try{

            DB::beginTransaction();
            $tag = Tag::create([
                "slug"=>removeWhiteSpace($request->slug),
            ]);
            // save translation
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(["success"=>"تم حفظ العلامة بنجاح"]);
        }catch(Exception $ex){
            // return $ex;
            return redirect()->route('admin.tags')->with(["error"=>"لم يتم حفظ العلامة حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function edit($id){
        $tag = Tag::find($id);
        if(!$tag){
            return redirect()->route('admin.tags')->with(["error"=>"هذة العلامة غير موجودة"]);
        }
        return view('admin.tags.edit' , compact('tag'));
    }
    public function update(TagsRequest $request , $id){
        // return $request;
        try{
            $tag = Tag::find($id);
            if(!$tag){
                return redirect()->route('admin.tags')->with(["error"=>"هذة العلامة غير موجودة"]);
            }
            DB::beginTransaction();

            $tag->slug = $request->slug;
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(["success"=>"تم تحديث العلامة بنجاح"]);
        }catch(Exception $ex){
            return $ex;
            return redirect()->route('admin.tags')->with(["error"=>"لم يتم تحديث العلامة حاول مرة اخرى"]);
            DB::rollBack();
        }
    }
    public function destroy($id){
        try{
            $tag = Tag::find($id);
            if(!$tag){
                return redirect()->route('admin.tags')->with(["error"=>"هذة العلامة غير موجودة"]);
            }
            $tag->delete();
            return redirect()->route('admin.tags')->with(["success"=>"تم حذف العلامة بنجاح"]);
        }catch(Exception $ex ){
            return redirect()->route('admin.tags')->with(["error"=>"لم يتم حذف العلامة حاول مرة اخرى"]);
        }
    }
}
