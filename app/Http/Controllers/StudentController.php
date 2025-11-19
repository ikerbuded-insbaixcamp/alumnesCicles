<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumne = Student::findOrFail($id);
        return view('students.show', ['id' => $id, 'alumne' => $alumne]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumne = Student::findOrFail($id);
        $cicles = Cicle::all();
        return view('students.edit', ['id' => $id, 'alumne' => $alumne, 'cicles' => $cicles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumne = Student::findOrFail($id);
        $user = User::findOrFail($alumne->user_id);
        $idUser = $user->id;

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'email' => ['required', 'email', 'unique:users,email,' . $idUser],
            'address' => ['required', 'string', 'min:10', 'max:255'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'phone_number' => ['required', 'string', 'min:9', 'max:9'],
            'cicle' => ['nullable', 'integer'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $alumne->name = $user->name;
        $alumne->email = $user->email;
        $alumne->address = $request->address;
        $alumne->birth_date = $request->birth_date;
        $alumne->phone_number = $request->phone_number;

        if ($request->cicle === "") {
            $alumne->cicle_id = null;
        } else {
            $alumne->cicle_id = $request->cicle;
        }

        $alumne->save();
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $alumne = Student::findOrFail($id);
        $user = User::findOrFail($alumne->user_id);
        $alumne->delete();
        $user->delete();
        return redirect()->route('dashboard');
    }

    public function assignarCicle(string $id)
    {
        $user = Auth::user();
        $student = $user->student;

        $cicle = Cicle::findOrFail($id);

        $student->cicle_id = $cicle->id;
        $student->save();

        return redirect()->route('dashboard');
    }

    public function desAssignarCicle()
    {
        $user = Auth::user();
        $student = $user->student;

        $student->cicle_id = null;
        $student->save();

        return redirect()->route('dashboard');
    }
}
