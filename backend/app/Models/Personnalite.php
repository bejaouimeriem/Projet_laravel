<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnalite extends Model
{
    /** @use HasFactory<\Database\Factories\PersonnaliteFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'nomEnglish',
        'contenu',
        'icon',
        'image',
    ];

    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'personnalite_id');
    }

    public function criteres()
    {
        return $this->hasMany(Critere::class, 'personnalite_id');
    }
}
