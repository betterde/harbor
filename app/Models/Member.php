<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 成员数据模型
 *
 * Date: 2021/2/22
 * @author George
 * @package App\Models
 * @property string $id
 * @property string $resource_id
 * @property string $resource_type
 * @property string $user_id
 * @property string $role
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin Eloquent
 */
class Member extends Model
{
    use HasFactory, HasFactory;

    const ROLE_OWNER = 'owner';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];
}
