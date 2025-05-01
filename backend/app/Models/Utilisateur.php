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
        'mdps_compte',
        'mdps_super_admin',
        'role',
        'reset_token',
        'token_expiry',
        'access_token',
    ];

    // Define the relationship with Personnalite
    public function personnalite()
    {
        return $this->belongsTo(Personnalite::class, 'Personnalite_id');
    }

    // Define the relationship with Quote
    public function quote()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }

    // Define the relationship with Feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'utilisateur_id');
    }

    // Define the relationship with AgendaPage
    public function agendaPage()
    {
        return $this->hasMany(AgendaPage::class, 'utilisateur_id');
    }

    // Define the relationship with Tache
    public function taches()
    {
        return $this->hasMany(Tache::class, 'userId');
    }

    // Define the relationship with SousChapitre
    public function sousChapitres()
    {
        return $this->hasMany(SousChapitre::class, 'userId');
    }
}
