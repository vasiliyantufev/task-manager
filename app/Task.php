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
}
