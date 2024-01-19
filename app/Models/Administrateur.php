<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property User $user
 */
class Administrateur extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'nom', 'prenom', 'sexe'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
