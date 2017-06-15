<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'date',
        'duree',
        'intervenants',
        'modalite',
        'destinataires',
        'sujet',
        'commentaires'
    ];

    protected $casts = [
        'intervenants' => 'array',
        'destinataires' => 'array'
    ];

}
