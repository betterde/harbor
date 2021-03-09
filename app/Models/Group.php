<?php

namespace App\Models;

use Eloquent;
use Exception;
use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * 判断用户是否是组的所有则
     *
     * Date: 2021/2/22
     * @param User|string $user
     * @return bool
     * @throws Exception
     * @author George
     */
    public function isOwner($user): bool
    {
        $id = null;

        if (Str::isUuid($user)) {
            $id = $user;
        }

        if ($user instanceof User) {
            $id = $user->getAuthIdentifier();
        }

        if (is_null($id)) {
            throw new Exception('用户数据无效');
        }

        return $this->members()
            ->where('user_id', $id)
            ->where('role', Member::ROLE_OWNER)
            ->exists();
    }

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

    /**
     * 获取组下的项目
     *
     * Date: 2021/2/22
     * @return HasMany
     * @author George
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'group_id', 'id');
    }
}
