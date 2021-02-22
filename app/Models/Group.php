<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * 用户组数据模型
 *
 * Date: 2021/2/22
 * @author George
 * @package App\Models
 * @property string $id
 * @property string $name
 * @property string $cover
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin Eloquent
 */
class Group extends Model
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
     * 获取组下面的用户
     *
     * Date: 2021/2/22
     * @return HasManyThrough
     * @author George
     */
    public function members(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Member::class, 'resource_id', 'id', 'id', 'user_id');
    }
}
