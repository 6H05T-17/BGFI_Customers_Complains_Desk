<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reclamation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero',
        'date_creation',
        'client_id',
        'canal',
        'categorie_id',
        'description',
        'priorite_id',
        'statut',
        'service_id',
        'date_limite',
        'user_id',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function priorite(): BelongsTo
    {
        return $this->belongsTo(Priorite::class, 'priorite_id')->withTrashed();
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function historiques(): HasMany
    {
        return $this->hasMany(Historique::class, 'id_reclam');
    }

    /**
     * Les utilisateurs assignés à cette réclamation (Agents)
     */
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'reclamation_user')->withTimestamps();
    }

    /**
     * Les commentaires et actions de cette réclamation
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class)->orderBy('created_at', 'desc');
    }
}