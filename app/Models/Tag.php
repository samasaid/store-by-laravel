<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Tag extends Model
{
    use HasFactory;
    use Translatable;
    protected $table = 'tags';
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
    protected $fillable = ['slug'];
    /**
     * The attributes that should be cast tonative type
     *
     * @var array
     */
    protected $casts = [
        'is_active'=>'boolean',
    ];

}
