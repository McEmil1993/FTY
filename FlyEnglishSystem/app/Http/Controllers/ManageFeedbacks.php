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
        $ct = count((array)$request->input('good_feedback'));
        $ct1 = count((array)$request->input('improve_feedback'));
        $goods = $request->input('good_feedback');
        $improves = $request->input('improve_feedback');

        

        $data = [
            'date' => $request->input('date'),
            'student_id' => $request->input('student_id'),
            'book_id' => $prefixE,
            'good_feedback_id' => 0,
            'improve_feedback_id' => 0,
            'mispronounce' => $request->input('mispronounce'),
            'incorrect' => $request->input('incorrect'),
            'correct' => $request->input('correct'),
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

        
        return redirect()->back()->with('success','Feedback set successfully.');
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

        return $manage_feedbacks;
    }

    public function getidImprove($id)
    {
        $manage_feedbacks = DB::table('improve_feed_backs')
        ->where('manage_id', '=' , $id)
        ->get();

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

        $gd = GoodFeedBack::where('manage_id',$id)->get();
        $im = ImproveFeedBack::where('manage_id',$id)->get();
        $gd_arr = array();
        $im_arr = array();
        
        $result = $manage_feedbacks->book_id;
        $ids = explode(',', $result); // Convert the string to an array
        $book_result = Book::whereIn('id', $ids)->get();

        foreach($gd as $g){
            $gd_arr[] = $g->feed_back_id;
        }
        foreach($im as $i){
            $im_arr[] = $i->feed_back_id;
        }

        $typ_gd = TypeOfFeedback::whereIn('id',$gd_arr)->get();
        $typ_im = TypeOfFeedback::whereIn('id',$im_arr)->get();

        
        return response()->json([   'id'=>$manage_feedbacks->id,
                                    'date'=>$manage_feedbacks->date,
                                    'student_id'=>$manage_feedbacks->student_id,
                                    'book_id'=>$manage_feedbacks->book_id,
                                    'book_result'=>  $book_result,
                                    'good_feedback_id'=>$manage_feedbacks->good_feedback,
                                    'improve_feedback_id'=>$manage_feedbacks->improve_feedback,
                                    'mispronounce'=>$manage_feedbacks->mispronounce,
                                    'incorrect'=>$manage_feedbacks->incorrect,
                                    'correct'=>$manage_feedbacks->correct,
                                    'check_homework'=>$manage_feedbacks->check_homework,
                                    'topic'=>$manage_feedbacks->topic,
                                    'homework'=>$manage_feedbacks->homework,
                                    'getidGood'=>($gd),
                                    'getidImprove'=>($im),
                                    'getidGood_name'=>$typ_gd,
                                    'getidImprove_name'=>$typ_im,
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

        GoodFeedBack::where('manage_id',$id)->delete();

        ImproveFeedBack::where('manage_id',$id)->delete();

        $good_ = new GoodFeedBack;
        $improve = new ImproveFeedBack;

        $goods = array();
        $improves = array();
        $insertGoods = array();
        $insertImprove = array();
        $ct = count((array)$request->input('u_good_feedback'));
        $ct1 = count((array)$request->input('u_improve_feedback'));
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
            'date' => $request->input('u_date'),
            'student_id' => $request->input('u_student_id'),
            'book_id' => $prefixE,
            'good_feedback_id' => 0,
            'improve_feedback_id' => 0,
            'mispronounce' => $request->input('u_mispronounce'),
            'incorrect' => $request->input('u_incorrect'),
            'correct' => $request->input('u_correct'),
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


        return redirect()->back()->with('success','Successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('delete_id');
        $manage_feedbacks = ManageFeedback::find($id);

        $manage_feedbacks->delete();
        return redirect()->back()->with('success','Data removed successfully.');
    }

    public function destroyAll()
    {
        $manage_feedbacks = ManageFeedback::all();

        if ($manage_feedbacks->isNotEmpty()) {
            // Perform the deletion
            ManageFeedback::truncate(); // This will delete all data from the table
            return redirect()->back()->with('success','All data deleted successfully.');
        } else {
            return redirect()->back()->with('error','No data is available in the table.');
        }
    }

    public function view_data($id)
    {
        $manage_feedbacks = ManageFeedback::find($id);

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
    }

}