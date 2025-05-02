<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaPage extends Model
{
    /** @use HasFactory<\Database\Factories\AgendaPageFactory> */
    use HasFactory;
    protected $fillable = [
        'pageNumber',
        'leftContent',
        'rightContent',
        'utilisateur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
