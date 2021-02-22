<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

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
        // 模型创建是自动填充 UUID 主键
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
        });
    }
}
