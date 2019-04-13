<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Engine;
use Illuminate\Http\Request;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'List Of Game Engines';
        $this->engines = Engine::all();
        return $this->view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Create Game Engine';
        return $this->view();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:64|unique:engines',
        ]);

        Engine::create($data);

        return redirect()->route('engines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function show(Engine $engine)
    {
        $this->title = $engine->name;
        $this->engine = $engine;
        return $this->view();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\Response
     */
    public function edit(Engine $engine)
    {
        $this->title = 'Edit ' . $engine->name;
        $this->engine = $engine;
        return $this->view();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Engine $engine)
    {
        $data = $request->validate([
            'name' => 'required|max:64|unique:engines,name,' . $engine->id,
        ]);
        $engine->update($data);

        return redirect()->route('engines.show', $engine);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Engine  $engine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Engine $engine)
    {
        $engine->forceDelete();
        return redirect()->route('engines.index');
    }
}
