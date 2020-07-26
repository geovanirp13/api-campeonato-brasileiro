<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ['name', 'age', 'image', 'club_id'];

    public function club() {
        return $this->belongsTo(Club::class);
    }
}
