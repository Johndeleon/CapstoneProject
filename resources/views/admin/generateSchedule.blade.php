@extends('layouts.app1')

@section('title')
    Schedules Generation
@endsection

@section('head')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/myDesign.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/GSDesign.css') }}">
@endsection

@section('body')
  <div class="container-fluid">
    <div class="row">
      <div class="mx-auto col-md-12">
        <div class="row">

          @if (count($programs))
            @foreach ($programs as $program)

              <div class="col-md-3 mb-2">
                <div class="card text-align">
                  <div class="card-body">
                    <h1>{{ $program->title }}</h1>
                  </div>

                  <div class="card-footer">
                    <div class="row ml-3 mr-3">
                      {{-- <div class="col-md-3">
                        <button class="btn btn-primary">1</button>
                      </div> --}}

                      <div class="col-md-3">
                        <a href="/admin/generate-form/{{ $program->id }}">
                          <button class="btn btn-primary">{{ $program->levels }}</button>
                        </a>
                      </div>


                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          @endif

          {{-- <div class="col-md-3 mb-2">
            <div class="card text-align">
              <div class="card-body">
                <h1>BSIS</h1>
              </div>

              <div class="card-footer">
                <div class="row ml-3 mr-3">
                  <div class="col-md-3">
                    <button class="btn btn-primary">1</button>
                  </div>

                  <div class="col-md-3">
                    <button class="btn btn-primary">2</button>
                  </div>

                  <div class="col-md-3">
                    <button class="btn btn-primary">3</button>
                  </div>

                  <div class="col-md-3">
                    <button class="btn btn-primary">4</button>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
  </div>
@endsection
