<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    protected $table = 'criteres';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'nom',
        'contenu',
        'icon',
        'personnalite_id',
    ];

    // Define the relationship with Personnalite
    public function personnalite()
    {
        return $this->belongsTo(Personnalite::class);
    }
}
