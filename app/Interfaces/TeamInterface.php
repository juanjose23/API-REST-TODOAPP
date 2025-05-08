<?php
namespace App\Interfaces;
interface TeamInterface
{
    public function createTeam(array $data);
    public function updateTeam($team, array $data);
    public function deleteTeam($team);
    public function inviteUserToTeam($team, $userId);
    public function acceptInvitation($token);
    public function getAllTeams($userId);
    public function getTeamById($id);
    public function addMemberToTeam($team, $userId, $role);
    public function removeMemberFromTeam($team, $userId);
    public function getMembersOfTeam($team);
}
