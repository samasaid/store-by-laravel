<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $table = 'product_translations';
    public $timestamps = false;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' , 'description' , 'short_description'];
}
