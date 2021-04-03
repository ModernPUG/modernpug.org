<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OauthIdentity
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider_user_id
 * @property string $provider
 * @property string $access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity query()
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereProviderUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OauthIdentity whereUserId($value)
 * @mixin \Eloquent
 */
class OauthIdentity extends Model
{
    use HasFactory;

    public const SUPPORT_PROVIDER = ['slack'];

    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
