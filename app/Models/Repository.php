<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Project repository data model
 *
 * Date: 2020/12/23
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $url
 * @property string $release
 * @property string $created_at
 * @property string $updated_at
 */
class Repository extends Model
{
    use HasFactory;
}
