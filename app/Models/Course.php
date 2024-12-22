<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'user_id', 'title', 'provider', 'start_date', 'end_date', 'description', 'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
