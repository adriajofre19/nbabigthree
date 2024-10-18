<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

use Inertia\Inertia;
use Inertia\Response;

class CrudPlayersController extends Controller
{
    public function index()
    {
        $players = Player::all();

        $users = User::all();

        return Inertia::render('CrudPlayers', [
            'players' => $players,
            'users' => $users,
        ]);
    }

    public function create(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => 'required',
            'team' => 'required',
            'position' => 'required',
            'role' => 'required',
            'avatar' => 'required',
            'player_code' => 'required'
        ]);

        Player::create([
            'name' => $request->name,
            'team' => $request->team,
            'position' => $request->position,
            'role' => $request->role,
            'avatar' => $request->avatar,
            'player_code' => $request->player_code,
            'user_id' => $request->user_id,
        ]);

        return Redirect::route('crud-players');
    }

    public function update(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => 'required',
            'team' => 'required',
            'position' => 'required',
            'role' => 'required',
            'avatar' => 'required',
            'player_code' => 'required'
        ]);

        Player::where('id', $request->id)->update([
            'name' => $request->name,
            'team' => $request->team,
            'position' => $request->position,
            'role' => $request->role,
            'avatar' => $request->avatar,
            'player_code' => $request->player_code,
            'user_id' => $request->user_id,
        ]);

        return Redirect::route('crud-players');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        Player::where('id', $request->id)->delete();

        
    }

    public function createFromCsvFile(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,txt',
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        
        // Read the CSV file
        $csvData = array_map('str_getcsv', file($file->getPathname()));
        
        // Remove the header row if it exists
        array_shift($csvData);

        foreach ($csvData as $data) {
            Player::create([
                'name' => $data[0],
                'team' => $data[1],
                'position' => $data[2],
                'role' => $data[3],
                'avatar' => $data[4],
                'player_code' => $data[5],
                'user_id' => $data[6],
            ]);
        }

        return Redirect::route('crud-players')->with('success', 'Players imported successfully');
    }

    return Redirect::route('crud-players')->with('error', 'No file was uploaded');
}

    
}
