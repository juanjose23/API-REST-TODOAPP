<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use App\Services\TeamServices;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;

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

    public function getTeamById($id)
    {
        // Logic to get a team by ID
    }
 
    public function removeMemberFromTeam($teamId, $userId)
    {
        // Logic to remove a member from a team
    }

    public function listInvitation(string $id)
    {
        $invitationList=$this->teamServices->listInvitation($id);
        return response()->json($invitationList,201);
    }

    public function getInvitationByToken(string $token)
    {
        
        $invitation = $this->teamServices->getInvitationByToken($token);
        return response()->json($invitation, 201);
    }

    public function invitationResponse(InvitationRequest $request)
    {
        $data =$request->validated();
        $invitionResponse = $this->teamServices->invitationResponse($data['token'],$data['status']);
        if($invitionResponse == null)
        {
            return response()->json(['message'=>'Invitation not found'],404);
        }
        else{
            return response()->json(['message' => 'Updated status'], status: 200);
        }
    }


}
