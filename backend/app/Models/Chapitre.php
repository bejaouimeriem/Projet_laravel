<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Thematic;
use App\Models\SousChapitres;

class Chapitre extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'thematic_id',
        'pourcentage',
    ];

    public function thematic()
    {
        return $this->belongsTo(Thematic::class);
    }

    public function sousChapitres()
    {
        return $this->hasMany(SousChapitre::class, 'chapitre_id');
    }
}
