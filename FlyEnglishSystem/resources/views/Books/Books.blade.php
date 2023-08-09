@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row p-2">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button class="btn btn-success btn-md" style="width:160px" data-toggle="modal" data-target="#add_book" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-plus"></i> ADD BOOK</b>
                </button>
            </div>
        </div>
        <div class="card" style="height: 550px;">
            <div class="card-header"><!-- /.card-header -->
                <h5><b>LIST OF BOOKS</b></h5>
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
                            <td>{{$books->topic_name}}</td>
                            <td>Session {{$books->session}}</td>
                            <td>
                                <button class="btn btn-md btn-primary update" data-id="{{$books->id}}" data-toggle="modal" data-target="#update_book" data-backdrop="static" data-keyboard="false">
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
                            <input class="form-control" name="topic_name" id="topic_name" placeholder="Type the name of the topic" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Session:</label>
                            <input type="number" class="form-control" name="session" id="session" placeholder="Input number only..." required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="submit">Submit</button>
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
                            <input class="form-control" name="update_topic_name" id="update_topic_name" placeholder="Type the name of the topic" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Session:</label>
                            <input type="number" class="form-control" name="update_session" id="update_session" placeholder="Input number only..." required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="update">Save Changes</button>
                </div> 
            </form>         
        </div><!-- /.modal-content --> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<script type="text/javascript">
    $('#active_book').addClass('new_active');
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
        "ordering": false,
        "lengthMenu": [[5, 6, 9, 12, -1], [5, 6, 9, 12, "All"]],
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
