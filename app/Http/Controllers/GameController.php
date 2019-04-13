<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Zipper;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'List Games';
        $this->games = Game::all();
        return $this->view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Upload Unity Game';
        return $this->view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Zipper  $zipper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Zipper $zipper)
    {
        $data = $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:zip|max:64000',
        ]);

        $game = $zipper->unzipGame($data);

        // $path = $request->file->store('games', 'public');
        // dd($path);

        return redirect()->route('games.show', $game);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $this->title = $game->title;
        $this->game = $game;
        $this->storage = config('filesystems.disks.public.root');
        $this->publicPath = '/storage/' . $game->path;
        $this->filenameWithoutExt = str_replace('.zip', '', $game->filename);
        return $this->view();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Game $game)
    {
        $dirs = explode('/', $game->path);
        Storage::disk('public')->deleteDirectory($game->path);
        if (count($dirs) === 3) {
            Storage::disk('public')->deleteDirectory($dirs[0] . '/' . $dirs[1]);
        }
        $game->delete();

        return redirect()->route('games.index');
    }
}
