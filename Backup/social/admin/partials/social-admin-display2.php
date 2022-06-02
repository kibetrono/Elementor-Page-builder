<?php defined( 'ABSPATH' ) or die( );  ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="swske-main-section">
    <div class="swske-top-header clearfix">

    <h1>Softwares</h1>
     <h6>A plugin that automatically displays selected social network(s) sharing buttons in posts and/or on pages.</h6>
    </div>   
    <div class= "swske-major-section">
        <div class="swske-section-wrap">
            <!-- start of row swske-top-row one-->
            <div class="row swske-top-row py-4">
                <h4> Main Social Networks:</h4>
                <hr>
                <p id="icon-choice">You have successfully chosen your preffered social share icons. </p>

                <form  class="swske-fozrm-icons mt-2 icon_choice_form" method="post" action="options.php">
                    <?php
                        // settings_fields( $option_group:string );
                        settings_fields('myownsettings' );
                        // do_settings_sections( $page:string )
                        do_settings_sections( 'myownsettings' )
                    ?>
                    <?php
                    $selectedfacebook=get_option('thefacebook');
                    $selectedtwitter=get_option('thetwitter');
                    $selectedlinkedin=get_option('thelinkedin');
                    $selectedpinterest=get_option('thepinterest');
                    $selectedemail=get_option('theemail');
                    $selectedwhatsapp=get_option('thewhatsapp');
                    ?>


                    <div class="col-md-4 mt-1"> 
                        <div>
                            <input <?php if($selectedfacebook == 'facebook'){echo 'checked';}; ?>  type="checkbox"  name="thefacebook" value="facebook" >
                            <label for="facebook"> <span><i class="fa fa-facebook"></i></span> Facebook</label>
                            <br>
                        </div>
                    </div>

                    <div class="col-md-4 mt-1">
                        <div>
                            <input <?php if($selectedtwitter == 'twitter'){echo 'checked';}; ?> type="checkbox"  name="thetwitter" value="twitter">
                            <label for="twitter"><span><i class="fa fa-twitter"></i></span> Twitter</label>
                            <br>
                        </div>        
                    </div>

                    <div class="col-md-4 mt-1">                                
                        <div>
                            <input <?php if($selectedlinkedin == 'linkedin'){echo 'checked';}; ?> type="checkbox" name="thelinkedin" value="linkedin">
                            <label for="linkedin"><span><i class="fa fa-linkedin"></i></span> Linkedin</label>
                            <br>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mt-1">
                        <div >
                            <input <?php if($selectedpinterest == 'pinterest'){echo 'checked';}; ?> type="checkbox" name="thepinterest" value="pinterest">
                            <label for="twitter"><span> <i class="fa fa-pinterest"></i> </span> Pinterest</label>
                            <br>
                        </div>        
                    </div>

                    <div class="col-md-4 mt-1">
                        <div >
                            <input <?php if($selectedemail == 'email'){echo 'checked';}; ?> type="checkbox" name="theemail" value="email">
                            <label for="email"><span><i class="fa  fa-envelope"></i></span> Email</label>
                            <br>
                        </div>        
                    </div>

                    <div class="col-md-4 mt-1">
                        <div >
                            <input <?php if($selectedwhatsapp == 'whatsapp'){echo 'checked';}; ?> type="checkbox" id="whatsapp" name="thewhatsapp" value="whatsapp">
                            <label for="whatsapp"><span><i class="fa  fa-whatsapp"></i></span> Whatsapp</label>
                            <br>
                        </div>        
                    </div>

                    <div class="col-md-4 mt-3">                       
                        <button id="bujttcon2" class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                                    
                </form>             
            </div>
            <!-- end of row swske-top-row one-->
            <br>
            <!-- start of row swske-top-row two-->
            <div class="row swske-top-row py-4">
                <h3> Share Options:</h3>
                <hr>
                <p id="share-option-choice">You have succefully chosen your preffered share option </p>

                <p style="font-size:17px">Please choose the option to display the networks</p>
               
                <form  class="swske-form mt-2 swske_share_option_form" method="post" action="options.php">
                <?php
                        settings_fields('myownposttypes' );
                        do_settings_sections( 'myownposttypes' )
                    ?>
                    <?php
                    $selectedtypepost=get_option('swsketheposts');
                    $selectedtypepage=get_option('swskethepages');
                    $selectedtypelandingpage=get_option('thelandingpages');
                    $selectedtypetemplates=get_option('thetemplates');
                    ?>

                     <div class="mt-1"> 
                        <div class="swske">
                            <input <?php if($selectedtypepost == 'is_single()'){echo 'checked';}; ?> type="checkbox" name="swsketheposts" value="is_single()">
                            <label> Posts</label>
                            <br>
                        </div>
                    </div>

                    <div class="mt-1"> 
                        <div>
                            <input <?php if($selectedtypepage == 'is_page()'){echo 'checked';}; ?> type="checkbox"  name="swskethepages" value="is_page()">
                            <label>Pages</label>
                            <br>
                        </div>
                    </div>

                    <div class="mt-1"> 
                        <div>
                            <input <?php if($selectedtypelandingpage == 'swske-landing-pages'){echo 'checked';}; ?> type="checkbox"  name="thelandingpages" value="swske-landing-pages">
                            <label > Landing Pages</label>
                            <br>
                        </div>
                    </div>

                    <div class="mt-1"> 
                        <div>
                            <input <?php if($selectedtypetemplates == 'swske-the-templates'){echo 'checked';}; ?> type="checkbox" name="thetemplates" value="swske-the-templates">
                            <label> My Templates</label>
                            <br>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">                       
                        <button id="btn" class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                    
                </form>             
            </div>
            <!-- end of row swske-top-row two-->
          
        </div>
       
    </div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<!-- <script>
    	$(document).ready(function() {

$("#btn").click(function(event){
event.preventDefault()

    var sws_post_type = [];
    $.each($("input[name='theposttypes2']:checked"), function(){
        sws_post_type.push($(this).val());
    });

    alert("General post types are : " + sws_post_type.join(", "));
});
});
</script> -->

<script>

    // start of social share icons
const icon_form = document.querySelector('.icon_choice_form');
const icon_Message = document.querySelector('#icon-choice');
icon_form.addEventListener('submit', (e) => {
  e.preventDefault();
  icon_Message.classList.add('show');
  setTimeout(() => icon_form.submit(), 2000);
});
// end of social share icons

    // start of share option
    const share_option_form = document.querySelector('.swske_share_option_form');
const share_option_Message = document.querySelector('#share-option-choice');
share_option_form.addEventListener('submit', (e) => {
  e.preventDefault();
  share_option_Message.classList.add('show');
  setTimeout(() => share_option_form.submit(), 2000);
});
// end of share option

 var input = document.getElementById("test");
input.addEventListener('drop', function (event) {
    event.preventDefault();
    var textData = event.dataTransfer.getData('text'); // get the dragged value
    var oldval = event.target.value; // get the old value in the input
    var newval = oldval + textData; // add it with the value which is dragged upon
    event.target.value = newval; // change the value with the new value
});
document.querySelector('[draggable="true"]').addEventListener('dragstart', function(e){
  e.dataTransfer.setData('text', e.target.innerHTML);
});

var div1 = $('#div1');
    var input1 = $('<input type="text" readonly value="Some Text" style="position:absolute;top:0;left:0;border:0">');
    input1.appendTo(div1);   
    $('#div1').draggable({
                cancel: ''
    });
// $(function() {
 
// });

</script>