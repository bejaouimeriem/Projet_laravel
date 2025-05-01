<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    // Define the table name explicitly if it's not the plural form of the model name
    protected $table = 'taches';

    // Define fillable attributes to allow mass assignment
    protected $fillable = [
        'nom_tache',
        'done',
        'date',
        'user_id',
    ];

    // Define the relationship with Utilisateur (user)
    public function user()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }
}
