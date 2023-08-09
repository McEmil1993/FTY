<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageFeedback;
use App\Models\Student;
use App\Models\Book;
use App\Models\TypeOfFeedback;
use App\Models\GoodFeedBack;
use App\Models\ImproveFeedBack;

use DB;

class ManageFeedbacks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {

        $pick_s = DB::table('students') 
                        ->join('manage_feedback','manage_feedback.student_id', '=' , 'students.id')
                        ->get();

        $pick_b = DB::table('books') 
                        ->join('manage_feedback','manage_feedback.book_id', '=' , 'books.id')
                        ->get();

        $pick_gf = DB::table('type_of_feedback') 
                        ->join('manage_feedback','manage_feedback.good_feedback_id', '=' , 'type_of_feedback.id')
                        ->where('status', '=' , 1)
                        ->get();

        $pick_if = DB::table('type_of_feedback') 
                        ->join('manage_feedback','manage_feedback.improve_feedback_id', '=' , 'type_of_feedback.id')
                        ->where('status', '=' , 2)
                        ->get();

        $pick_mf = DB::table('manage_feedback')->get();


        $manage_feedbacks = ManageFeedback::all();
        $manage_students = Student::all();
        $manage_books = Book::all();
        $manage_tof = TypeOfFeedback::all();
        
        return view('ManageFeedbacks.Manage_Feedbacks',
            compact('pick_s','pick_b','pick_gf','pick_if','pick_mf',
                    'manage_feedbacks','manage_students','manage_books','manage_tof'));
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
      
        if (is_null($request->input('good_feedback')) || is_null($request->input('improve_feedback'))) {

            return redirect()->back()->with('error','Feedback set Error!');
        
        }
        $prefixE = "";//save sa database book id array sample 1,2,3,4,5
        $prefix1 = "";
        $prefix = $request->input('book_id'); 
        if ($prefix !="") {
            $prefix1 = json_encode($prefix); 
            $prefixE=implode(',',$prefix);
         
        }  

        $good_ = new GoodFeedBack;
        $improve = new ImproveFeedBack;

        $goods = array();
        $improves = array();
        $insertGoods = array();
        $insertImprove = array();
        $ct = count($request->input('good_feedback'));
        $ct1 = count($request->input('improve_feedback'));
        $goods = $request->input('good_feedback');
        $improves = $request->input('improve_feedback');

        

        $data = [
            'student_id' => $request->input('student_id'),
            'book_id' => $prefixE,
            'good_feedback_id' => 0,
            'improve_feedback_id' => 0,
            'mispronounce' => $request->input('mispronounce'),
            'incorrect' => $request->input('incorrect'),
            'check_homework' =>  $request->input('check_homework'),
            'topic' => $request->input('topic'),
            'homework' => $request->input('homework'),
        ];
    
        $lastInsertedId = ManageFeedback::insertGetId($data);

        for ($i=0; $i < $ct ; $i++) { 
                
            $insertGoods[] = array('manage_id'=>$lastInsertedId,'feed_back_id'=>$goods[$i]);

        }
        for ($i=0; $i < $ct1 ; $i++) { 
                
            $insertImprove[] = array('manage_id'=>$lastInsertedId ,'feed_back_id'=>$improves[$i]);

        }
        

        DB::table('good_feed_backs')->insert($insertGoods);

        DB::table('improve_feed_backs')->insert($insertImprove);

        
        return redirect()->back()->with('success','Feedback set successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        


    }

    public function getidGood($id)
    {
        $manage_feedbacks = DB::table('good_feed_backs')
        ->where('manage_id', '=' , $id)
        ->get();

        // if($manage_feedbacks){
        //     return "1";
        // }else{
        //     return "0";
        // }
        return $manage_feedbacks;
    }

    public function getidImprove($id)
    {
        $manage_feedbacks = DB::table('improve_feed_backs')
        ->where('manage_id', '=' , $id)
        ->get();

        // if($manage_feedbacks){
        //     return "1";
        // }else{
        //     return "0";
        // }

        return $manage_feedbacks;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manage_feedbacks = ManageFeedback::find($id);
        
        $students = Student::find($manage_feedbacks->student_id);
        // $good_ =  GoodFeedBack;
        // $improve = ImproveFeedBack;

        // join TypeOfFeedback 
        // join ManageFeedback 

        $gd = GoodFeedBack::where('manage_id',$id)->get();
        $im = ImproveFeedBack::where('manage_id',$id)->get();

        return response()->json([   'id'=>$manage_feedbacks->id,
                                    'student_id'=>$manage_feedbacks->student_id,
                                    'book_id'=>$manage_feedbacks->book_id,
                                    'good_feedback_id'=>$manage_feedbacks->good_feedback,
                                    'improve_feedback_id'=>$manage_feedbacks->improve_feedback,
                                    'mispronounce'=>$manage_feedbacks->mispronounce,
                                    'incorrect'=>$manage_feedbacks->incorrect,
                                    'check_homework'=>$manage_feedbacks->check_homework,
                                    'topic'=>$manage_feedbacks->topic,
                                    'homework'=>$manage_feedbacks->homework,
                                    'getidGood'=>($gd),
                                    'getidImprove'=>($im),
                                    'student_name'=>$students->student_name
                                ]);
    }


    public function delete_id($id)
    {
        GoodFeedBack::where('manage_id',$id)->delete();

        ImproveFeedBack::where('manage_id',$id)->delete();
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

        // $manage_feedbacks = ManageFeedback::find($id);

        // $manage_feedbacks->student_id = $request->input('u_student_id');
        // $manage_feedbacks->book_id = $request->input('u_book_id');
        // $manage_feedbacks->good_feedback_id = $request->input('u_good_feedback');
        // $manage_feedbacks->improve_feedback_id = $request->input('u_improve_feedback');
        // $manage_feedbacks->mispronounce = $request->input('u_mispronounce');
        // $manage_feedbacks->incorrect = $request->input('u_incorrect');
        // $manage_feedbacks->check_homework = $request->input('u_check_homework');
        // $manage_feedbacks->topic = $request->input('u_topic');
        // $manage_feedbacks->homework = $request->input('u_homework');

        // $manage_feedbacks->update();

        if (is_null($request->input('u_good_feedback')) || is_null($request->input('u_improve_feedback'))) {

            return redirect()->back()->with('error','Feedback set Error!');
        
        }

        GoodFeedBack::where('manage_id',$id)->delete();

        ImproveFeedBack::where('manage_id',$id)->delete();

        $good_ = new GoodFeedBack;
        $improve = new ImproveFeedBack;

        $goods = array();
        $improves = array();
        $insertGoods = array();
        $insertImprove = array();
        $ct = count($request->input('u_good_feedback'));
        $ct1 = count($request->input('u_improve_feedback'));
        $goods = $request->input('u_good_feedback');
        $improves = $request->input('u_improve_feedback');

        $pre=""; //save sa database book id array sample 1,2,3,4,5
        $prefixE = "";
        $prefix1 = "";
        $prefix = $request->input('u_book_id'); 
        if ($prefix !="") {
            $prefix1 = json_encode($prefix); 
            $prefixE=implode(',',$prefix);
        }  

        $data = [
            'student_id' => $request->input('u_student_id'),
            'book_id' => $prefixE,
            'good_feedback_id' => 0,
            'improve_feedback_id' => 0,
            'mispronounce' => $request->input('u_mispronounce'),
            'incorrect' => $request->input('u_incorrect'),
            'check_homework' =>  $request->input('u_check_homework'),
            'topic' => $request->input('u_topic'),
            'homework' => $request->input('u_homework'),
        ];
    

        ManageFeedback::where('id', '=', $id)->update($data);

        for ($i=0; $i < $ct ; $i++) { 
                
            $insertGoods[] = array('manage_id'=>$id,'feed_back_id'=>$goods[$i]);

        }
        for ($i=0; $i < $ct1 ; $i++) { 
                
            $insertImprove[] = array('manage_id'=>$id ,'feed_back_id'=>$improves[$i]);

        }
        

        DB::table('good_feed_backs')->insert($insertGoods);

        DB::table('improve_feed_backs')->insert($insertImprove);


        return redirect()->back()->with('success','Successfully updated!');

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

    public function view_data($id)
    {
        $manage_feedbacks = ManageFeedback::find($id);

        // $good_ =  GoodFeedBack;
        // $improve = ImproveFeedBack;

        // join TypeOfFeedback 
        // join ManageFeedback 
        $goods = array();
        $improves = array();

        $gd = GoodFeedBack::where('manage_id',$id)->get();
        $imp = ImproveFeedBack::where('manage_id',$id)->get();
        foreach($gd as $g){
            $goods[] = array('id'=>$g->id,'feed_back_id'=>$g->feed_back_id);
        }

        foreach($imp as $im){
            $improves[] = array('id'=>$im->id,'feed_back_id'=>$im->feed_back_id);
        }

        echo json_encode($goods);
        echo "<br>";
        echo json_encode($improves);

        // return response()->json([   'id'=>$manage_feedbacks->id,
        //                             'student_id'=>$manage_feedbacks->student_id,
        //                             'book_id'=>$manage_feedbacks->book_id,
        //                             'good_feedback_id'=>$manage_feedbacks->good_feedback,
        //                             'improve_feedback_id'=>$manage_feedbacks->improve_feedback,
        //                             'mispronounce'=>$manage_feedbacks->mispronounce,
        //                             'incorrect'=>$manage_feedbacks->incorrect,
        //                             'check_homework'=>$manage_feedbacks->check_homework,
        //                             'topic'=>$manage_feedbacks->topic,
        //                             'homework'=>$manage_feedbacks->homework,
        //                             'getidGood'=>($gd),
        //                             'getidImprove'=>($im)
        //                         ]);
    }

}