<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'user_id', 'title', 'authors', 'journal', 'publication_date', 'description', 'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

