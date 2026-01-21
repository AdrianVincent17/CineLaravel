<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relación: Un género tiene muchas películas
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}