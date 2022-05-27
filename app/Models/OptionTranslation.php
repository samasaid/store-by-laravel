<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    use HasFactory;

    protected $table = 'option_translations';
    public $timestamps = false;

    protected $fillable = ['name'];
}
