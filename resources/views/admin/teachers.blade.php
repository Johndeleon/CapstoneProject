@extends('layouts.app2')

@section('content')
  {{ csrf_field() }}

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">

          <div class="card-header">Teachers
            <button class="item btn  btn-info" data-toggle="modal" data-target="#addTeacher">Add Teacher</button>
          </div>

          <div class="modal fade show" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form action="addteacher" method="post">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="">Create Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="firstName">First Name</label>
                      <input name="first_name" type="text" class="form-control" id="" required>
                    </div>

                    <div class="form-group">
                      <label for="lastName">Last Name</label>
                      <input name="last_name" type="text" class="form-control" id="" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" class="form-control" id="" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="contactNumber">Contact Number</label>
                      <input name="contact_number" type="text" class="form-control" id="" min=1 required>
                    </div>

                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input name="email" type="email" class="form-control" id="" min=1 required>
                    </div>

                    <div class="form-group">
                      <div> <label for="Email">Available Days</label> </div>
                      <div> <input type=checkbox>Everyday>  </div>
                      <div> <input type=checkbox>Monday>    </div>
                      <div> <input type=checkbox>Tuesday>   </div>
                      <div> <input type=checkbox>Wednesday> </div>
                      <div> <input type=checkbox>Thursday>  </div>
                      <div> <input type=checkbox>Friday>    </div>
                      <div> <input type=checkbox>Saturday>  </div>
                      <div> <input type=checkbox>Sunday>    </div>
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


          @foreach ($teachers as $teacher)
          <div class="modal fade show" id="editTeacher{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form  method="POST" action="/editteacher/{{$teacher->id}}">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="">Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="firstName">First Name</label>
                      <input name="first_name" type="text" class="form-control" id="" value="{{$teacher->first_name}}"required>
                    </div>

                    <div class="form-group">
                      <label for="lastName">Last Name</label>
                      <input name="last_name" type="text" class="form-control" id="" value="{{$teacher->last_name}}" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" class="form-control" id="" rows="3" required>{{$teacher->address}}</textarea>
                    </div>

                    <div class="form-group">
                      <label for="contactNumber">Contact Number</label>
                      <input name="contact_number" type="text" class="form-control" id="" min=1  value="{{$teacher->contact_number}}"required>
                    </div>

                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input name="email" type="email" class="form-control" id="" value="{{$teacher->email}}" required>
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

          @foreach ($teachers as $teacher)
          <div class="modal fade show" id="deleteTeacher{{ $teacher->id }}" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h1 class="lead">Delete Teacher?</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <form action="deleteteacher/{{$teacher->id}}" method="get">
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
@endsection
