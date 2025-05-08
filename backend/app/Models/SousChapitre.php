<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousChapitre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'chapitre_id',
        'image',
        'pourcentage'
    ];

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

    // Relation vers Utilisateur via table pivot personnalisée
    // Utilisateurs associés à ce SousChapitre
    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'user_sous_chapitre_progresses', 'sous_chapitre_id', 'user_id')
                    ->withPivot('pourcentage')
                    ->withTimestamps();
    }

    // Relation avec modèle intermédiaire
    // progressions spécifiques avec plus d’infos
    public function userProgress()
    {
        return $this->hasMany(UserSousChapitreProgress::class, 'sous_chapitre_id');
    }
}
