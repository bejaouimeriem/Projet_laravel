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

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class, 'question_id');
    }
}
