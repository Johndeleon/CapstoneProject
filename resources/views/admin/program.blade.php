@extends('layouts.app2')

@section('content')
{{ csrf_field() }}

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{$program->title}}</div>
        <button class="item btn  btn-info" data-toggle="modal" data-target="#createSchedule"> Create Schedule </button>
      </div>

      <div class="modal fade show" id="createSchedule" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
          <form action="createSchedule" method="post">
            <div class="modal-content">

              <div class="modal-header"> <h5 class="modal-title" id="">Create Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body">
                <div class="form-group">
                  <form name="add_course" id="add_course">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="teachercourse_data">
                        <tr>
                          <td>Course:
                            <select class="form-control" name="course_name[]">
                              @foreach($courses as $course)
                                <option>{{$course->title}}</option>
                              @endforeach
                            </select>
                          </td>

                          <td>Teacher:
                            <select class="form-control" name="teacher[]">
                              @foreach($teachers as $teacher)
                                <option>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                              @endforeach
                            </select>
                          </td>

                          <td>
                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                          </td>
                        </tr>
                      </table>
                      <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
                    </div>
                  </form>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-info">Create</button>
              </div>
            </div>
          </form>
        </div>
      </div>

{{-- SCRIPTS HERE --}}
<script>
  $(document).ready(function(){
    var i=1;

    $('#add').click(function(){
      i++;
      $('#teachercourse_data').append('<tr id="row'+i+'"><td><select name="course_name[]" class="form-control">@foreach($courses as $course)<option>{{$course->title}}</option>@endforeach</select></td><td><select class="form-control" name="teacher[]">@foreach($teachers as $teacher)<option>{{$teacher->first_name}} {{$teacher->last_name}}</option>@endforeach</select></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
    });

    $("#submit").click(function(){
      $.ajax({
        url:"/viewteachersubjects/savenewteachersubject",
        method:"POST",
        data:$('#add_subject').serialize(),
        success:function(data){
          alert(data);
          $('#add_subject')[0].reset();
        }
      });
    });

  });

</script>

    </div>
  </div>
</div>
@endsection
