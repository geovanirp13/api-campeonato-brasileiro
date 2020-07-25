<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['fullName', 'name', 'image', 'abbreviation', 'nickname', 'color', 'stadium'];
}
