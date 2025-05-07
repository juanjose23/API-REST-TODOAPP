<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Invitation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'role',
        'status',
    ];

    /**
     * Relación con el equipo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Relación con el usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
