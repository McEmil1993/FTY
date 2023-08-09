@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-success btn-md" style="width:160px" data-toggle="modal" data-target="#add_student" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> ADD STUDENT</b>
                </button>
            </div>
        </div>
        <div class="card" style="height: 550px;">
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
                                <button class="btn btn-md btn-primary update" data-id="{{$student->id}}" data-toggle="modal" data-target="#update_students" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-edit"></i>Edit
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"  id="submit">Submit</button>
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="update">Save Changes</button>
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

@endsection