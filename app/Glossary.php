<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glossary extends Model
{

    public $table = 'glossarys';

    protected $fillable = ['name_eng', 'name_kor', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
