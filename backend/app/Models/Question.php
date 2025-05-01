<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Define the table name (optional, if it differs from the plural model name)
    protected $table = 'questions';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'contenu',
        'test_id',
    ];

    // Define the relationship with Test
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    // Define the relationship with Reponse
    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
}
