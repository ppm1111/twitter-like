<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StarRecord extends Model
{
    protected $table = 'star_records';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
