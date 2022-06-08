<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "prenom", "sexe", "age", "niveau_scolaire_id"];

    public function niveau_scolaire(){
        return $this->belongsTo(NiveauScolaire::class);
    }
}
