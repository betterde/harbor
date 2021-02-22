<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * User data model
 *
 * Date: 2020/12/22
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, \Illuminate\Auth\MustVerifyEmail, HasUuid, HasApiTokens;

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 获取用户所在组
     *
     * Date: 2021/2/22
     * @return HasManyThrough
     * @author George
     */
    public function groups(): HasManyThrough
    {
        return $this->hasManyThrough(Group::class, Member::class, 'user_id', 'id', 'id', 'resource_id');
    }
}
