<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $filiere_id
 * @property integer $user_id
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property Filiere $filiere
 * @property User $user
 */
class Etudiant extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['filiere_id', 'user_id', 'nom', 'prenom', 'sexe'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filiere()
    {
        return $this->belongsTo('App\Models\Filiere');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
