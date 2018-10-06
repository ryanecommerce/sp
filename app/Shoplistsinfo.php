<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoplistsinfo extends Model
{
    protected $fillable = [
        'shop_id', 'category', 'sub_category', 'content',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}