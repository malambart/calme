<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use RecordsActivity;
    protected $fillable = [
        'date',
        'duree',
        'intervenants',
        'modalite',
        'modalite_autre',
        'destinataires',
        'sujet',
        'commentaires'
    ];

    protected $casts = [
        'intervenants' => 'array',
        'destinataires' => 'array'
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

}
