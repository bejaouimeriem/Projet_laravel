<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    /** @use HasFactory<\Database\Factories\ReponseFactory> */
    use HasFactory;
    protected $fillable = [
        'contenu',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
