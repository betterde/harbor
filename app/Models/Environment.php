<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 项目运行环境
 *
 * Date: 2021/1/10
 * @author George
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property
 */
class Environment extends Model
{
    use HasFactory;

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
     * 获取环境变量
     *
     * Date: 2021/1/10
     * @return HasMany
     * @author George
     */
    public function variables(): HasMany
    {
        return $this->hasMany(Variable::class, 'environment_id', 'id');
    }
}
