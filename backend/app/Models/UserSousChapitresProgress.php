<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSousChapitresProgress extends Model
{
    protected $fillable = [
        'user_id',
        'sous_chapitre_id',
        'progression',
        'lastPageRead',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }

    public function sousChapitre()
    {
        return $this->belongsTo(SousChapitre::class, 'sous_chapitre_id');
    }
}
