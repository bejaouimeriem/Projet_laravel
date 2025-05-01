<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousChapitre extends Model
{
    use HasFactory;

    // Define the table name explicitly if it's not the plural form of the model name
    protected $table = 'sous_chapitres';

    // Define fillable attributes to allow mass assignment
    protected $fillable = [
        'title',
        'description',
        'image',
        'lien_video',
        'pdf',
        'last_page_read',
        'pourcentage',
        'user_id',
        'chapitre_id',
    ];

    // Relationship with Utilisateur (user)
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'user_id');
    }

    // Relationship with Chapitre
    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class, 'chapitre_id');
    }
}
