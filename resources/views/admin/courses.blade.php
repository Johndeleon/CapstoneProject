@extends('layouts.app1')

@section('body')
  {{ csrf_field() }}

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Courses
            <button class="item btn  btn-info btn-sm float-right" data-toggle="modal" data-target="#addCourse">
              Add Course
            </button>
          </div>

          <div class="row">
            <div class="col-md-12">

              <div class="table table-responsive">
                <table class="table-bordered">
                  <tr class="text-center">
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th width="12.5%">Action</th>
                  </tr>

                  @foreach($courses as $course)
                    <tr>
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
                        <button class="item btn  btn-info" data-toggle="modal" title="Edit" data-target="#editCourse{{ $course->id }}">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>

                        <button class="item btn  btn-danger" data-toggle="modal" title="Delete" data-target="#deleteCourse{{ $course->id }}">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>

            </div>
          </div>



          {{-- ADDING COURSES MODAL --}}
          <div class="modal fade show" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form action="addcourse" method="post">

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
                          <td>
                            <input name="code[]" type="text" placeholder="Course Code" class="form-control" required>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <input name="title[]" type="text" placeholder="Course Name" class="form-control" min=1 required>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <textarea name="description[]" placeholder="Description" class="form-control" rows="3" required></textarea>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <input name="units[]" type="number" placeholder="Units" class="form-control" min=1 required>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <input name="total_hours[]" type="number" placeholder="Total Hours" class="form-control" min=2 required>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <label for="courseCategory">Course Category</label>

                            <select  name ="course_category_id[]" class="form-control" required>
                              @foreach($courseCategories as $courseCategory)
                                <option value="{{$courseCategory->id}}"><p>{{$courseCategory->title}}</p></option>
                              @endforeach
                            </select>
                          </td>
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

            {{-- FOR ERROR MESSAGE? --}}
            <form name="add_name" id="add_name">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
              </div>

              <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
              </div>
            </form>





            @foreach ($courses as $course)
            <div class="modal fade show" id="editCourse{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="">
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

            @foreach ($courses as $course)
            <div class="modal fade show" id="deleteCourse{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="lead">Delete Course?</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                    <form action="deletecourse/{{$course->id}}" method="get">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">

  $(document).ready(function(){
    var postURL = "<?php echo url('addmore'); ?>";
    var i=1;

    $('#add').click(function(){
      i++;

      $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added"><table class="table table-bordered" id="dynamic_field"><tr><td><p>---------------------</p></td></tr><tr><td><input name="code[]" type="text" placeholder="Course Code" class="form-control" required></td></tr><tr><td><input name="title[]" type="text" placeholder="Course Name" class="form-control" min=1 required></td></tr><tr><td><textarea name="description[]" placeholder="Description" class="form-control" rows="3" required></textarea></td></tr><tr><td><input name="units[]" type="number" placeholder="Units" class="form-control" min=1 required></td></tr><tr><td><label for="courseCategory">Course Category</label><select name="course_category_id[]" class="form-control"  required>@foreach($courseCategories as $courseCategory)<option value="{{$courseCategory->id}}"><p>{{$courseCategory->title}}</p></option>@endforeach</select></td></tr><tr><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr></table></div>');

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
