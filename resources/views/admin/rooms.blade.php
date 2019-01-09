@extends('layouts.app1')

@section('title')
  Rooms Page
@endsection

@section('body')
  {{ csrf_field() }}

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">

          <div class="card-header"><span style="line-height: 2em;">Rooms</span>
            <button class="item btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addRoom">
              Add Room
            </button>
          </div>

          <div class="row">
            <div class="col-md-12 table-responsive">

              <table class="table table-bordered">
                <tr class="text-center">
                  <th>Room Name</th>
                  <th>Room Type</th>
                  <th>Room Available From</th>
                  <th>Room Available Until</th>
                  <th width="12.5%">Actions</th>
                </tr>

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
              </table>

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


        </div>
      </div>
    </div>
  </div>
@endsection
