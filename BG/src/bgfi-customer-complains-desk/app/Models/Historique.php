<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    use HasFactory;

    // Pas de timestamps automatiques car on gère la date manuellement selon le MCD
    public $timestamps = false; 

    protected $fillable = [
        'id_reclam',
        'id_user',
        'date',
        'old_val',
        'new_val',
        'action',
    ];

    public function reclamation(): BelongsTo
    {
        return $this->belongsTo(Reclamation::class, 'id_reclam');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}