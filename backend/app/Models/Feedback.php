<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Define the table name (optional, if it differs from the plural model name)
    protected $table = 'feedbacks';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'message',
        'utilisateur_id',
    ];

    // Define the relationship with Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
