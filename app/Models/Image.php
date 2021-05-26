<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Image extends Model
{
    protected $fillable = [
        'image', 'caption',
    ];

    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function user()

    {

        return $this->belongsTo(User::class);

    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
