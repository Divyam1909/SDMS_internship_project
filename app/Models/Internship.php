<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'user_id', 'company', 'position', 'start_date', 'end_date', 'description', 'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

