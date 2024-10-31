<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all()->map(function ($game) {
            $game->release = Carbon::parse($game->release)->format('d/m/Y');
            return $game;
        });
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
            'image' => 'required|file|image|max:5000',
        ]);

        $game = Game::create($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $name, 'public');
            $game->image = '/images/' . $name;
            $game->save();
        }

        return redirect('games')->with('success', 'Game created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
        ]);

        $game->update($request->all());

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($game->image);
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $name, 'public');
            $game->image = '/images/' . $name;
            $game->save();
        }

        return redirect('games')->with('success', 'Game updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        Storage::disk('public')->delete($game->image);
        $game->delete();
        return redirect('games')->with('success', 'Game deleted!');
    }
}
