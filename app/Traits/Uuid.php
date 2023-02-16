<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
    protected static function boot()
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the 'creating' event on the Track Model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
        */
        static::creating(function ($model) {            
            $model->setAttribute('uuid', hex2bin(str_replace('-', '', Str::uuid()->toString())));
        });
    }

    // Tells Eloquent Model not to auto-increment this field
    public function getIncrementing()
    {
        return false;
    }

    // Tells that the IDs on the table should be stored as strings
    public function getKeyType()
    {
        return 'string';
    }
}