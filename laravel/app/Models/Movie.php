<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Movie extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia; // <--- Importante para las imágenes

    protected $fillable = [
        'title',
        'synopsis',
        'duration',
        'age_rating',
        'genre_id'
    ];

    // Relación: Una película pertenece a un género
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    // Esto define que la colección 'poster' solo acepte un archivo, esto quiere decir que al subir una nueva imagen, la anterior se eliminará automáticamente.
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('poster')->singleFile();
    }
}