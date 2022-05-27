<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    protected $table = "categories";
    public $timestamps = true;
    /**
     * the relations to eager load on every query
     *
     * @var arrey
    */
    protected $with = ['translations'];

    protected $translatedAttributes = ['name' , 'locale'];//ده متغير بيتحط مع الباكدج بتاعت الترجمه بحط جواها اللى هيترجم
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id' , 'photo','slug' , 'is_active'];
     /**
     * The attributes that should be hidden for serialization
     *
     * @var array
     */
    // protected $hidden = ['translations'];
    /**
     * The attributes that should be cast tonative type
     *
     * @var array
     */
    protected $casts = [
        'is_active'=>'boolean',
    ];
    protected $slugAttribute = 'name';
    // this is function for return null parent_id == mainCategories
    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }
    // this is function for return not null parent_id == Subcategories
    public function scopeChild($query){
        return $query->whereNotNull('parent_id');
    }
    // this is function return active for 1 and return nit active for 0
    public function getIs_active(){
        return $this->is_active ==1 ? "مفعل":"غير مفغل" ;
    }
    // this function for add assets folder before image filepath
   public function getPhotoAttribute($val){
    return ($val !== null) ? asset('assets/'.$val): "";
   }
   // return active categories
   public function scopeActive($query){
    return $query->where('is_active' , 1);
   }
   //Relation between main and sub category
   public function childerns(){
    return $this->hasMany(self::class,'parent_id');
    }
   public function _parent(){
        return $this->belongsTo(self::class,'parent_id');
        }
   }
