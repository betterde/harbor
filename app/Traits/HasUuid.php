<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Date: 2021/2/7
 * @author George
 * @package App\Traits
 */
trait HasUuid
{
    protected function bootUsesUuid()
    {
        static::creating(function (Model $model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }
}
