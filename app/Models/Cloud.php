<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 云服务商数据模型
 *
 * Date: 2020/12/22
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $key
 * @property string $secret
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Cloud extends Model
{
    use HasFactory;
}
