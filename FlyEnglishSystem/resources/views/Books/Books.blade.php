@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn bg-gradient-success btn-md" style="width:160px" data-toggle="modal" data-target="#add_book" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> ADD BOOK</b>
                </button>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><!-- /.card-header -->
                <div class="row">
                    <div class="col-lg-10">
                        <h5><b>LIST OF BOOKS</b></h5>
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
                            <th>Books Name</th>
                            <th>Topics</th>
                            <th>Sessions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($book as $books)
                        <tr>
                            <td>{{$books->book_name}}</td>
                            @if($books->topic_name != '')
                            <td>{{$books->topic_name}}</td>
                            @else
                                <td>None</td>
                            @endif
                            @if($books->session != '')
                                <td>Session {{$books->session}}</td>
                            @else
                                <td>None</td>
                            @endif
                            <td>
                                <button class="btn btn-md bg-gradient-primary update" data-id="{{$books->id}}" data-toggle="modal" data-target="#update_book" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-md bg-gradient-danger delete" data-id="{{$books->id}}" data-toggle="modal" data-target="#delete_book" data-backdrop="static" data-keyboard="false">
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
<div class="modal fade" id="add_book">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-book"></i> New Book</h4>
            </div>
            <form action="{{route ('add_books') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Name of the Book :</label>
                            <input class="form-control" name="book_name" id="book_name" placeholder="Type the name of the book" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Name of the Topic :</label>
                            <input class="form-control" name="topic_name" id="topic_name" placeholder="Type the name of the topic">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Session:</label>
                            <input type="number" class="form-control" name="session" id="session" placeholder="Input number only...">
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


<!-- Update Modal-->
<div class="modal fade" id="update_book">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-book"></i>
                        Update Book
                </h4>
            </div>
            <form action="{{route ('update_books') }}" method="POST">            
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Name of the Book :</label>
                            <input class="form-control" name="update_book_name" id="update_book_name" placeholder="Type the name of the book" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Name of the Topic :</label>
                            <input class="form-control" name="update_topic_name" id="update_topic_name" placeholder="Type the name of the topic">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Session:</label>
                            <input type="number" class="form-control" name="update_session" id="update_session" placeholder="Input number only...">
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


<!-- Delete all data -->
<div class="modal fade" id="deleteall">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Delete All Books</h4>
            </div>
            <form action="{{route ('delete_all_books') }}" method="POST">
                <input type="hidden" name="deleteall_id" id="deleteall_id"></input>
                <div class="modal-body">
                    @csrf
                    <center><h4>Are you sure you want to delete all books<i class="fas fa-question"></i></h4></center>
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
<div class="modal fade" id="delete_book">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Remove</h4>
            </div>
            <form action="{{route ('deleteBook') }}" method="POST">
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
    $('#active_book').addClass('new_active');
</script>

<script type="text/javascript">
    $('.delete').click(function(){
        var id= $(this).attr('data-id');
        $('#delete_id').val(id);
    });
</script>

@if(session('success'))
    <script type="text/javascript">
          toastr.success("{{ session('success') }}");
    </script>    
@endif

<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "ordering": true,
        "lengthMenu": [[8, 9, 12, 15, -1], [8, 9, 12, 15, "All"]]
        // "buttons": ["csv","pdf","","",""]
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

        var id = $(this).attr('data-id');
        $.ajax({

            type        : "GET",
            url         : "/edit_books/" + id,
            dataType    : "json",
            success     : function(data){

                $('#update_id').val(data.id);
                $('#update_book_name').val(data.book_name);
                $('#update_topic_name').val(data.topic_name);
                $('#update_session').val(data.session);
            }

        });
    });
</script>

@endsection
