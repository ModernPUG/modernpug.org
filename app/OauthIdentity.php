<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OauthIdentity.
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_user_id
 * @property string $provider
 * @property string $access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OauthIdentity whereUserId($value)
 * @mixin \Eloquent
 */
class OauthIdentity extends Model
{

    public const SUPPORT_PROVIDER=['slack'];

    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
