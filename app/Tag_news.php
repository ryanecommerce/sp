<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_news extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "tags_news";

    protected $fillable = ['name', 'slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
