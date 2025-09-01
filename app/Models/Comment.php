<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'author_name'
    ];

    public function issue(){
        return $this->belongsTo(Issue::class);
    }
}
