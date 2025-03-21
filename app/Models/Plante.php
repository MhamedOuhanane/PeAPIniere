<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plante extends Model
{
    /** @use HasFactory<\Database\Factories\PlanteFactory> */
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 
        'slug',
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') 
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
