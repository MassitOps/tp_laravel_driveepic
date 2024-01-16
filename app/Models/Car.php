<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'model', 'status', 'price'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'rentals')->withTimestamps();
    }
}
