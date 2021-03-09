<?php

namespace App\Models;

use Eloquent;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 项目运行环境
 *
 * Date: 2021/1/10
 * @author George
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $project_id 所在项目 ID
 * @property string $server_id 所在服务器 ID
 * @property string $description
 * @mixin Eloquent
 */
class Environment extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

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
     * @return BelongsToMany
     * @author George
     */
    public function variables(): BelongsToMany
    {
        return $this->belongsToMany(Variable::class, 'environment_variable_pivot', 'environment_id', 'variable_id');
    }
}
