<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'category_id', 'total', 'available', 'broke_count'];

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function lendings() {
        return $this->hasMany(Lending::class);
    }

    public function refreshAvailable()
    {
        // Hitung total yang sedang dipinjam (status borrowed)
        $totalBorrowed = $this->lendings()->where('status', 'borrowed')->sum('amount_borrowed');
        
        // Update kolom available: Total - Rusak - Sedang Dipinjam
        $this->available = $this->total - $this->broke_count - $totalBorrowed;
        return $this->save();
    }
}
