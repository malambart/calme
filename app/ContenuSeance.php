<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContenuSeance extends Model
{
    protected $fillable=['no_seance', 'categories', 'label'];
}
