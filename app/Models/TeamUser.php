<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamUser extends Pivot
{
    //
    protected $table = 'team_user';

    
    protected $fillable = ['team_id', 'user_id'];
}
