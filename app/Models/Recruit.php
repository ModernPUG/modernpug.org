<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Messages\SlackAttachment;

/**
 * App\Models\Recruit
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $entry_user
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit newQuery()
 * @method static \Illuminate\Database\Query\Builder|Recruit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereEntryUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereMaxSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereMinSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recruit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Recruit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Recruit withoutTrashed()
 * @mixin \Eloquent
 */
class Recruit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'expired_at' => 'date:Y-m-d',
    ];

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

    public static function getDailyPushTargets()
    {
        $yesterday = Carbon::yesterday();

        return self::where('expired_at', '>=', Carbon::today())
            ->whereBetween('created_at', [$yesterday->startOfDay(), $yesterday->endOfDay()])
            ->get();
    }

    public function entry_user()
    {
        return $this->belongsTo(User::class);
    }

    public function convertAttachment(): SlackAttachment
    {
        $attachment = new SlackAttachment();
        $attachment->title = '['.$this->company_name.']'.$this->title;
        $attachment->action('공고보가', $this->link);

        return $attachment;
    }
}
