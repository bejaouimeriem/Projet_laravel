<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_number',
        'left_content',
        'right_content',
        'user_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
