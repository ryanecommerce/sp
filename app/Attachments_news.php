<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachments_news extends Model
{
    public $table = "attachments_news";

    protected $fillable = ['filename', 'bytes', 'mime'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function getBytesAttribute($value)
    {
        return format_filesize($value);
    }

    public function getUrlAttribute()
    {
        return url('images'.$this->filename);
    }
}
