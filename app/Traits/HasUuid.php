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
    /**
     * 定义模型事件
     *
     * Date: 2021/2/22
     * @author George
     */
    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
        });
    }
}
