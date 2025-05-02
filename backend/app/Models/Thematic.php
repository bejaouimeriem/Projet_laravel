<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematic extends Model
{
    /** @use HasFactory<\Database\Factories\ThematicFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
    ];

    public function chapitres()
    {
        return $this->hasMany(Chapitre::class, 'thematic_id');
    }
}
