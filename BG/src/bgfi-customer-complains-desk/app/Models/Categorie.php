<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Les réclamations associées à cette catégorie
     */
    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'categorie_id');
    }
}