<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use App\Models\Student;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Vull 10 alumnes per pàgina
        $alumnes = Student::select('students.*')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->paginate(10);
        $cicles = Cicle::all();
        return view('dashboard', ['alumnes' => $alumnes, 'cicles' => $cicles]);
    }
}
