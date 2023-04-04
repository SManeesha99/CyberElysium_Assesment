<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use domain\Facades\StudentFacade;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // $response['students'] = StudentFacade::all();
        // return Inertia::render('Dashboard/Index');
        return Inertia::render('Dashboard/Index', [
            'students' => StudentFacade::all()->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'age' => $student->age,
                    'image' => asset('storage/'.$student->image),
                    'status' => $student->status,
                ];
            }),
          ]);
    }
}
