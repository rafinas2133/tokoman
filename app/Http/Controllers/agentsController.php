<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use Illuminate\Http\Request;

class agentsController extends Controller
{
    public function index()
    {
        $agents = Agents::all();
        return view('agents.index', compact('agents'));
    }

    public function add()
    {
        return view('agents.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'images' => 'required',
            'noTelp' => 'required',
        ]);

        $agents = new Agents([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'images' => json_encode($request->get('images')),
            'noTelp' => $request->get('noTelp'),
        ]);

        $agents->save();

        return redirect('/agents')->with('success', 'agents saved!');
    }

    public function show(Agents $agents)
    {
        return view('agents.show', compact('agents'));
    }

    public function edit(Agents $agents)
    {
        return view('agents.edit', compact('agents'));
    }

    public function update(Request $request, Agents $agents)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'images' => 'required',
            'noTelp' => 'required',
        ]);

        $agents->update([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'images' => json_encode($request->get('images')),
            'noTelp' => $request->get('noTelp'),
        ]);

        return redirect('/agents')->with('success', 'agents updated!');
    }

    public function destroy(Agents $agents)
    {
        $agents->delete();
        return redirect('/agents')->with('success', 'agents deleted!');
    }
}

