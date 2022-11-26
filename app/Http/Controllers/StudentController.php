<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    //
    function ShowStudents()
    {
        $students = Student::latest()->get();
        return view('show', compact('students'));
    }

    function CreateStudent(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'grade' => 'required' 
        ]);
        Student::create($request->except('_token'));
        return back();
    }

    function UpdateStudents($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'grade' => 'required' 
        ]);
        $student = Student::find($id);
        $data = $request->all();
        $student->fill($data)->save();
        // $student = Student::find($id)->update([$request->all()]); //alternative
        session()->flash('message', 'Student updated !!');
        return back()->with('modal_id', $id);
    }

    function DeleteStudent($id){
        Student::destroy([$id]); //remove student from database
        session()->flash('message', 'Student removed !!');
        return back();
    }
}
