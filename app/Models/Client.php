<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    public function plantes()
    {
        return $this->belongsToMany(Plante::class, 'commandes');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
