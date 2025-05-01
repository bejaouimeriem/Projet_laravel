<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    // Define the table name (optional, if it differs from the plural model name)
    protected $table = 'quotes';

    // Fillable attributes to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'nomAuteur',
        'contenu',
    ];
}
