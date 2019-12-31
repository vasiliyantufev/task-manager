<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'creator_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
