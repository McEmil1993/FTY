<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class Students extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $pick_student = DB::table('students')
        //                 ->join('manage_feedback','students.id', '=' , 'manage_feedback.student_id')
        //                 ->select('students.student_name')
        //                 ->get();

        $students = Student::all();
        return view('Students.Students',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = new Student;
        $students->student_name = $request->input('student_name');

        $students->save();

        return redirect()->back()->with('success','New student added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::find($id);

        return response()->json([   'id'=>$students->id,
                                    'student_name'=>$students->student_name
                                ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('update_id');


        $students = Student::find($id);

        $students->student_name = $request->input('u_student_name');

        $students->update();

        return redirect()->back()->with('success','Student updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
