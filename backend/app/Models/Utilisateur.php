<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'mdpsCompte',
        'role',
        'resetToken',
        'tokenExpiry',
        'accessToken',
        'personnalite_id',
        'quote_id',
    ];

    protected $hidden = ['mdpsCompte'];

    protected $dates = ['tokenExpiry'];

    public function personnalite()
    {
        return $this->belongsTo(Personnalite::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function agendaPages()
    {
        return $this->hasMany(AgendaPage::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

    // Relation directe avec SousChapitre via table pivot personnalisée
    public function sousChapitres()
    {
        return $this->belongsToMany(SousChapitre::class, 'user_sous_chapitre_progresses', 'user_id', 'sous_chapitre_id')
                    ->withPivot('pourcentage')
                    ->withTimestamps();
    }

    // Relation avec modèle intermédiaire
    public function sousChapitreProgress()
    {
        return $this->hasMany(UserSousChapitreProgress::class, 'user_id');
    }
}
