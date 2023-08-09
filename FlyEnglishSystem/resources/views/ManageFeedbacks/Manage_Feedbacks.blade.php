@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-success btn-md" style="width:160px;padding-right:0px; padding-left:0px;" data-toggle="modal" data-target="#set_feedback" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> SET FEEDBACK</b>
                </button>
            </div>
        </div>
        <div class="card" style="height: 550px;">
            <div class="card-header"><!-- /.card-header -->
                <h5><b>FEEDBACKS OF THE STUDENT</b></h5>
            </div>
            <div class="card-body text-center"><!-- /.card-body -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Students Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pick_s as $mf)
                        <tr>
                            <td>{{$mf->student_name}}</td>
                            <td>
                                <button class="btn btn-md btn-primary update" data-id="{{$mf->id}}" data-toggle="modal" data-target="#u_set_feedback" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <button class="btn btn-md btn-warning view" data-id="{{$mf->id}}" data-toggle="modal" data-target="#view_data"  data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-eye"></i> View data
                                </button>

                                <!-- <button class="btn btn-md btn-warning view" data-toggle="modal" data-target="#view_data" onclick="click_update({{$mf->id}})" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-eye"></i> View data
                                </button> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- SetFeedback Modal-->
<div class="modal fade" id="set_feedback">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-edit"></i> Manage Feedback</h4>
            </div>
            <form action="{{route ('manage') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <select class="form-control select2bs4" name="student_id" id="student_id" required>
                                <option value="" selected disabled>Select Student</option>
                                @foreach($manage_students as $ps)
                                    <option value="{{$ps->id}}">{{$ps->student_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-8 select2-cyan">
                            <?php 
                                $arr_book = (array)old('book_id');
                            ?>
                            <select class="form-group select2" multiple="multiple"
                                data-dropdown-css-class="select2-cyan" name="book_id[]" id="book_id"
                                data-placeholder="Select Book | Topic | Session" required>
                                @foreach($manage_books as $pb)
                                <option value="{{$pb->id}}">
                                    {{$pb->book_name}} ({{$pb->topic_name}} - Session {{$pb->session}})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-4 pt-3 mf_feedback">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-star text-warning"></i> 
                                        Choose Good Feedbacks
                                    </h3>
                                </div>
                                <div class="card-body table-responsive g_ck p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <tbody>
                                            @foreach($manage_tof as $all_good)
                                            @if($all_good->status == 1) 
                                                <tr>
                                                    <td width="0">
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" class="good_feedback" value="{{$all_good->id}}"
                                                            name="good_feedback[]" id="good_feedback_{{$all_good->id}}">
                                                            <label for="good_feedback_{{$all_good->id}}"></label>
                                                        </div>
                                                    </td>
                                                    <td width="0">
                                                        <div class="good_feedback_data">
                                                            <i class="fas fa-star text-warning"></i> 
                                                            {{$all_good->feedback}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div><!-- /.card-body --> 
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                        Choose Need/Needs to Improve
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <tbody class="no_data">
                                            @foreach($manage_tof as $all_improve)
                                            @if($all_improve->status == 2)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" class="improve_feedback" value="{{$all_improve->id}}" 
                                                        name="improve_feedback[]" id="improve_feedback_{{$all_improve->id}}">
                                                        <label for="improve_feedback_{{$all_improve->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improve_data">
                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                        {{$all_improve->feedback}}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body --> 
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-4">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <label>MISPRONOUNCED WORD/S :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" name="mispronounce" id="mispronounce" placeholder="Type here..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <label>INCORRECT SENTENCE/S :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" name="incorrect" id="incorrect" placeholder="Type here..."></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <i class="fas fa-check text-success"></i> 
                                    <label>HOMEWORK CHECKING (TOPIC):</label>
                                    <textarea type="text" class="form-control mb-2" style="height: 65px;" name="topic" id="topic" placeholder="Type the topic given..." ></textarea>

                                    <textarea type="text" class="form-control" style="height: 65px;" name="check_homework" id="check_homework" 
                                    placeholder="Type the result of the homework..." ></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="far fa-file-alt"></i>
                                    <label>HOMEWORK :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" name="homework" id="homework" placeholder="Type here..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submit">Submit</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 



<!-- Edit Modal-->
<div class="modal fade" id="u_set_feedback">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                @foreach ($pick_s as $updateviewStudentName)
                <h4 class="modal-title"><i class="fas fa-edit"></i> 
                    Update {{$updateviewStudentName->student_name}}'s Feedback
                </h4>
                @endforeach
            </div>
            <form action="{{route ('update') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="update_id" id="update_id">
                   
                    <div class="row">
                        <div class="col-lg-6">
                            <select class="form-control select2bs4" name="u_student_id" id="u_student_id" required>
                                <option value="" selected disabled>Select Student</option>
                                @foreach($manage_students as $ups)
                                    <option value="{{$ups->id}}">{{$ups->student_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 select2-cyan">
                            <select class="form-group select2" multiple="multiple"
                            data-dropdown-css-class="select2-cyan" name="u_book_id[]" data-placeholder="Select Book" id="u_book_id" required>
                                @foreach($manage_books as $upb)
                                <option value="{{$upb->id}}">
                                    {{$upb->book_name}} ({{$upb->topic_name}} - Session {{$upb->session}})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-4 pt-3 mf_feedback">
                       
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-star text-warning"></i> 
                                        Choose Good Feedbacks
                                        
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <tbody>
                                            @foreach($manage_tof as $u_all_good)
                                            @if($u_all_good->status == 1) 
                                            <tr>
                                                <td width="0">
                                                    <div class="icheck-primary">
                                                       
                                                        <input type="checkbox" value="{{$u_all_good->id}}" class="u_good_feedback"
                                                        name="u_good_feedback[]" id="u_good_feedback{{$u_all_good->id}}">
                                                        <label for="u_good_feedback{{$u_all_good->id}}"></label>
                                                    </div>
                                                </td>
                                                <td width="0">
                                                    <div class="good_feedback_data">
                                                        <i class="fas fa-star text-warning"></i> 
                                                        {{$u_all_good->feedback}}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body --> 
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                        Choose Need/Needs to Improve
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <tbody class="no_data">
                                            @foreach($manage_tof as $u_all_improve)
                                            @if($u_all_improve->status == 2)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" value="{{$u_all_improve->id}}" name="u_improve_feedback[]" class="u_improve_feedback"
                                                        id="u_improve_feedback{{$u_all_improve->id}}" >
                                                        <label for="u_improve_feedback{{$u_all_improve->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="improve_data">
                                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                                        {{$u_all_improve->feedback}}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body --> 
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-4">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <label>MISPRONOUNCED WORD/S :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" 
                                    name="u_mispronounce" id="u_mispronounce" placeholder="Type here..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <label>INCORRECT SENTENCE/S :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" 
                                    name="u_incorrect" id="u_incorrect" placeholder="Type here..."></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <i class="fas fa-check text-success"></i> 
                                    <label>HOMEWORK CHECKING (TOPIC) :</label>
                                    <input type="text" class="form-control mb-2" name="u_topic" id="u_topic" placeholder="Type the topic given..." >
                                    <textarea type="text" class="form-control" style="height: 65px;" 
                                    name="u_check_homework" id="u_check_homework" 
                                    placeholder="Type the result of the homework..." ></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <i class="far fa-file-alt"></i>
                                    <label>HOMEWORK :</label>
                                    <textarea type="text" class="form-control" style="height: 65px;" name="u_homework" id="u_homework" placeholder="Type here..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary" id="update">Save Changes</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 




<!-- ViewData Modal-->
<div class="modal fade " onload="autoClick();" id="view_data" >
    <div class="modal-dialog modal-xl"  id="download_data">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
   
                    <i class="fas fa-user"></i> Feedback for <span class="result result_name"> </span>
             
                </h4>
                <h4 class="modal-title"><label>DATE :</label> <?php echo date("F \t j, Y"); ?></h4> 
            </div>
            <div class="modal-body sf">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-default-message">
                            <div class="card-body">
                             
                                <span class="default-message">
                                    Thank you so much <span class="result result_name"></span>  for having the class today. Your presence and effort are much appreciated.
                                    Just continue learning and managing your time and you will become more successful in your learning journey.
                                </span>
                           
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <form > -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <label>
                                    <i class="fas fa-user"></i>
                                    STUDENT NAME : 
                                    <label name="view_student_id" id="view_student_id">
                                        @foreach ($pick_s as $viewStudent)
                                        <span class="text-success1">
                                            {{$viewStudent->student_name}}</span>
                                        @endforeach
                                    </label>
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <label>
                                    <i class="fas fa-book"></i>
                                    BOOK/TOPIC/SESSION : 
                                    <label name="view_book_id" id="view_book_id">
                                        @foreach ($pick_b as $viewBook)
                                        <span class="text-success1">
                                            {{ str_replace(array('[',']','"'),' ',$viewBook->book_name . ' '. '(' . $viewBook->topic_name . ')' . ' ' . '-' . ' ' . 'Session' . ' ' .$viewBook->session ) }}
                                        </span>
                                        @endforeach
                                    </label>
                                </label>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <label>
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    MISPRONOUNCE WORD/S : 
                                    <label name="view_mispronounce" id="view_mispronounce">
                                    @foreach($pick_mf as $viewMispronounce)
                                    @if($viewMispronounce->mispronounce != '')
                                        <span class="text-success1">{{$viewMispronounce->mispronounce}}</span>
                                    @else
                                            <span class="text-danger1"><i>None</i></span>
                                    @endif
                                    @endforeach
                                    </label>
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <label>
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    INCORRECT SENTENCE/S : 
                                    <label name="view_incorrect" id="view_incorrect">
                                    @foreach($pick_mf as $viewIncorrect)
                                    @if($viewIncorrect->incorrect != '')
                                            <span class="text-success1">{{$viewIncorrect->incorrect}}</span>
                                    @else
                                            <span class="text-danger1"><i>None</i></span>
                                    @endif
                                    @endforeach
                                    </label>
                                </label>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <label>
                                    <i class="fas fa-check text-success"></i>
                                    HOMEWORK CHECKING (TOPIC) : 
                                    <label name="view_check_homework" id="view_check_homework">
                                    @foreach($pick_mf as $viewMF)
                                    @if($viewMF->check_homework && $viewMF->topic == '')
                                            <span class="text-success1">
                                                {{$viewMF->check_homework}}
                                            </span>
                                            <span class="text-success1">
                                                {{$viewMF->topic}} 
                                            </span>
                                            <br>
                                    @else
                                            <span class="text-danger1"><i>None</i></span>
                                    @endif
                                    @endforeach
                                    </label>
                                </label> 
                            </div>
                            <div class="col-lg-12">
                                <label>
                                    <i class="far fa-file-alt"></i>
                                    HOMEWORK: 
                                    <label name="view_homework" id="view_homework">
                                    @foreach($pick_mf as $viewMF)                                   
                                        <span class="text-success1">
                                            {{$viewMF->homework}}
                                        </span>
                                    @endforeach
                                    </label>
                                </label> 
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="card card-good" style="height: 220px;">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <label>
                                                <i class="fas fa-star text-warning"></i>
                                                GOOD FEEDBACKS
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <label name="view_good_feedback" id="view_good_feedback">
                                        @foreach($pick_gf as $viewGoodFeedback)
                                        @if($viewGoodFeedback->status != '' && $viewGoodFeedback->status == 1)
                                        <i class="fas fa-star text-warning"></i>
                                            <span>
                                            {{ str_replace(array('[',']','"'),' ',$viewGoodFeedback->feedback) }}
                                            </span>
                                        @else
                                            <span class="text-danger1"><i>None</i></span>
                                        @endif
                                        @endforeach
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-improve" style="height: 220px;">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <label>
                                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                                NEED/NEEDS TO IMPROVE
                                            </label> 
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <label name="view_improve_feedback" id="view_improve_feedback">
                                        @foreach($pick_if as $viewImproveFeedback)
                                        @if($viewImproveFeedback->status != '' && $viewImproveFeedback->status == 2)
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                            <span>
                                            {{ str_replace(array('[',']','"'),' ',$viewImproveFeedback->feedback) }}
                                            </span>
                                        @else
                                            <span class="text-danger1"><i>None</i></span>
                                        @endif
                                        @endforeach
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a class="btn btn-md btn-secondary toDL" id="Download">
                        <i class="fas fa-download"></i> Download as .png
                    </a>
                </div>
            </div>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@if(session('success'))
    <script type="text/javascript">
          toastr.success("{{ session('success') }}");
    </script>    
@endif

@if(session('error'))
    <script type="text/javascript">
          toastr.error("{{ session('error') }}");
    </script>    
@endif

<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    })
</script>

<script type="text/javascript">
    function getCheckedCount() {
    var checkboxes = document.querySelectorAll('.good_feedback');
    var checkedCount = 0;

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    alert('Checked Count: ' + checkedCount);
}
</script>


<script type="text/javascript">
    $('#active_mf').addClass('new_active');
</script>




<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "ordering": false,
        "lengthMenu": [[5, 6, 9, 12, -1], [5, 6, 9, 12, "All"]],
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "ordering": false,
    });
  });
</script>


<script type="text/javascript">
    $('.update').click(function(){
        $(".u_good_feedback").prop("checked", false);
        $(".u_improve_feedback").prop("checked", false);
        var id = $(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_data/" + id,
            dataType    : "json",
            success     : function(data){
                
                console.log(data.book_id);

                $.each(data.book_id.split(","), function(i,e){
                    $("#u_book_id option[value='" + e + "']").prop("selected", true).trigger('change');
                });

                $('#update_id').val(data.id);
                $('#u_student_id option[value= "'+data.student_id+'"]' ).prop("selected",true).trigger('change');
                // $('#u_book_id option[value= "'+data.book_id+'"]' ).prop("selected",true).trigger('change');
                $('#u_mispronounce').val(data.mispronounce);
                $('#u_incorrect').val(data.incorrect);
                $('#u_check_homework').val(data.check_homework);
                $('#u_topic').val(data.topic);
                $('#u_homework').val(data.homework);
                $('#u_good_feedback').val(data.good_feedback);
                $('#u_improve_feedback').val(data.improve_feedback);

                // $('#u_manage_id').attr("data-manage",data.getidGood[0].manage_id);


                for (let index = 0; index < data.getidGood.length; index++) {

                    // console.log(data.getidGood[index].feed_back_id);
                    $('#u_good_feedback'+data.getidGood[index].feed_back_id).prop("checked", true);
                    
                }

                for (let index = 0; index < data.getidImprove.length; index++) {

                    $('#u_improve_feedback'+data.getidImprove[index].feed_back_id).prop("checked", true);
                 
                    
                }
                
            }
        });
    });

    $('.view').click(function(){
        // $(".u_good_feedback").prop("checked", false);
        // $(".u_improve_feedback").prop("checked", false);
        var id = $(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_data/" + id,
            dataType    : "json",
            success     : function(data){
                $('.result_name').html(data.student_name);
                console.log(data);

                // $.each(data.book_id.split(","), function(i,e){
                //     $("#u_book_id option[value='" + e + "']").prop("selected", true).trigger('change');
                // });

                // $('#update_id').val(data.id);
                // $('#u_student_id option[value= "'+data.student_id+'"]' ).prop("selected",true).trigger('change');
                // // $('#u_book_id option[value= "'+data.book_id+'"]' ).prop("selected",true).trigger('change');
                // $('#u_mispronounce').val(data.mispronounce);
                // $('#u_incorrect').val(data.incorrect);
                // $('#u_check_homework').val(data.check_homework);
                // $('#u_topic').val(data.topic);
                // $('#u_homework').val(data.homework);
                // $('#u_good_feedback').val(data.good_feedback);
                // $('#u_improve_feedback').val(data.improve_feedback);

                // $('#u_manage_id').attr("data-manage",data.getidGood[0].manage_id);


                // for (let index = 0; index < data.getidGood.length; index++) {

                //     $('#u_good_feedback'+data.getidGood[index].feed_back_id).prop("checked", true);
                    
                // }

                // for (let index = 0; index < data.getidImprove.length; index++) {

                //     $('#u_improve_feedback'+data.getidImprove[index].feed_back_id).prop("checked", true);
                 
                    
                // }
                
            }
        });
    });
    function click_update(id){
        // var id =  $('#update_id').val();
        $.ajax({
            type        : "GET",
            url         : "/view_data/" + id,
            success     : function(data){
               console.log(data);
            }
        });
    }

   
</script>


<!-- Script to download as png -->
<script type="text/javascript">
    function autoClick(){
        $("#Download").click();
    }

    $(document).ready(function(){
        var element = $('#download_data');

        $('#Download').on('click',function(){
            html2canvas(element,{
                onrendered: function(canvas){
                    var imgData = canvas.toDataURL("image/png");
                    var newData = imgData.replace(/^data:image\/png/, "data:application/octet-stream");

                    $("#Download").attr("Download","image.png").attr("href",newData); 
                }
            });
        });
    });
</script>


<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#submit').on('click',function(){
            e.preventDefault();

            const fb_id = [];
            const good_feedback = [];
            const improve_feedback = [];

            $('#fb_id').each(function(){
                if($(this).is(":checked")){
                    good_feedback.push($(this).val());
                }
            });

            $('input[name^="good_feedback[]"]').each(function(){
                good_feedback.push($(this).val());
            });

            $('input[name^="improve_feedback[]"]').each(function(){
                improve_feedback.push($(this).val());
            });

            $.ajax({
                url     : '{{route('manage')}}',
                type    : 'POST',
                data    : {

                    "_token": "{{ csrf_token() }}"

                    fb_id: fb_id,
                    good_feedback: good_feedback,
                    improve_feedback: improve_feedback
                },
                success:function(response){

                }
            });
        });
    });
</script> -->

@endsection
