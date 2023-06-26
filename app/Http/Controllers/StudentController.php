<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Student::all();
        return view('students.students', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $records = Student::all();
        return view('students.create', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Валидация данных? Проверяет что данные есть?
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'group_id' => 'required'
        ]);
        Student::creating($request->all()); # TODO Check for work. В уроке вместо creating стоит create.


        return redirect()->route('students')->with('success', 'Students created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
//        return view('students', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
