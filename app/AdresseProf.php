<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdresseProf extends Model
{
    protected $guarded = ['enseignant_id'];
}
