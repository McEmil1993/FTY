<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeOfFeedback;

class TypeOfFeedbacks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tofs = TypeOfFeedback::all();

        // echo json_encode($tofs);
                return view('ToF.Type_Of_Feedbacks',compact('tofs'));
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
        $tofs = new TypeOfFeedback;
        $tofs->feedback = $request->input('feedback');
        $tofs->status = $request->input('status');

        $tofs->save();

        return redirect()->back()->with('success','New feedback added.');
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
        $tofs = TypeOfFeedback::find($id);
        
        return response()->json([   'id'=>$tofs->id,
                                    'feedback'=>$tofs->feedback
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
        $tofs = TypeOfFeedback::find($id);


        $tofs->feedback = $request->input('good_feedback');
        $tofs->update();

        return redirect()->back()->with('success','Feedback updated.');

    }

    public function improve(Request $request)
    {
        $id = $request->input('update_improve_id');
        $tofs = TypeOfFeedback::find($id);


        $tofs->feedback = $request->input('improve_feedback');
        $tofs->update();

        return redirect()->back()->with('success','Feedback updated.');

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
