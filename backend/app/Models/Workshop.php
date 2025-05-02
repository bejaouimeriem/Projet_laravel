<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    /** @use HasFactory<\Database\Factories\WorkshopFactory> */
    use HasFactory;
    protected $table = 'workshops';

    protected $fillable = [
        'nom',
        'description',
        'date',
        'lien',
        'image',
    ];

    protected $dates = ['date'];
}
