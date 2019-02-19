@extends('layouts.app2')

@section('content')
  {{ csrf_field() }}

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">

          <div class="card-header">Course</div>
          <h1 class="home-heading pt-0 pb-5 text-center">{{$course->code}}: {{$course->title}}</h1>
          <h3 class="display-6 pt-2 pb-0 text-center">{{$course->description}}</h3>
          <h1 class="home-heading pt-0 pb-5 text-center">
            <button class="item btn  btn-info" data-toggle="modal" data-target="#assignTeacher"> Assign a Teacher </button>
          </h1>

          <table class="table-bordered">
            <tr>
              <th>Teachers</th>
            </tr>

            <tr>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>

            @foreach($courseTeachers as $teacher)
            <tr>
              <td>{{$teacher->first_name}}</td>
              <td>{{$teacher->last_name}}</td>
            </tr>
            @endforeach
          </table>

          <div class="modal fade show" id="assignTeacher" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form action="assignteacher" method="post">
                <div class="modal-content">

                  <div class="modal-header">
                  <h5 class="modal-title" id="">Assign a Teacher</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <input type="text" name="course_id" value="{{$course->id}}" hidden>
                      <label for="teacher">Teacher</label>
                      <select name="teacher" class="form-control" required>
                        @foreach($teachers as $teacher)
                          <option>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="semester">Semester</label>
                      <select name="semester" class="form-control" id="" required>
                        @foreach($semesters as $semester)
                          <option>{{$semester->semester}} of {{$semester->starts_at}} to {{$semester->ends_at}}</option>
                        @endforeach
                      </select>
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


        </div>
      </div>
    </div>
  </div>
@endsection
