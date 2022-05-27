<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Brand extends Model
{
    use HasFactory;
    use Translatable;
    protected $table = 'brands';
    public $timestamps = true;
    /**
     * the relations to eager load on every query
     *
     * @var arrey
    */
    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];//ده متغير بيتحط مع الباكدج بتاعت الترجمه بحط جواها اللى هيترجم
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active' , 'photo'];
    /**
     * The attributes that should be cast tonative type
     *
     * @var array
     */
    protected $casts = [
        'is_active'=>'boolean',
    ];
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

}
