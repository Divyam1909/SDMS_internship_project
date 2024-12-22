<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'date', 'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

