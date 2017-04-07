<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table='activities';

    protected $fillable=[
        'model_id',
        'model',
        'name',
        'user_id',
        ];
}
