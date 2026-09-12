<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'reclamation_id',
        'user_id',
        'type',
        'contenu',
    ];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}