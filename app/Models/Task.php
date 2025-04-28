<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Task extends Model
{
    //
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'creator_id',
        'assigned_to_id',
        'team_id',
        'is_private',
    ];

    // Relaciones
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function activities()
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class);
    }
}
