<?php
namespace App\Interfaces;
interface TeamInterface
{
    public function getAllTeams($userId);
    public function getTeamById($id);
    public function addMemberToTeam($team, $userId, $role);
    public function removeMemberFromTeam($team, $userId);
    public function getMembersOfTeam($team);
    public function createTeam(array $data);
    public function updateTeam($team, array $data);
    public function deleteTeam($team);

    //Invitation Method
    public function inviteUserToTeam($team, $userId);
    public function listInvitation($userId);
    public function getInvitationByToken($token);
    public function invitationResponse($token, $status);

}
