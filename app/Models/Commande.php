<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'client_id',
        'plante_id',
    ];

    public function plante()
    {
        return $this->belongsTo(Plante::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
