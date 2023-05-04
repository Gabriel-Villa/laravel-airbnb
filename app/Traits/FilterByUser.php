<?php

namespace App\Traits;

trait FilterByUser
{
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->userId = auth()->id();
        });

        self::addGlobalScope(function ($builder)
        {
            $builder->where('userId', auth()->id());
        });
    }
}
