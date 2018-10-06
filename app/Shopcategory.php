<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopcategory extends Model
{
    protected $fillable = [
        'level', 'name', 'slug',
    ];
    
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
