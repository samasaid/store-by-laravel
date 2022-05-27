<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use Translatable;
    protected $table = 'options';
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
    protected $fillable = ['attribute_id','product_id' , 'price'];
    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }
    public function attribut(){
        return $this->belongsTo(Attribute::class , 'attribute_id');
    }
}
