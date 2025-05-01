<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematic extends Model
{
    use HasFactory;

    // Define the table name explicitly if it's not the plural form of the model name
    protected $table = 'thematics';

    // Define fillable attributes to allow mass assignment
    protected $fillable = [
        'nom',
        'image',
    ];

    // Define the relationship with Chapitre
    public function chapitres()
    {
        return $this->hasMany(Chapitre::class, 'thematic_id');
    }
}
