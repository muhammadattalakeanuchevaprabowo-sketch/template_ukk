<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'division_id'];

     public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }
}
