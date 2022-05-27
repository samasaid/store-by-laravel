<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersVerfication extends Model
{
    use HasFactory;
    protected $table = 'users_verfication_codes';
    public $timestamps = true;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'code', 'created_at','updated_at'];
}
