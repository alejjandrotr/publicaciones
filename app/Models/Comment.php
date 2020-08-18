<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Obtiene la publicacion a la que pertences un comentario
     */
    public function publication()
    {
        return $this->belongsTo('App\Models\Publication');
    }

     /**
     * Obtiene el usaurip al que pertences un comentario
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
