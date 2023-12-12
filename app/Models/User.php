<?php

namespace App\Models;

use App\Models\Image as ModelsImage;
use Google\Service\Slides\Image;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// use App\Models\User;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'phone_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_token',
        'access_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class, 'user_id');
    }

    public function saldo()
    {
        return $this->hasOne(Saldo::class);
    }

    public function likedImages()
    {
        return $this->belongsToMany(ModelsImage::class)->withTimestamps();
    }

    public function findForPassport($identifier)
    {
        return $this->where('email', $identifier)->orWhere('phone', $identifier)->first();
    }
}
