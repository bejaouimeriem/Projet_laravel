<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    /** @use HasFactory<\Database\Factories\ChapitreFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'thematic_id',
        'pourcentage'
    ];

    public function thematic()
    {
        return $this->belongsTo(Thematic::class, 'thematic_id');
    }

}
