<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFollower extends Pivot
{
    protected $table = 'user_followers';
}
