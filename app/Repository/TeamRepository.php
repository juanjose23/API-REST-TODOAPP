<?php
namespace App\Repository;

use App\Interfaces\TeamInterface;
use App\Models\Invitation;
use App\Models\Team;
use App\Models\User;
use App\Notifications\TeamInvitationNotification;
use Illuminate\Support\Facades\Mail;
use Str;

class TeamRepository implements TeamInterface
{
    public function createTeam(array $data)
    {
        // Logic to create a team
        Team::create($data);
        return Team::latest()->first();
    }

    public function updateTeam($team, array $data)
    {
        // Logic to update a team
        $team->update($data);
        return $team;
    }

    public function deleteTeam($team)
    {
        // Logic to delete a team
        $team->is_active = false;
        $team->save();
        return $team;
    }

    public function getAllTeams($userId)
    {
        // Logic to get all teams
        return Team::where('is_active', true)->where('user_id', $userId)->with(['users', 'tasks'])->get();
    }

    public function getTeamById($id)
    {
        // Logic to get a team by ID
        return Team::where('id', $id)->where('is_active', true)->with(['users', 'tasks'])->first();
    }

    public function addMemberToTeam($team, $userId, $role)
    {
        // Logic to add a member to a team
        $team->users()->attach($userId, ['role' => $role]);
        return $team->users()->where('user_id', $userId)->first();
    }

    public function inviteUserToTeam($team, $userId)
    {
        $invitation = Invitation::create([
            'team_id' => $team->id,
            'user_id' => $userId,
            'roles' => 'member',
            'token' => Str::random(8),
            'status' => 'pending'
        ]);

        try {
            $user = User::findOrFail($userId);
            $user->notify(new TeamInvitationNotification($invitation));
        } catch (\Throwable $e) {
            \Log::error("Error enviando invitación: " . $e->getMessage());

        }

        return $invitation;
    }

    public function acceptInvitation($token)
    {
        
        return Invitation::with('team')
            ->where('token', $token)
            ->first();
    }
    

    public function removeMemberFromTeam($team, $userId)
    {
        // Logic to remove a member from a team
        $team->users()->detach($userId);
        return $team->users()->where('user_id', $userId)->first();
    }

    public function getMembersOfTeam($team)
    {
        // Logic to get members of a team
        return $team->users()->where('is_active', true)->get();
    }
}