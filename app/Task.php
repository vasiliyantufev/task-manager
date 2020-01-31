<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function scopeWhereCreator($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('creator_id', '=', $name);
        }
    }

    public function scopeWhereExecutor($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('executor_id', '=', $name);
        }
    }

    public function scopeWhereStatus($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('status', '=', $name);
        }
    }

    public function scopeWhereTag($query, $name)
    {
        if (!is_null($name)) {
            return $query->whereIn('tag_id', $name);
        }
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    public function executor()
    {
        return $this->belongsTo('App\User', 'executor_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->where('status_id', 1);
    }

    public function tags()
    {
        return $this->hasMany('App\TagTask', 'task_id', 'id');
    }
}
