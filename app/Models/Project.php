<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Project data model
 *
 * Date: 2020/12/22
 * @author George
 * @package App\Models
 * @mixin Eloquent
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $cover
 * @property string $repository
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Project extends Model
{
    use HasFactory;
}
