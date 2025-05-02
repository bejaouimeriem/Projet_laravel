<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /** @use HasFactory<\Database\Factories\TestFactory> */
    use HasFactory;
    protected $fillable = [
        'nomTest',
        'typeTest',
        'utilisable',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id');
    }
}
