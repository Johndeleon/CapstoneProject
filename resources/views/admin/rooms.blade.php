@extends('layouts.app1')

@section('title')
  Rooms Page
@endsection

@section('body')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">
  {{ csrf_field() }}

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-11 mx-auto">
        <div class="card bg-me">
          <div class="card-header cat-header">
            <a href="#" class="float-right" style="font-size: 13px">
              <i class="fa fa-window-minimize" aria-hidden="true"></i>
            </a>
            <a href="#addRoom" id="addTeacher-btn" data-toggle="modal" class="float-right px-3 mr-3 cat-tab-btn">
                <i class="fa fa-university mr-1" aria-hidden="true"></i>
              Add Rooms
            </a>
          </div>

          <div class="table-responsive">
            <table class="cat-table table bg-dark table-hover">
              <thead>
                <tr>
                  <th>Room Name</th>
                  <th>Room Type</th>
                  <th>Room Available From</th>
                  <th>Room Available Until</th>
                  <th width="12.5%" class="text-center">Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($rooms as $room)
                <tr>
                  <td>
                    {{$room->room_name}}
                  </td>

                  <td>
                    {{$room->room_type}}
                  </td>

                  <td>
                    {{$room->available_time_start}}
                  </td>

                  <td>
                    {{$room->available_time_finish}}
                  </td>

                  <td>
                    <button class="item btn  btn-info" data-toggle="modal" data-target="#editRoom{{ $room->id }}">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </button>
                    <button class="item btn  btn-danger" data-toggle="modal" data-target="#deleteRoom{{ $room->id }}">
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


  <div class="modal fade show" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
      <form action="addroom" method="post">
        {{csrf_field()}}
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="">Create Room</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="roomName">Room Name</label>
              <input name="room_name" type="text" class="form-control" id="" required>
            </div>

            <div class="form-group">
              <label for="roomType">Room Type</label>

              <select name="room_type" class="form-control" required>
                @foreach($roomTypes as $roomType)
                  <option>{{$roomType->room_type}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="availableFrom">Available From</label>

              <select name="available_from" class="form-control" required>
                @for($i=0;$i<$count;$i++)
                  <option>{{$times[$i]}}</option>
                @endfor
              </select>
            </div>

            <div class="form-group">
              <label for="availableFrom">Available Until</label>

              <select name="available_until" class="form-control" required>
                @for($i=0;$i<$count;$i++)
                  <option>{{$times[$i]}}</option>
                @endfor
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

  @foreach ($rooms as $room)
  <div class="modal fade show" id="editRoom{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
      <form  method="POST" action="/editroom/{{$room->id}}">
      {{csrf_field()}}
        <div class="modal-content">

          <div class="modal-header">
          <h5 class="modal-title" id="">Edit Room</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label for="roomName">Room Name</label>
              <input name="room_name" type="text" class="form-control" id="" value="{{$room->room_name}}" required>
            </div>
            <div class="form-group">
              <label for="roomType">Room Type</label>

              <select name="room_type" class="form-control" required>
                @foreach($roomTypes as $roomType)
                  <option>{{$roomType->room_type}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="availableFrom">Available From</label>

              <select name="available_from" class="form-control" required>
                @for($i=0;$i<$count;$i++)
                  <option>{{$times[$i]}}</option>
                @endfor
              </select>
            </div>

            <div class="form-group">
              <label for="availableFrom">Available Until</label>

              <select name="available_until" class="form-control" required>
                @for($i=0;$i<$count;$i++)
                  <option>{{$times[$i]}}</option>
                @endfor
              </select>
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

  @foreach ($rooms as $room)
  <div class="modal fade show" id="deleteRoom{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="lead">Delete Room?</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
          <form action="deleteroom/{{$room->id}}" method="get">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection
