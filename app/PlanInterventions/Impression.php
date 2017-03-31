<?php


namespace App\PlanInterventions;
use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    protected $fillable=[
        'diagnostic',
        'confirme',
        'score_severite'
    ];
}
