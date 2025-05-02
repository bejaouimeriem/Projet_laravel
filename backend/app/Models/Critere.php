<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    /** @use HasFactory<\Database\Factories\CritereFactory> */
    use HasFactory;

    protected $table = 'criteres';

    protected $fillable = [
        'nom',
        'contenu',
        'icon',
        'personnalite_id',
    ];

    public function personnalite()
    {
        return $this->belongsTo(Personnalite::class, 'personnalite_id');
    }
}
