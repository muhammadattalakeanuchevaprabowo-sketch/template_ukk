<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'category_id', 'total', 'broke_count'];

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function lendings() {
        return $this->hasMany(Lending::class);
    }

    // Accessor untuk hitung available otomatis
    public function getAvailableAttribute()
    {
        $totalBorrowed = $this->lendings()->where('status', 'borrowed')->sum('amount_borrowed');

        return $this->total - $this->broke_count - $totalBorrowed;
    }
}
