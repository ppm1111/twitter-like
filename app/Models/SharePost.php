<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharePost extends Model
{
    protected $table = 'share_posts';

    protected $fillable = [
        'share_user_id',
        'from_user_id',
        'post_id',
    ];
}
