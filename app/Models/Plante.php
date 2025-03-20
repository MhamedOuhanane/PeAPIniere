<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plante extends Model
{
    /** @use HasFactory<\Database\Factories\PlanteFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'prix', 
        'categorie_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function images()
    {
        return $this->hasMany(Photo::class);
    }
}
