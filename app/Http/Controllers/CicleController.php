<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Http\Request;

class CicleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'min:2', 'max:10'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'num_courses' => ['required', 'integer', 'min:0'],
            'image' => ['required', 'image'],
        ]);

        $cicle = new Cicle();
        $cicle->code = $request->code;
        $cicle->name = $request->name;
        $cicle->description = $request->description;
        $cicle->num_courses = $request->num_courses;

        if ($request->hasFile('image')) {
            $storageLink = $request->file('image')->store('ciclesImages', 'public');
            $cicle->image = $storageLink;
        }

        $cicle->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cicle = Cicle::findOrFail($id);
        return view('cicles.show', ['id' => $id, 'cicle' => $cicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cicle = Cicle::findOrFail($id);
        return view('cicles.edit', ['id' => $id, 'cicle' => $cicle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => ['required', 'string', 'min:2', 'max:10'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'num_courses' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image'] // pot ser null si no es puja nova
        ]);

        $cicle = Cicle::findOrFail($id);
        $cicle->code = $request->code;
        $cicle->name = $request->name;
        $cicle->description = $request->description;
        $cicle->num_courses = $request->num_courses;

        // Si es puja nova imatge, actualitzem el path
        if ($request->hasFile('image')) {
            $storageLink = $request->file('image')->store('ciclesImages', 'public');
            $cicle->image = $storageLink;
        }

        $cicle->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $cicle = Cicle::findOrFail($id);
        $cicle->delete();
        return redirect()->route('dashboard');
    }
}
