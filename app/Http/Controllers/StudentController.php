<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        
        return view('student.index');
        //return view('student.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',
        ]);
        $student = new Student();

        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');

        $student->save();

        //return redirect()->route('student.index');
    }

    public function allData() {
        $students = Student::orderBy('id', 'DESC')->get();
        return response()->json($students);
    }

    public function update(Request $request) {
        $student = Student::findOrFail($request->id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $data = $request->all();
        $status = $student->fill($data)->save();

        if($status) {
            return response($status);
        } else {
            return response('something went wrong');
        }
    }

    public function delete(Request $request)
    {
        $student = Student::where('id', $request->id);

        $status = $student->delete();

        if($status) {
            return response($status);
        } else {
            return response('something went wrong');
        }
    }
}
