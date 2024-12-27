<?php

namespace App\Traits;

use Ramsey\Uuid\Guid\Guid;

trait HasUuid
{
    // This method will be used to automatically generate a UUID
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Guid::uuid7()->toString();
            }
        });
    }
}
