<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPost extends Pivot
{
    protected $table = 'user_posts';
}
