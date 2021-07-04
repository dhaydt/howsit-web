<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'loan', 'user_id', 'to_id', 'to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
