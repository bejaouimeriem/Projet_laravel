<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'date',
        'lien',
        'image',
    ];
}
