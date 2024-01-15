<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'rentals')->withTimestamps();
    }
}
