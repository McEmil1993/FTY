@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn bg-gradient-success btn-md" style="width:160px;padding-right:0px; padding-left:0px;" data-toggle="modal" data-target="#set_feedback" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> SET FEEDBACK</b>
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><!-- /.card-header -->
                <div class="row">
                    <div class="col-lg-10">
                        <h5><b>FEEDBACKS OF THE STUDENT</b></h5>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-block bg-gradient-dark d_all" data-toggle="modal" data-target="#deleteall" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-trash-alt"></i> Delete All
                        </button>
                    </div>
                </div>
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
                                <button class="btn btn-md text-bold bg-gradient-primary update" data-id="{{$mf->id}}" data-toggle="modal" data-target="#u_set_feedback" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-md text-bold bg-gradient-warning view" data-id="{{$mf->id}}" data-toggle="modal" data-target="#view_data"  data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-eye"></i> View data
                                </button>
                                <button class="btn btn-md text-bold bg-gradient-danger delete" data-id="{{$mf->id}}" data-toggle="modal" data-target="#delete" onclick="click_update({{$mf->id}})" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <form action="{{route ('manage') }}" method="POST">
        @csrf
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-edit"></i> Manage Feedback</h4>
                <h4 class="modal-title">
                    <input type="date" class="form-control" style="width: 300px;" name="date" id="date" required>
                </h4>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-2">
                            <select class="form-control select2bs4" name="student_id" id="student_id" required>
                                <option value="" selected disabled>Select Student</option>
                                @foreach($manage_students as $ps)
                                    <option value="{{$ps->id}}">{{$ps->student_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-8 select2-cyan">
                            <select class="form-group select2" multiple="multiple" data-dropdown-css-class="select2-cyan" name="book_id[]" id="book_id" data-placeholder="Select Book | Topic | Session" required>
                                @foreach($manage_books as $pb)
                                <option value="{{$pb->id}}">
                                    {{$pb->book_name}}
                                    @if($pb->topic_name && $pb->session)
                                        ({{$pb->topic_name}} - Session {{$pb->session}})
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <label>MISPRONOUNCED WORD/S :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" name="mispronounce" id="mispronounce" placeholder="Type here..."></textarea>
                        </div>
                        <div class="col-lg-6">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <label>INCORRECT SENTENCE/S :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" name="incorrect" id="incorrect" placeholder="Type here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <i class="fas fa-check-circle text-success"></i>
                            <label>CORRECT SENTENCE/S :</label>
                            <textarea type="text" class="form-control" name="correct" id="correct" placeholder="Type the correct sentence..."></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <i class="fas fa-check text-success"></i> 
                            <label>HOMEWORK CHECKING (TOPIC):</label>
                            <textarea type="text" class="form-control mb-2" style="height: 65px;" name="topic" id="topic" placeholder="Type the topic given..." ></textarea>
                            <textarea type="text" class="form-control" style="height: 65px;" name="check_homework" id="check_homework" 
                            placeholder="Type the result of the homework..." ></textarea>
                        </div>
                        <div class="col-lg-6">
                            <i class="far fa-file-alt"></i>
                            <label>HOMEWORK :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" name="homework" id="homework" placeholder="Type here..."></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-3 mf_feedback">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-star text-warning"></i> 
                                        Choose Good Feedbacks
                                    </h3>
                                </div>
                                <div class="card-body table-responsive g_ck p-0" style="height: 300px;">
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
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                        Choose Need/Needs to Remember
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 300px;">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn bg-gradient-success" id="submit"><i class="fas fa-check"></i> Submit</button>
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
        <form action="{{route ('update') }}" method="POST">
        <input type="hidden" name="update_id" id="update_id">
        @csrf
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-edit"></i> 
                    Update Feedback
                </h4>
                <h4 class="modal-title">
                    <input type="date" class="form-control" name="u_date" id="u_date" required>
                </h4>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <select class="form-control select2bs4" name="u_student_id" id="u_student_id" required>
                                <option value="" selected disabled>Select Student</option>
                                @foreach($manage_students as $ups)
                                    <option value="{{$ups->id}}">{{$ups->student_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-8 select2-cyan">
                            <select class="form-group select2" multiple="multiple"
                            data-dropdown-css-class="select2-cyan" name="u_book_id[]" data-placeholder="Select Book" id="u_book_id" required>
                                @foreach($manage_books as $upb)
                                <option value="{{$upb->id}}">
                                    {{$upb->book_name}}
                                    @if($upb->topic_name && $upb->session)
                                        ({{$upb->topic_name}} - Session {{$upb->session}})
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <label>MISPRONOUNCED WORD/S :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" 
                            name="u_mispronounce" id="u_mispronounce" placeholder="Type here..."></textarea>
                        </div>
                        <div class="col-lg-6">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <label>INCORRECT SENTENCE/S :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" 
                            name="u_incorrect" id="u_incorrect" placeholder="Type here..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <i class="fas fa-check-circle text-success"></i>
                            <label>CORRECT SENTENCE/S :</label>
                            <textarea type="text" class="form-control" name="u_correct" id="u_correct" placeholder="Type the correct sentence..."></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <i class="fas fa-check text-success"></i> 
                            <label>HOMEWORK CHECKING (TOPIC) :</label>
                            <textarea type="text" class="form-control mb-2" style="height: 65px;" name="u_topic" id="u_topic" placeholder="Type the topic given..." ></textarea>
                            <textarea type="text" class="form-control" style="height: 65px;" name="u_check_homework" id="u_check_homework" placeholder="Type the result of the homework..." ></textarea>
                        </div>
                        <div class="col-lg-6">
                            <i class="far fa-file-alt"></i>
                            <label>HOMEWORK :</label>
                            <textarea type="text" class="form-control" style="height: 65px;" name="u_homework" id="u_homework" placeholder="Type here..."></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-3 mf_feedback">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-star text-warning"></i> 
                                        Choose Good Feedbacks
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 300px;">
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
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><!-- /.card-header -->
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                        Choose Need/Needs to Remember
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-0" style="height: 300px;">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit"  class="btn bg-gradient-primary" id="update"><i class="fas fa-check"></i> Save Changes</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 




<!-- ViewData Modal-->
<div class="modal fade viewModal" onload="autoClick();" id="view_data" >
    <div class="modal-dialog modal-xl"  >
        <div class="modal-content" id="download_data">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user"></i> Feedback for <span class="result result_name"></span>
                </h5>
                <h5 class="modal-title"><label>DATE :</label>
                    <span class="date_result"></span>
                </h5> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-default-message">
                            <div class="card-body">
                                <span class="default-message">
                                    Thank you so much "<span class="result result_name"></span>"  for having the class today. Your presence and effort are much appreciated.
                                    Just continue learning and managing your time and you will become more successful in your learning journey.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <form > -->
                    <div class="row">
                        <div class="col-lg-4">
                            <label>
                                <i class="fas fa-user"></i>
                                STUDENT NAME : 
                                <span class="text-success1 result_name"></span>
                            </label>
                            </br>
                            <label>
                                <i class="fas fa-book"></i>
                                BOOK/TOPIC/SESSION : 
                                <span class="text-success1 book_name_result"><br></span>
                            </label>
                            <hr>
                            <label>
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                MISPRONOUNCE WORD/S : 
                                <span class="mispronounce_name_result"></span>
                            </label>
                            <label>
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                INCORRECT SENTENCE/S : 
                                <span class="incorrect_name_result"></span>
                            </label>
                            <label>
                                <i class="fas fa-check-circle text-success"></i>
                                CORRECT SENTENCE/S : 
                                <span class="correct_name_result"></span>
                            </label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>
                                        <i class="fas fa-check text-success"></i>
                                        HOMEWORK CHECKING (TOPIC) : 
                                        <span class="check_homework_name_result"></span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label>
                                        <i class="far fa-file-alt"></i>
                                        HOMEWORK: <span class="homework_name_result"></span>
                                    </label> 
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-good">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <label>
                                                    <i class="fas fa-star text-warning"></i>
                                                    GOOD FEEDBACKS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span class="good_feedback_name_result"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card card-improve">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <label>
                                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                                    NEED/NEEDS TO REMEMBER
                                                </label> 
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <span class="improve_feedback_name_result"></span>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <a class="btn btn-md bg-gradient-dark toDL" id="Download">
                        <i class="fas fa-download"></i> Capture as img.
                    </a>
                </div>
            </div>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Delete all data -->
<div class="modal fade" id="deleteall">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Delete All Records</h4>
            </div>
            <form action="{{route ('delete_all') }}" method="POST">
                <input type="hidden" name="deleteall_id" id="deleteall_id"></input>
                <div class="modal-body">
                    @csrf
                    <center><h4>Are you sure you want to delete all data<i class="fas fa-question"></i></h4></center>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn bg-gradient-success" id="submit">
                            <i class="fas fa-check"></i> YES
                        </button>
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">
                        <i class="fas fa-times"></i> CANCEL
                        </button>
                    </div>
                </div>
            </form>        
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Delete particular data -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Remove</h4>
            </div>
            <form action="{{route ('delete_student') }}" method="POST">
                <input type="hidden" name="delete_id" id="delete_id"></input>
                <div class="modal-body">
                    @csrf
                    <center>
                        <h4>Are you sure you want to remove?</h4>
                    </center>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="submit" class="btn bg-gradient-success" id="submit">
                            <i class="fas fa-check"></i> YES
                        </button>
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i> CANCEL
                        </button>
                    </div>
                </div>
            </form>        
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    $('.delete').click(function(){
        var id= $(this).attr('data-id');
        $('#delete_id').val(id);
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
    $('.date').datetimepicker({
        format: 'MM/DD/YYYY',
        locale: 'en'
    });
    });
</script>

@if(session('success'))
    <script type="text/javascript">
          toastr.success("{{ session('success') }}");
    </script>    
@endif

@if(session('error'))
    <script type="text/javascript">
          Swal.fire({
                position: 'center',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
    </script>    
@endif


<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
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
        "ordering": true,
        "lengthMenu": [[8, 9, 12, 15, -1], [8, 9, 12, 15, "All"]]
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "ordering": true,
        "lengthMenu": [[8, 9, 12, 15, -1], [8, 9, 12, 15, "All"]]
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
                $('#u_date').val(data.date);
                $('#u_student_id option[value= "'+data.student_id+'"]' ).prop("selected",true).trigger('change');
                // $('#u_book_id option[value= "'+data.book_id+'"]' ).prop("selected",true).trigger('change');
                $('#u_mispronounce').val(data.mispronounce);
                $('#u_incorrect').val(data.incorrect);
                $('#u_correct').val(data.correct);
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
        $('.book_name_result').html('');
        $('.mispronounce_name_result').html('');
        $('.incorrect_name_result').html('');
        $('.correct_name_result').html('');
        $('.check_homework_name_result').html('');
        $('.good_feedback_name_result').html('');
        $('.improve_feedback_name_result').html('');
        // $(".u_good_feedback").prop("checked", false);
        // $(".u_improve_feedback").prop("checked", false);
        var id = $(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_data/" + id,
            dataType    : "json",
            success     : function(data){
                $('.result_name').html('<span>'+data.student_name+'</span>');
                $('.date_result').html('<span>'+data.date+'</span>');
                console.log(data);

                // console.log(data.book_result[]);

                // for (let index = 0; index < data.book_result.length; index++) {
                //     // console.log(data.book_result[index].book_name);
                //     $('.book_name_result').append('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.book_result[index].book_name + '( '+ data.book_result[index].topic_name +' ) -' +' Session '+ data.book_result[index].session+'</span>');
                // }
                
                
                // check if the topic_name and session is empty or null
                for (let index = 0; index < data.book_result.length; index++) {
                    const bookResult = data.book_result[index];
                    const bookName = bookResult.book_name;
                    const topicName = bookResult.topic_name;
                    const session = bookResult.session;
                        if (!topicName && !session) {
                            $('.book_name_result').append('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>' + bookName + '</span>');
                        }else{
                            $('.book_name_result').append('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.book_result[index].book_name + '( '+ data.book_result[index].topic_name +' ) -' +' Session '+ data.book_result[index].session+'</span>');
                        }
                }
                

                // $('.mispronounce_name_result').html('NONE');
                if(data.mispronounce === '' || data.mispronounce === null){
                    $('.mispronounce_name_result').addClass('text-danger1');
                    $('.mispronounce_name_result').removeClass('text-success1');
                    $('.mispronounce_name_result').html('NONE');
                }else{
                    $('.mispronounce_name_result').removeClass('text-danger1');
                    $('.mispronounce_name_result').addClass('text-success1');
                    $('.mispronounce_name_result').html('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.mispronounce+'</span>');
                }
                if(data.incorrect === '' || data.incorrect === null){
                    $('.incorrect_name_result').addClass('text-danger1');
                    $('.incorrect_name_result').removeClass('text-success1');
                    $('.incorrect_name_result').html('NONE');
                }else{
                    $('.incorrect_name_result').removeClass('text-danger1');
                    $('.incorrect_name_result').addClass('text-success1');
                    $('.incorrect_name_result').html('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.incorrect+'</span>');
                }

                if(data.correct === '' || data.correct === null){
                    $('.correct_name_result').addClass('text-danger1');
                    $('.correct_name_result').removeClass('text-success1');
                    $('.correct_name_result').html('NONE');
                }else{
                    $('.correct_name_result').removeClass('text-danger1');
                    $('.correct_name_result').addClass('text-success1');
                    $('.correct_name_result').html('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.correct+'</span>');
                }
                

                //check_homework_name_result

                if(data.topic === '' || data.topic === null && data.check_homework === '' || data.check_homework === null){
                    $('.check_homework_name_result').addClass('text-danger1');
                    $('.check_homework_name_result').removeClass('text-success1');
                    $('.check_homework_name_result').html('NONE');
                }else{
                    $('.check_homework_name_result').removeClass('text-danger1');
                    $('.check_homework_name_result').addClass('text-success1');
                    $('.check_homework_name_result').html('<br>'+'('+data.topic+')'+'</br><i class="fas fa-circle" style="color:black;font-size:10px"></i><span style="margin-left: 18px;">'+ data.check_homework+'</span>');
                }

                if(data.homework === '' || data.homework === null){
                    $('.homework_name_result').addClass('text-danger1');
                    $('.homework_name_result').removeClass('text-success1');
                    $('.homework_name_result').html('NONE');
                }else{
                    $('.homework_name_result').removeClass('text-danger1');
                    $('.homework_name_result').addClass('text-success1');
                    $('.homework_name_result').html('<br><i class="fas fa-circle" style="margin-right: 8px;color:black;font-size:10px"></i> <span>'+data.homework+'</span>');
                }

                // $('.homework_name_result').text(data.homework);

                if(data.getidGood_name.length === 0){
                    $('.good_feedback_name_result').html('<center><span class="text-danger1"> No data is available </span></center>');
                }else{
                    for (let index = 0; index < data.getidGood_name.length; index++) {
                        $('.good_feedback_name_result').append('<i class="fas fa-star text-warning "></i> <span class="text-dark text-bold">'+data.getidGood_name[index].feedback + '</span></br>');
                    }
                }

                if(data.getidImprove_name.length === 0){
                    $('.improve_feedback_name_result').html('<center><span class="text-danger1"> No data is available </span></center>');
                }else{
                    for (let index = 0; index < data.getidImprove_name.length; index++) {
                        $('.improve_feedback_name_result').append('<i class="fas fa-exclamation-triangle text-danger"></i> <span class="text-dark text-bold">'+data.getidImprove_name[index].feedback + '</span></br>');
                    }
                }
                
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
@endsection