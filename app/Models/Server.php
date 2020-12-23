<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Server data model
 *
 * Date: 2020/12/23
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $ip
 * @property integer $port
 * @property string $username
 * @property string $password
 * @property integer $core
 * @property integer $memory
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Server extends Model
{
    use HasFactory;
}
