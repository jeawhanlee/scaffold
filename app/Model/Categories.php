<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function children() {
        return $this->hasMany(Categories::class, 'parent_id', 'id');
    }
}
