<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    /** @use HasFactory<\Database\Factories\UtilisateurFactory> */
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

    protected $dates = ['tokenExpiry'];

    public function personnalite()
    {
        return $this->belongsTo(Personnalite::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'utilisateur_id');
    }

    public function agendaPages()
    {
        return $this->hasMany(AgendaPage::class, 'utilisateur_id');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'user_id');
    }
}