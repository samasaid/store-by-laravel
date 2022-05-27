<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;
    protected $table = 'products';
    public $timestamps = true;
    /**
     * the relations to eager load on every query
     *
     * @var arrey
    */
    protected $with = ['translations'];

    protected $translatedAttributes = ['name' , 'description' , 'short_description'];//ده متغير بيتحط مع الباكدج بتاعت الترجمه بحط جواها اللى هيترجم
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];
    /**
     * The attributes that should be cast tonative type
     *
     * @var array
     */
    protected $casts = [
        'manage_stock'=>'boolean',
        'in_stock'=>'boolean',
        'is_active'=>'boolean',
    ];
    // relation between Brands and Products
    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault();
    }
    // relation between categories and producta
    public function categories(){
        return $this->belongsToMany(Category::class , 'product_category');
    }
    // relation between tags and producta
    public function tags(){
            return $this->belongsToMany(Tag::class , 'product_tag');
     }
    // relation between images and producta
    // public function images(){
    //     return $this->belongs(Tag::class , 'product_tag');
    // }
    // this is function return active for 1 and return nit active for 0
    public function getIs_active(){
        return $this->is_active ==1 ? "مفعل":"غير مفغل" ;
    }
    public function scopeActive($query){
        return $query->where("is_active" ,1);
    }
    // this function for add assets folder before image filepath
   public function getPhotoAttribute($val){
    return ($val !== null) ? asset('assets/'.$val): "";
   }
   public function options(){
       return $this->hasMany(Option::class , 'product_id');
   }
}
