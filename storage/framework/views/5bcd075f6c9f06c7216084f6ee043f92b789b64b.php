<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/myDesign.css')); ?>">

<div class="container-fluid">
    <div class="row position-relative">

      <div class="dropdown">
 
        <div class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Academic Year 2018 - 2019
        </div>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="#">2019 - 2020</a></li>
          <li><a href="#">2020 - 2021</a></li>
          <li><a href="#">2021 - 2022</a></li>
          <li><a href="#">2022 - 2023</a></li>
        </ul>

      </div>

      <form id="sendAjax" class="" action="<?php echo e(URL::to('storeAcadYr')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <input id="AcadYr" type="text" name="AcadYr" value="">
        <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
      </form>

      <div id="demo">

      </div>


    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var addBtn = '<div class="addAcad"> + </div>'
        var addLi = '<li>' +
                      '<input class="liInput" id="test" type="text" name="academic-year" value="">' +
                      '<button type="submit" id="saveAcadYr" class="liInputBtn">S</button>'+
                    '</li>';
        var textArr;
        var input;

        function appendAddBtn() {
          $('.dropdown-menu').append(addBtn);
        }

        function prependInputNBtn() {
            $('.dropdown-menu').prepend(addLi);
        }

        // Run all HERE
        appendAddBtn();

        $('.addAcad').click(function() {
            prependInputNBtn();
        });

        // $("body").on("click", "#saveAcadYr", function(){
        //     /* TAKING THE VALUE OF DYNAMIC INPUT */
        //     $('input.liInput').each(function (){
        //         textArr = [];
        //         textArr.push($(this).val());
        //
        //         input = textArr.join("");
        //     });
        //
        //     $('#AcadYr').attr('value', input);
        //     $('#sendAjax').submit();
        //
        //     return false;
        //
        // });

        $("body").keypress(".liInput", function(e) {
            if (e.which == 13) {

              /* TAKING THE VALUE OF DYNAMIC INPUT */
              $('input.liInput').each(function (){
                  textArr = [];
                  textArr.push($(this).val());

                  input = textArr.join("");
              });

              /* REPLACING THE ATTR VALUE OF A HIDDEN FORM (#AcadYr) */
              $('#AcadYr').attr('value', input);

              $.ajax({
                  url: 'storeAcadYr',
                  type: 'POST',
                  data: {
                      '_token': $('input[name=_token]').val(),
                      'acadYr': $('input[name=AcadYr]').val()
                  },
                  success: function(data) {
                      alert("hello");
                  }

              });


              // $('#sendAjax').submit();
              // return false;    //<---- Add this line
            }
        });

    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>