<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Email.
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_primary
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Email whereUserId($value)
 * @mixin \Eloquent
 */
class Email extends Model
{
    protected $fillable = ['user_id', 'is_primary', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
