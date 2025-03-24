<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = [
        'image',
        'plante_id',
    ];

    public function plante()
    {
        return $this->belongsTo(Plante::class);
    }
}
