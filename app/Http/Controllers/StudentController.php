<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->toArray();
        return view('student.index', compact('students'));
    }
    public function create()
    {
        return view('student.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'    =>  'required',
            'last_name'     =>  'required'
        ]);
        $student = new Student([
            'first_name'    =>  $request->get('first_name'),
            'last_name'     =>  $request->get('last_name')
        ]);
        $student->save();
        return redirect()->route('student.create')->with('success', 'Data Added');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student', 'id'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name'    =>  'required',
            'last_name'     =>  'required'
        ]);
        $student = Student::find($id);
        $student->first_name = $request->get('first_name');
        $student->last_name = $request->get('last_name');
        $student->save();
        return redirect()->route('student.index')->with('success', 'Data Updated');
    }
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Data Deleted');
    }
}