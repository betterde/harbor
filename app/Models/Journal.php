<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 项目日志数据模型
 *
 * Date: 2021/3/9
 * @author George <george@betterde.com>
 * @package App\Models
 * @property string $id 日志 ID
 * @property string $project_id 项目 ID
 * @property string $environment_id 环境 ID
 * @property string $operator_id 操作人员 ID
 * @property string $operator_type 操作人员模型
 * @property string $resource_id 资源 ID
 * @property string $resource_type 资源模型
 * @property string $query 查询参数
 * @property string $body 请求体
 * @property string $uri 相对 URL
 * @property string $action 操作类型
 * @property array $origin 原始数据
 * @property array $modified 改动数据
 * @property Carbon $created_at 创建于
 * @method static self create(array $attributes = [])
 */
class Journal extends Model
{
    use HasUuid, HasFactory;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
