<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Recruit.
 *
 * @property int $id
 * @property string $title
 * @property string $company_name
 * @property string $description
 * @property string $skills
 * @property string $link
 * @property string|null $image_url
 * @property string $address
 * @property int|null $min_salary
 * @property int|null $max_salary
 * @property mixed $expired_at
 * @property int $entry_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $entry_user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Recruit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereEntryUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereMaxSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereMinSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Recruit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recruit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Recruit withoutTrashed()
 * @mixin \Eloquent
 */
class Recruit extends Model
{
    protected $casts = [
        'expired_at'  => 'date:Y-m-d',
    ];
    protected $dates = ['expired_at'];
    protected $fillable = [
        'title',
        'company_name',
        'description',
        'skills',
        'link',
        'image_url',
        'address',
        'min_salary',
        'max_salary',
        'expired_at',
        'entry_user_id',
    ];

    public static function initializeWithDefault()
    {
        return self::make(['min_salary' => 3000, 'max_salary' => 8000]);
    }

    use SoftDeletes;

    public function entry_user()
    {
        return $this->belongsTo(User::class);
    }
}
