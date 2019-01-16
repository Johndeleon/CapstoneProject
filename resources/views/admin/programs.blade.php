@extends('layouts.app1')

@section('title')
  Program Pages
@endsection

@section('head')
{{-- INSERT STYLE HERE --}}


@endsection


@section('body')
{{ csrf_field() }}

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header bg-info"> <span style="margin-top: 3px"></span>
          <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addProgram">
            Add Program
          </button>
        </div>

        <div class="row">
          <div class="col-md-12">

            <div class="table-responsive table">

              <table class="table-bordered">
                <tr class="text-center">
                  <th width="28%">Subject Title</th>
                  <th width="55%">Description</th>
                  <th width="12%">Action</th>
                </tr>

                @foreach($programs as $program)
                  <tr>
                    <td>
                      {{ $program->title }}
                      {{-- <div class="container">
                        <div class="dropdown">
                            <div class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{$program->title}}
                              <span class="caret"></span>
                            </div>
                            <ul class="dropdown-menu">
                              @for($i=1;$i<=$program->levels;$i++)
                                <a href="/program/{{$program->title}}/{{$i}}"><li>{{$i}}</li></a>
                              @endfor
                            </ul>
                        </div>
                      </div> --}}
                    </td>

                    <td>
                      {{ $program->description }}
                    </td>

                    <td>
                      <button class="item btn  btn-info" data-toggle="modal" role="Edit" title="Edit" data-target="#editProgram{{ $program->id }}">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                      </button>

                      <button class="item btn  btn-danger" data-toggle="modal" role="Delete" title="Delete" data-target="#deleteProgram{{ $program->id }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </table>

            </div>

          </div>
        </div>










        {{-- ADDPROGRAM MODAL --}}
        <div class="modal fade show" id="addProgram" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

              <div class="modal-header"> <h5 class="modal-title" id="">Create Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <form action="/admin/addprogram" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                  <div class="form-group">
                    <label for="programTitle">Program Name</label>
                    <input name="title" type="text" class="form-control" id="" required>
                  </div>
                  <div class="form-group">
                    <label for="programDescription">Description</label>
                    <textarea name="description" class="form-control" id="" rows="3" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="programLevels">Levels</label>
                    <input name="levels" type="number" class="form-control" id="" min=1 required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <button type="submit" class="btn btn-info">Create</button>
                </div>
              </form>

            </div>
          </div>
        </div>


        @foreach ($programs as $program)
        <div class="modal fade show" id="editProgram{{ $program->id }}" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-lg" role="document">
            <form  method="POST" action="/editprogram/{{$program->id}}">
            {{csrf_field()}}
              <div class="modal-content">

                <div class="modal-header"> <h5 class="modal-title" id="">Edit Program</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label for="programName">Program Name</label>
                    <input name="title" type="text" class="form-control" id="" value="{{ $program->title }}" required>
                  </div>

                  <div class="form-group">
                    <label for="programDescription">Program Description</label>
                    <textarea name="description" class="form-control" id="" rows="3" required>{{ $program->description }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="levels">Levels</label>
                    <input name="levels" type="number" class="form-control" id="" value="{{$program->levels}}" min=1 required>
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

        @foreach ($programs as $program)
        <div class="modal fade show" id="deleteProgram{{ $program->id }}" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

              <div class="modal-header"> <h1 class="lead">Delete Course?</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>

                <form action="deleteprogram/{{$program->id}}" method="get">
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
