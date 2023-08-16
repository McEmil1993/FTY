@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn bg-gradient-success btn-md" style="width:160px;padding-right:0px; padding-left:0px;" data-toggle="modal" data-target="#add_feedbacks" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> ADD FEEDBACK</b>
                </button>
            </div>
        </div>
        <div class="row">
            <!-- Good Feedback Table -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><!-- /.card-header -->
                        <h5>
                            <b>
                                <i class="fas fa-star text-warning"></i> 
                                GOOD FEEDBACKS
                            </b>
                        </h5>
                    </div>
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success text-md">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                    </div>
                    <div class="card-body table-responsive text-center"><!-- /.card-body -->
                        <table id="example1" class="table text-nowrap table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Feedbacks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tofs as $tof)
                                @if ($tof->status == 1)
                                <tr>
                                    <td>
                                        <i class="fas fa-star text-warning"></i>
                                        {{$tof->feedback}}
                                    </td>
                                    <td>
                                        <button class="btn btn-md bg-gradient-primary update" data-id="{{$tof->id}}" data-toggle="modal" data-target="#update_good_feedbacks" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bad Feedback Table -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><!-- /.card-header -->
                        <h5>
                            <b>
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                NEEDS TO REMEMBER
                            </b>
                        </h5>
                    </div>
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-danger text-md">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                            <i class="fas fa-exclamation-triangle text-white"></i>
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div class="card-body text-center"><!-- /.card-body -->
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Feedbacks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tofs as $tof)
                                @if ($tof->status == 2)
                                <tr>
                                    <td>
                                        <i class="fas fa-exclamation-triangle text-danger"></i> 
                                        {{$tof->feedback}}
                                    </td>
                                    <td>
                                        <button class="btn btn-md bg-gradient-primary improve" data-id="{{$tof->id}}" data-toggle="modal" data-target="#update_improve_feedbacks" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Modal-->
<div class="modal fade" id="add_feedbacks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-comments"></i> New Feedback</h4>
            </div>
            <form action="add_feedback" method="post">            
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label>Feedback :</label>
                            <textarea type="text" class="form-control" rows="2" name="feedback" id="feedback" placeholder="Type here..." required></textarea>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 mb-5">
                            <label>Select Type :</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" selected disabled>Select Feedback Type</option>
                                <option value="1">Good Feedback</option>
                                <option value="2">Need/Needs to Remember</option>
                            </select>
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


<!-- GoodFeedback Update Modal-->
<div class="modal fade" id="update_good_feedbacks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-star text-warning"></i> UPDATE (Good Feedbacks)</h4>
            </div>
            <form action="{{route ('update_feedback') }}" method="post">           
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label>Feedback :</label>
                            <textarea type="text" class="form-control" rows="2" 
                            name="good_feedback" id="good_feedback" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn bg-gradient-primary" id="update"><i class="fas fa-check"></i> Save Changes</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- NeedsToImprove Update Modal-->
<div class="modal fade" id="update_improve_feedbacks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger"></i> UPDATE (Need/Needs to remember)
                </h4>
            </div>
            <form action="{{route ('update_improve_feedback') }}" method="post">
                <div class="modal-body">
                    <input type="hidden" name="update_improve_id" id="update_improve_id">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <label>Feedback :</label>
                            <textarea type="text" class="form-control" rows="2" 
                            name="improve_feedback" id="improve_feedback" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn bg-gradient-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn bg-gradient-success" id="update"><i class="fas fa-check"></i> Save Changes</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Delete particular data -->
<div class="modal fade" id="delete_tof">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Remove Student</h4>
            </div>
            <form action="{{route ('deleteStudent') }}" method="POST">
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


@if(session('success'))
    <script type="text/javascript">
          toastr.success("{{ session('success') }}");
    </script>    
@endif


<script type="text/javascript">
    $('#active_tof').addClass('new_active');
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
        var id = $(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_feedback/" + id,
            dataType    : "json",
            success     : function(data){

                $('#update_id').val(data.id);
                $('#good_feedback').val(data.feedback);

            }
        });
    });
</script>


<script type="text/javascript">
    $('.improve').click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_feedback/" + id,
            dataType    : "json",
            success     : function(data){

            $('#update_improve_id').val(data.id);
            $('#improve_feedback').val(data.feedback);
            }
        });
    });
</script>


@endsection
