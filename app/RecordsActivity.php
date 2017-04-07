<?php

namespace App;

use \ReflectionClass;
use Illuminate\Support\Facades\Auth;

trait RecordsActivity
{
    protected static function boot()
    {
        parent::boot();

        foreach (static::getModelEvents() as $event) {

            static::$event(function($model) use($event) {
                $model->addActivity($event);
            });
        }

    }

    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName());

        return "{$action}_{$name}";

    }

    protected static function getModelEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }
        return [
            'created', 'updated', 'deleted'
        ];
    }

    protected function addActivity($event)
    {
        Activity::create([
            'model_id' => $this->id,
            'backup' => $this->toJson(),
            'model' => get_class($this),
            'name' => $this->getActivityName($this, $event),
            'user_id' => Auth::user()->id,
        ]);
    }
}