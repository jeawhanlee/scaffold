<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function subCats(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
