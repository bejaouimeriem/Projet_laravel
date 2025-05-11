<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;
    protected $fillable = [
        'contenu',
        'test_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // When a question is deleted, delete all related responses
        static::deleting(function ($question) {
            $question->reponses()->each(function ($reponse) {
                $reponse->delete(); 
            });
        });
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class,'question_id');
    }
}
