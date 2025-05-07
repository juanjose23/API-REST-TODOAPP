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
    
        \Log::info('Creating team with data: ', $data);
    
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
}