<?php

namespace App\Models;

use App\Exceptions\AuthException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'api_token',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'email_verified_at',
        'pivot'
    ];

    public function getToken()
    {
        return $this->api_token;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function isAuth($token)
    {
        if ($user = self::where('api_token', $token)->first())
        {
            return $user;
        } else {
            return false;
        }
    }


    public static function isAuthByTokenForApi(string|null $token) : User | null
    {
        if ($user = self::where('api_token', (string) $token)->first())
        {
            return $user;
        } else {
            throw new AuthException('User by this ' . $token . ' token is not found');
        }
    }

    public function getCompany()
    {
        return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id');
    }

    public function setPassword($val)
    {
        return $this->password = Hash::make($val);
    }

    public function setApiToken($val)
    {
        return $this->api_token = hash('sha256', $val);
    }
}
