<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['fullName', 'name', 'age', 'image', 'position', 'number', 'status', 'club_id'];

    public function club() {
        return $this->belongsTo(Club::class);
    }
}


