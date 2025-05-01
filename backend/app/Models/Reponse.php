<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    // Define the table name (optional, if it differs from the plural model name)
    protected $table = 'reponses';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'contenu',
        'question_id',
    ];

    // Define the relationship with Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
