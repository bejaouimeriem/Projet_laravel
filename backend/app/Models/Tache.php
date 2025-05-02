<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    /** @use HasFactory<\Database\Factories\TacheFactory> */
    use HasFactory;
    protected $fillable = [
        'nomTache',
        'done',
        'date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }
}
