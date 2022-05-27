<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\addPriceRequest;
use App\Http\Requests\addStockRequest;
use App\Http\Requests\GeneralProductsRequest;
use App\Http\Requests\ProductImageRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::select('id' , 'slug' ,'price' , 'created_at')->paginate(PAGINATION_COUNT);
        return view('admin.products.general.index' , compact('products'));
    }
    public function create(){
        $data = [];
        $data['categories'] = Category::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['brands'] = Brand::active()->select('id')->get();
        return view('admin.products.general.create' , $data);
    }
    public function store(GeneralProductsRequest $request){
        //validation
        // return $request;
        //insert
        // return $request;
        try{
            if(!$request->has('is_active')){
                $request->request->add(['is_active'=>0]);
            }
            DB::beginTransaction();
            $product = Product::create([
                "slug"=>removeWhiteSpace($request->slug),
                "is_active"=>$request->is_active,
                "brand_id"=>$request->brand_id
            ]);
            // save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();
            // save product categories
            $product->categories()->attach($request->categories);
            // save product tags
            $product->tags()->attach($request->tags);
            DB::commit();
            return redirect()->route('admin.products')->with(["success"=>"تم حفظ المنتج بنجاح"]);
        }catch(Exception $ex){
            // return $ex;
            return redirect()->route('admin.products')->with(["error"=>"لم يتم حفظ المنتج حاول مرة اخرى"]);
            DB::rollBack();
        }

    }
    public function getPrice($id){
        $price = Product::select('id','price','special_price','special_price_type','special_price_start','special_price_end')->find($id);
        return view('admin.products.price.create' , compact('price'));
    }
    public function addPrice(addPriceRequest $request){
        try{
            Product::whereId($request->product_id)->update($request->only(['price','special_price','special_price_type','special_price_start','special_price_end']));
            return redirect()->route('admin.products')->with(["success"=>"تم حفظ السعر بنجاح"]);

        }catch(Exception $ex){
            return redirect()->route('admin.products')->with(["error"=>"لم يتم حفظ السعر حاول مرة اخرى"]);
        }
    }
    public function getStock($id){
        $stock = Product::select('id','sku','manage_stock','in_stock','qty')->find($id);
        return view('admin.products.stock.create' , compact('stock'));
    }
    public function addStock(addStockRequest $request){
        // return $request;
        try{
            Product::whereId($request->product_id)->update($request->only(['sku','manage_stock','in_stock','qty']));
            return redirect()->route('admin.products')->with(["success"=>"تم حفظ المستودع بنجاح"]);

        }catch(Exception $ex){
            return redirect()->route('admin.products')->with(["error"=>"لم يتم حفظ المستودع حاول مرة اخرى"]);
        }
    }
    public function getImages($id){
        return view('admin.products.images.create' )->with('id' , $id);
    }
    //save images in folder only not to db
    public function addImages(Request $request){
        $file = $request->file('dzfile');
        $fileName = uploadImage('products' , $file);
        return response()->json([
            'name'=>$fileName,
            'original_name'=>$file->getClientOriginalName()
        ]);
    }
    public  function addDbImages(ProductImageRequest $request){
        try {
            if($request->has('document') && count($request->document) > 0){
                foreach($request->document as $doc){
                    Image::create([
                        "product_id"=>$request->product_id,
                        "photo"=>$doc,
                    ]);
                }
            }
            return redirect()->route('admin.products')->with(["success"=>"تم حفظ الصور بنجاح"]);
        } catch (Exception $ex) {
            return redirect()->route('admin.products')->with(["error"=>"لم يتم حفظ الصور حاول مرة اخرى"]);
        }
    }
}
