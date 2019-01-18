@extends('layouts.app1')

@section('title')
  Courses Page
@endsection

@section('body')
<link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">

<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-11 mx-auto">
      <div class="card bg-me">
        <div class="card-header cat-header">
          <a href="#" class="float-right" style="font-size: 13px">
            <i class="fa fa-window-minimize" aria-hidden="true"></i>
          </a>
          <a href="#addCourse" id="addTeacher-btn" data-toggle="modal" class="float-right px-3 mr-3 cat-tab-btn">
            <i class="fa fa-book mr-1" aria-hidden="true"></i>
            Add Course
          </a>
        </div>

        <div class="table-responsive">
          <table class="cat-table table bg-dark table-hover">
            <thead>
              <tr>
                <th width="15%">Course Code</th>
                <th width="15%">Course Name</th>
                <th width="48%">Course Description</th>
                <th width="12%" class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach($courses as $course)
                <tr id="course{{$course->id}}" class="active">
                  <td>
                    <a href="course/{{$course->code}}">{{$course->code}}</a>
                  </td>
                  <td>
                    <a href="course/{{$course->code}}">{{$course->title}}</a>
                  </td>
                  <td>
                    {{$course->description}}
                  </td>
                  <td>
                    <button class="item btn  btn-info" data-toggle="modal" role="Edit" title="Edit" data-target="#EditCourse" value="{{ $course->id }}">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </button>

                    <button class="item btn  btn-danger" data-toggle="modal" role="Delete" title="Delete" data-target="#DeleteCourse" value="{{ $course->id }}">
                      <i class="fa fa-trash" aria-hidden="true"></i>
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
</div>


<!-- DELETE MODAL SECTION -->
@foreach ($courses as $course)
  <div class="modal fade show" id="DeleteCourse" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="lead">Delete Course?</h1>
        </div>

        <div class="modal-footer">
          <form action="/deletecourse/{{$course->id}}" method="get">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach


<!-- EDIT MODAL SECTION -->
@foreach ($courses as $course)
  <div class="modal fade show" id="EditCourse" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
      <form  method="POST" action="/editcourse/{{$course->id}}">
        {{ csrf_field() }}
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="">Edit Course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="courseCode">Course Code</label>
              <input name="code" type="text" class="form-control" id="" value="{{ $course->code }}" required>
            </div>
            <div class="form-group">
              <label for="courseName">Course Name</label>
              <input name="title" type="text" class="form-control" id="" value="{{ $course->title }}" required>
            </div>
            <div class="form-group">
              <label for="courseDescription">Course Description</label>
              <textarea name="description" class="form-control" id="" rows="3" required>{{ $course->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="units">Units</label>
              <input  name="units"  type="number" class="form-control" id="" value="{{$course->units}}" min=1 required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
            <button type="submit" class="btn btn-info">Save</button>
          </div>

        </div>
      </form>
    </div>
  </div>
@endforeach


<!-- ADD MODAL SECTION -->
<div class="modal fade show" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-lg" role="document">
    <form action="addcourse" method="post">
      {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Create Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="table-responsive">
            <table class="table table-bordered" id="dynamic_field">
            <tr>
            <td><input name="code[]" type="text" placeholder="Course Code" class="form-control" required></td>
            </tr>
            <tr>
            <td><input name="title[]" type="text" placeholder="Course Name" class="form-control" min=1 required></td>
            </tr>
            <tr>
            <td><textarea name="description[]" placeholder="Description" class="form-control" rows="3" required></textarea></td>
            </tr>
            <tr>
            <td><input name="units[]" type="number" placeholder="Units" class="form-control" min=1 required></td>
            </tr>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
            <button type="submit" class="btn btn-info">Create</button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>


{{-- FOR ERROR MESSAGE? --}}
<form name="add_name" id="add_name">
  <div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
  </div>
  <div class="alert alert-success print-success-msg" style="display:none">
    <ul></ul>
  </div>
</form>



<script type="text/javascript">

    var postURL = "<?php echo url('addmore'); ?>";


$(document).on('click','.open_modal',function(){
        var course_id = $(this).val();
});
    $(document).ready(function(){
      var i=1;

      $('#add').click(function(){
           i++;

           $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added"><table class="table table-bordered" id="dynamic_field"><tr><td><p>---------------------</p></td></tr><tr><td><input name="code[]" type="text" placeholder="Course Code" class="form-control" required></td></tr><tr><td><input name="title[]" type="text" placeholder="Course Name" class="form-control" min=1 required></td></tr><tr><td><textarea name="description[]" placeholder="Description" class="form-control" rows="3" required></textarea></td></tr><tr><td><input name="units[]" type="number" placeholder="Units" class="form-control" min=1 required></td></tr></tr><tr><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr></table></div>');
      });


      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });

      $('#submit').click(function(){
           $.ajax({
                url:postURL,
                method:"POST",
                data:$('#add_name').serialize(),
                type:'json',
           });
      });
    });
</script>
@endsection
