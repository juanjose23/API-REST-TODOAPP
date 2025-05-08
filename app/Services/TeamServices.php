<?php
namespace App\Services;

use App\Interfaces\TeamInterface;

class TeamServices
{
    protected TeamInterface $teamRepository;

    public function __construct(TeamInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function createTeam(array $data)
    {
        $nombre = $data['name'];
        $description = $data['description'];
        $userId = $data['userId'];
        $isActive = $data['is_active'] ?? true;
        $teamData = [
            'name' => $nombre,
            'description' => $description,
            'user_id' => $userId,
            'is_active' => $isActive,
        ];


        $team = $this->teamRepository->createTeam($teamData);
        $invitations = $data['members'] ?? null;
        if ($invitations) {
            foreach ($invitations as $invitation) {

                $this->teamRepository->inviteUserToTeam($team, $invitation['value']);
            }
        }

        return $this->teamRepository->getTeamById($team['id']);
    }

    public function updateTeam($team, array $data)
    {
        return $this->teamRepository->updateTeam($team, $data);
    }

    public function deleteTeam($team)
    {
        return $this->teamRepository->deleteTeam($team);
    }

    public function getAllTeams($userId)
    {
        return $this->teamRepository->getAllTeams($userId);
    }

    public function acceptInvitation($token)
    {
        $invitation = $this->teamRepository->acceptInvitation($token);
        if (!$invitation) {
            return response()->json(['message' => 'Invitation not found'], 404);
        }

        if($invitation->team->creator->id == auth()->user()->id)
        {
            return response()->json(['message' => 'Invitation not found'], 404);
        }

        return response()->json([

            'name' => $invitation->team->name,
            'description' => $invitation->team->description,
            'organizer'=>$invitation->team->creator->name,
            'email'=>$invitation->team->creator->email,
            'date'=>$invitation->created_at,
            'roles' => $invitation->roles,
            'status' => $invitation->status,
        ], 200);
    }
}