<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnalite extends Model
{
    use HasFactory;

    // Define the table name (optional, if it differs from the plural model name)
    protected $table = 'personnalites';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'nom',
        'nomEnglish',
        'contenu',
        'icon',
        'image',
    ];

    // Define the relationship with Utilisateur
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'personnalite_id');
    }

    // Define the relationship with Critere
    public function criteres()
    {
        return $this->hasMany(Critere::class, 'personnalite_id');
    }
}
