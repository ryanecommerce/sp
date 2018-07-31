<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoplist extends Model
{
    protected $fillable = [
        'name', 'nation',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
