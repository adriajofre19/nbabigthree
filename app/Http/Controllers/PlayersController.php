<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Player;
use App\Models\User;

use Inertia\Inertia;


class PlayersController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(auth()->id());

        $players = Player::where('user_id', auth()->id())->get();      

        foreach ($players as $player) {
            $player->stats = Player::getPointsFromThisPlayerOnThisWeek($player->player_code);
        }

        $titulars = Player::where('user_id', auth()->id())->where('role', 'titular')->get();

        foreach ($titulars as $titular) {
            $titular->stats = Player::getPointsFromThisPlayerOnThisWeek($titular->player_code);
        }

        return Inertia::render('MyTeam', [
            'players' => $players,
            'user' => $user,
            'titulars' => $titulars,
        ]);
    }

    public function update (Request $request)
    {
        
        $titular_id = $request->titular_id;
        $suplent_id = $request->suplent_id;

        $titular = Player::find($titular_id);
        $suplent = Player::find($suplent_id);

        $titular->update([
            'role' => 'suplente',
        ]);

        $suplent->update([
            'role' => 'titular',
        ]);

        return redirect()->back();

    }

    public function getPlayerById($id)
    {
        $player = Player::find($id);

        $player->stats = Player::getPlayerById($player->player_code);
        
        $totalGames = 0;
        $totalPoints = 0;
        $totalWins = 0;
        $totalDefeats = 0;


        foreach ($player->stats as $stat) {
            $totalPoints += $stat['points'];
            $totalGames++;
            // get the first letter of the result
            $result = substr($stat['result'], 0, 1);
            if ($result == 'W') {
                $totalWins++;
            } else {
                $totalDefeats++;
            }
        }

        $player->totalPoints = $totalPoints;
        $player->totalGames = $totalGames;
        $player->totalWins = $totalWins;
        $player->totalDefeats = $totalDefeats;

        return Inertia::render('Player', [
            'player' => $player,
        ]);

        
    }

    public function getTeamFromThePlayer($id)
    {
        $user = User::find($id);

        $players = Player::where('user_id', $id)->get();

        $stats = Player::getAllInfoFromTheApi();

        

        foreach ($players as $player) {
            $player->stats = Player::getPointsFromThisPlayerOnThisWeek($player->player_code);
       
        }

        $AuthenticatedUser = Auth::user();

        $playersofAuthenticatedUser = Player::where('user_id', $AuthenticatedUser->id)->get();

        return Inertia::render('TeamFromPlayer', [
            'players' => $players,
            'user' => $user,
            'AuthenticatedUser' => $AuthenticatedUser,
            'playersofAuthenticatedUser' => $playersofAuthenticatedUser,
        ]);
    }

    public function updateTeamName(Request $request)
    {
        $user = User::find(auth()->id());

        $user->update([
            'team_name' => $request->team_name,
        ]);

        return redirect()->back();
    }

    

    

}
