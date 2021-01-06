<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth; 
use Validator;

class StudentController extends Controller
{

    public $successStatus = 200;

    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request)
    {
         
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'gender' => 'required', 
            'qualifications' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $student = new Student;  
        $student->first_name =  $request->get('first_name');  
        $student->last_name = $request->get('last_name');  
        $student->qualifications = $request->get('qualifications');  
        $student->gender = $request->get('gender');  
        $student->save();  
        return response()->json($student);
    }

    public function edit(Request $request, $id)
    {
        $student = Student::find($id);
        $student->first_name =  $request->get('first_name');  
        $student->last_name = $request->get('last_name');  
        $student->qualifications = $request->get('qualifications');  
        $student->gender = $request->get('gender'); 
        $student->save();
        return response()->json($student);
    }
}
