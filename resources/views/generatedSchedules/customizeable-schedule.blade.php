@extends('layouts.app1')

@section('title') CSS | Generated Schedule Customization @endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/class/customization.class.css') }}">
@endsection

@section('scriptstop')
<script src="{{ asset('js/class/customization.class.js') }}"></script>
@endsection

{{-- Main Content --}}
@section('content')
@csrf
<div class="container-fluid">
    <div class="row">
        <button id="gen-btn" class="btn btn-primary ml-auto mb-3">Generate Schedule</button>

        <div class="card col-md-11">
            <div class="row">


                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Monday
                        </div>
                    </div>

                    <div id="monday-1" class="row pt-3 emptimize">



                    </div>
                </div>
                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Tuesday
                        </div>
                    </div>

                    <div id="tuesday-2" class="row pt-3 emptimize">



                    </div>
                </div>
                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Wednesday
                        </div>
                    </div>

                    <div id="wednesday-3"  class="row pt-3 emptimize">



                    </div>
                </div>
                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Thursday
                        </div>
                    </div>

                    <div id="thursday-4" class="row pt-3 emptimize">


                    </div>
                </div>
                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Friday
                        </div>
                    </div>

                    <div id="friday-5" class="row pt-3 emptimize">



                    </div>
                </div>
                <div class="col-md-2 card rounded-0 ct-card-sched">

                    <div class="row">
                        <div class="card-header col-md-12 text-center">
                            Saturday
                        </div>
                    </div>

                    <div id="saturday-6" class="row pt-3 emptimize">

                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-1 save-schedule-wrapper text-center pt-3" hidden>
            <a href="/admin/dashboard">
                <button id="saveSched" class="btn btn-primary bg-blue btn-circle btn-md-3 mb-3" title="Save and Exit">
                    <i class="fa fa-save"></i>
                </button>
            </a>

            <button id="deleteSched" class="btn btn-danger btn-circle btn-md-3 mb-3" title="Delete">
                <i class="fa fa-trash"></i>
            </button>
        </div>

    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

<script type="text/javascript">

    $(function() {
        customizationMaintenance.init();
    });

</script>

@endsection