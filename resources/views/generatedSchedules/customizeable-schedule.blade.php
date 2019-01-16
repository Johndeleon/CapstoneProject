@extends('layouts.app1')

@section('head')
    
@endsection

@section('title')
    
@endsection

@section('body')
    @csrf
    <div class="container">
        <div class="row">
            <div class="card col-md-12 mx-auto mb-3">
                <div class="row">

                    
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Monday
                        </div>

                        <div id="monday" class="row pt-3">

                                

                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Tuesday
                        </div>

                        <div id="tuesday" class="row pt-3">

                                

                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Wednesday
                        </div>

                        <div id="wednesday" class="row pt-3">

                                

                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Thursday
                        </div>

                        <div id="thursday" class="row pt-3">

                                

                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Friday
                        </div>

                        <div id="friday" class="row pt-3">

                                

                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="card-header text-center">
                            Saturday
                        </div>

                        <div id="saturday" class="row pt-3">

                                

                        </div>
                    </div>


                </div>

                    

                    {{-- <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="16.66">Monday</th>
                                    <th width="16.66">Tuesday</th>
                                    <th width="16.66">Wednesday</th>
                                    <th width="16.66">Thursday</th>
                                    <th width="16.66">Friday</th>
                                    <th width="16.66">Saturday</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <tr>
                                    <td id="monday"></td>
                                    <td id="tuesday"></td>
                                    <td id="wednesday"></td>
                                    <td id="thursday"></td>
                                    <td id="friday"></td>
                                    <td id="saturday"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div> --}}



            </div>
        </div>
    </div>



    <script>
        var data = window.localStorage["programs"];
        
        // data['aYId', 'ProgramId', 'semester']
        
        

        $(document).ready(function() {
            $.post('/postIds', {

                academicID: data[0],
                programID: data[2],
                semester: data[4],
                '_token': $('input[name=_token]').val()

            }, function(data, status) {

                // console.log(data);

                data.forEach (function (item) {
                    if (item['day'] == 1) { // Monday
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#monday').append(subjectWrapper);
                    }
                    else if (item['day'] == 2) {
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#tuesday').append(subjectWrapper);
                    }
                    else if (item['day'] == 3) {
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#wednesday').append(subjectWrapper);
                    }
                    else if (item['day'] == 4) {
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#thursday').append(subjectWrapper);
                    }
                    else if (item['day'] == 5) {
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#friday').append(subjectWrapper);
                    }
                    else if (item['day'] == 6) {
                        var subjectWrapper = '<div class="card col-md-12 border-left-0 border-right-0 rounded-0 bg-light" style="min-height: 140px">'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<div> <b>'+ item['subject'] +'</b> </div>'+
                                                    '<div>'+ item['teacher'] +'</div>'+
                                                    '<div>'+ item['time'] +'</div>'+
                                                    '<div>'+ item['room'] +'</div>'+
                                                '</div>'+
                                            '</div>';

                        $('#saturday').append(subjectWrapper);
                    }
                });
                
                
                // data.forEach(function (element) {
                //     var subjectWrapper = '<div class="card mb-2" style="width: auto;">'+
                //                             '<div class="card-body text-center">'+
                //                                 '<div> <b>'+ element['subject'] +'</b> </div>'+
                //                                 '<div>'+ element['teacher'] +'</div>'+
                //                                 '<div>'+ element['time'] +'</div>'+
                //                                 '<div>'+ element['room'] +'</div>'+
                //                             '</div>'
                //                        '</div>';

                //     $('#monday').append(subjectWrapper);
                    
                    
                // });




            });

            $days = [
                '#monday', '#tuesday', '#wednesday', '#thursday', '#friday', '#saturday'
            ];

            $monday = [
                '#tuesday', '#wednesday', '#thursday', '#friday', '#saturday'
            ];
            $tuesday = [
                '#monday', '#wednesday', '#thursday', '#friday', '#saturday'
            ];
            $wednesday = [
                '#monday', '#tuesday', '#thursday', '#friday', '#saturday'
            ];
            $thursday = [
                '#monday', '#tuesday', '#wednesday', '#friday', '#saturday'
            ];
            $friday = [
                '#monday', '#tuesday', '#wednesday', '#thursday', '#saturday'
            ];
            $saturday = [
                '#monday', '#tuesday', '#wednesday', '#thursday', '#friday'
            ];

            $('#monday').sortable({connectWith: $monday, dropOnEmpty: true});
            $('#tuesday').sortable({connectWith: $tuesday});
            $('#wednesday').sortable({connectWith: $wednesday});
            $('#thursday').sortable({connectWith: $thursday});
            $('#friday').sortable({connectWith: $friday});
            $('#saturday').sortable({connectWith: $saturday});

        });
    </script>
@endsection