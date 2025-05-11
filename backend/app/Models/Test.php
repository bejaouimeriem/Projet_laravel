<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /** @use HasFactory<\Database\Factories\TestFactory> */
    use HasFactory;
    protected $table = 'tests';
    protected $fillable = [
        'nomTest',
        'typeTest',
        'utilisable',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
     protected static function boot()
    {
        parent::boot();

        // When a test is deleted, delete all related questions
        static::deleting(function ($test) {
            $test->questions()->each(function ($question) {
                $question->delete(); // This will trigger Question's deleting event
            });
        });
    }
}
