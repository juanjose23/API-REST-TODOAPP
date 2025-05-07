<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Services\TeamServices;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    //
    protected TeamServices $teamServices;
    public function __construct(TeamServices $teamServices)
    {
        $this->teamServices = $teamServices;
    }

    public function teams(Request $request)
    {
        // Logic to get all teams
        $userId = auth()->user()->id;
        $teams = $this->teamServices->getAllTeams($userId);
        return response()->json($teams, 200);
    }
    public function createTeam(CreateTeamRequest $request)
    {
        // Logic to create a team
        $data = $request->validated();
        $team = $this->teamServices->createTeam($data);
        return response()->json($team, 201);
        
    }
    public function updateTeam(Request $request, $id)
    {
        // Logic to update a team
    }

    public function deleteTeam($id)
    {
        // Logic to delete a team
    }
    public function getAllTeams()
    {
        // Logic to get all teams

    }
    public function getTeamById($id)
    {
        // Logic to get a team by ID
    }
    public function addMemberToTeam(Request $request, $teamId)
    {
        // Logic to add a member to a team
    }
    public function removeMemberFromTeam($teamId, $userId)
    {
        // Logic to remove a member from a team
    }

}
