<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    // Define the table name explicitly if it's not the plural form of the model name
    protected $table = 'tests';

    // Define fillable attributes to allow mass assignment
    protected $fillable = [
        'nom_test',
        'type_test',
        'utilisable',
    ];

    // Define the relationship with Question
    public function questions()
    {
        return $this->hasMany(Question::class, 'test_id');
    }
}
