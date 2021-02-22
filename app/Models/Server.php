<?php

namespace App\Models;

use App\Traits\HasUuid;
use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Server data model
 *
 * Date: 2020/12/23
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description 描述
 * @property string $ip IP
 * @property integer $port 端口号
 * @property string $username 用户名
 * @property string $authentication 认证类型
 * @property string $certificate 凭证
 * @property integer $core CPU 核心数量
 * @property integer $memory 内存大小
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Server extends Model
{
    use HasFactory, HasUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
     * 获取服务器上的环境
     *
     * Date: 2021/2/22
     * @return HasMany
     * @author George
     */
    public function environments(): HasMany
    {
        return $this->hasMany(Environment::class, 'server_id', 'id');
    }
}
