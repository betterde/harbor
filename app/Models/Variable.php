<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Date: 2021/2/20
 * @author George
 * @package App\Models
 * @property string $id
 * @property string $name 名称
 * @property string $type 数据类型
 * @property string $value 值
 * @property string $description 描述
 * @mixin Eloquent
 */
class Variable extends Model
{
    use HasFactory;

    const TYPE_INT = 'integer';
    const TYPE_STRING = 'string';
    const TYPE_FLOAT = 'float';
    const TYPE_BOOLEAN = 'boolean';

    /**
     * The attributes that should be cast.
     *
     * @var array $casts
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * 获取使用变量的环境
     *
     * Date: 2021/2/20
     * @return BelongsToMany
     * @author George
     */
    public function environments(): BelongsToMany
    {
        return $this->belongsToMany(Environment::class, 'environment_variable_pivot', 'variable_id', 'environment_id');
    }
}
