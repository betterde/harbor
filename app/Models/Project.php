<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use DateTimeInterface;
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

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * Date: 2020/12/23
     * @param DateTimeInterface $date
     * @return string
     * @author George
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
