<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
     /**
     * Obtiene todos los comentarios de una publicación
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

     /**
     * Obtiene el usaurip al que pertences un publicacion
     */
    public function autor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
