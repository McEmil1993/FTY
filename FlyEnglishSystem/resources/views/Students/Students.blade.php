@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn bg-gradient-success btn-md" style="width:160px" data-toggle="modal" data-target="#add_student" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> ADD STUDENT</b>
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><!-- /.card-header -->
                <h5><b>LIST OF STUDENTS</b></h5>
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
                        @foreach($students as $student)
                        <tr>
                            <td>{{$student->student_name}}</td>
                            <td>
                                <button class="btn btn-md bg-gradient-primary update" data-id="{{$student->id}}" data-toggle="modal" data-target="#update_students" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-edit"></i>Edit
                                </button>
                                <button class="btn btn-md text-bold bg-gradient-danger delete" data-id="{{$student->id}}" data-toggle="modal" data-target="#delete_student" data-backdrop="static" data-keyboard="false">
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


<!-- Add Modal-->
<div class="modal fade" id="add_student">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user-friends"></i> New Student</h4>
            </div>
            <form action="{{route ('add_student') }}" id="form" method="POST">
                <div class="modal-body">
                    @csrf
                    <label>Student Name :</label>
                    <input class="form-control" name="student_name" id="student_name" placeholder="Type the name of the student" required>
                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn bg-gradient-danger"  data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn bg-gradient-success"  id="submit"><i class="fas fa-check"></i> Submit</button>
                    </div>
                </div>
            </form>          
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<!-- Update Modal-->
<div class="modal fade" id="update_students">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user-friends"></i> Update Student</h4>
            </div>
            <form action="{{route ('update_student') }}" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    @csrf
                    <label>Student Name</label>
                    <input class="form-control" name="u_student_name" id="u_student_name" required>
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


<!-- Delete particular data -->
<div class="modal fade" id="delete_student">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Remove</h4>
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
    $('.delete').click(function(){
        var id= $(this).attr('data-id');
        $('#delete_id').val(id);
    });
</script>

<script type="text/javascript">
    $('#active_student').addClass('new_active');
</script>


<script type="text/javascript">
    $('.update').click(function(){
        var id =$(this).attr('data-id');
        $.ajax({
            type        : "GET",
            url         : "/edit_student/" + id,
            dataType    : "json",
            success     : function(data){

            $('#update_id').val(data.id);
            $('#u_student_name').val(data.student_name);
            }
        });
    });
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
        "ordering": false,
    });
  });
</script>

@endsection