<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property Etudiant[] $etudiants
 */
class Filiere extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nom'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etudiants()
    {
        return $this->hasMany('App\Models\Etudiant');
    }
}
