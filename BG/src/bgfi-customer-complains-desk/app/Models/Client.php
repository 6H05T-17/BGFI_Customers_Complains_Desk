<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- AJOUTE CETTE LIGNE

class Client extends Model
{
    use HasFactory, SoftDeletes; // <-- AJOUTE SoftDeletes ICI

    protected $fillable = [
        'nom',
        'prenoms',
        'telephone',
        'email',
        'agence_id',
    ];

    /**
     * Get the agence that owns the client.
     */
    public function agence(): BelongsTo
    {
        return $this->belongsTo(Agence::class);
    }
}