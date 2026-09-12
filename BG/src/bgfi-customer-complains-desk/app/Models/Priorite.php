<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'delay',
    ];

    public function reclamations(): HasMany
    {
        return $this->hasMany(Reclamation::class, 'priorite_id');
    }
}