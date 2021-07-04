<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'share', 'user_id', 'from_id', 'from',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
