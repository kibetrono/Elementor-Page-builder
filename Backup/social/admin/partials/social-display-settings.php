<?php defined( 'ABSPATH' ) or die( ); 
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="swske-main-section">
    <div class="swske-top-header clearfix">
     <h6>A plugin that automatically displays selected social network(s) sharing buttons in posts and/or on pages.</h6>
    </div>  
    <div class= "swske-major-section ">
        <div class="swske-section-wrap">
            <!-- start of row swske-top-row one-->
            <div class="row swske-top-row py-4">

                <h4> Button Sizes:</h4>
                <hr>
                <p id="thank-you-message">You have successfully chosen the button size</p>
                <p style="font-size:17px">Please select the size of the button</p>
                <form class="btn_size_form" onsubmit="myFunction()" method="post" action="options.php">
                    <?php
                        // settings_fields( $option_group:string );
                        settings_fields('myownbuttonsize' );
                        // do_settings_sections( $page:string )
                        do_settings_sections( 'myownbuttonsize' )
                    ?>

                    <?php

                    $selectedoption= get_option('thebuttonsize');

                    ?>
                    <select name="thebuttonsize"  id="exampleFormControlSelect1">
                    <option <?php if($selectedoption == 'small'){echo 'selected';}; ?> >small</option>
                    <option <?php if($selectedoption == 'medium'){echo 'selected';};?> >medium</option>
                    <option <?php if($selectedoption == 'large'){echo 'selected';};?> >large</option>

                    </select>

                    <div class="col-md-2 mt-3">                       
                        <button id="btnSize" class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                                    
                </form>             
            </div>
            <!-- end of row swske-top-row one-->
            <br>

             <!-- start of row swske-top-row one-->
             <div class="row swske-top-row py-4">
                <h4>Social Network Color:</h4>
                <hr>
                <p id="color-message">You have successfully chosen the button color</p>

                <p id="cccx" style="font-size:17px">Please choose the color of the social networks</p>
                <form class="btn_color_form"  method="post" action="options.php">
                    <?php
                        // settings_fields( $option_group:string );
                        settings_fields('myownbuttoncolor' );
                        // do_settings_sections( $page:string )
                        do_settings_sections( 'myownbuttoncolor' )
                    ?>

                    <?php
                        $selectedcolor=get_option('thecolor');
                    ?>
                  <div class="row">
                      <div class="col-md-1">
                      <select name="thecolor" id="allselectioncolor">
                      <option <?php if($selectedcolor == 'Default'){echo 'selected';} ?>>Default</option>
                      <option id="ColorPickerValue"  <?php if($selectedcolor !== 'Default'){echo 'selected';} ?>>ColorPicker</option>
                  </select>
                      </div>
                      <div class="col-md-3">
                          <div id="display_block" style="display:none">
                            <input class="ColorPickerArea">
                          </div>
                          
                      </div>
                  </div>

                    <div class="col-md-2 mt-3">                       
                        <button class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                                    
                </form>             
            </div>
            <!-- end of row swske-top-row one-->
            <br>

             <!-- start of row swske-top-row one-->
             <div class="row swske-top-row py-4">
                <h4>Button Order:</h4>
                <hr>
                <p id="btn-order">You have successfully chosen the order appearance of the buttons</p>

                <p style="font-size:17px">Please choose an option to determine in which order the icons will appear. i.e </p>
                <p style="font-size:17px">From Facebook to Whatsapp
                <divs class="swske_order_btn">
                <i  class="fa fa-facebook"> </i>
                <i  class="fa fa-twitter"></i>
                <i  class="fa fa-linkedin"></i>
                <i  class="fa fa-pinterest"></i>
                <i  class="fa fa-envelope"></i>
                <i  class="fa fa-whatsapp"></i>
                </divs>
                <br>
                
                From Whatsapp to Facebook
                <divs class="swske_order_btn">
                <i  class="fa fa-whatsapp"></i>
                <i  class="fa fa-envelope"></i>
                <i  class="fa fa-pinterest"></i>
                <i  class="fa fa-linkedin"></i>
                <i  class="fa fa-twitter"></i>
                <i  class="fa fa-facebook"> </i>
                </divs>
            </p>      
                
                <form class="btn_appearence_form"  method="post" action="options.php">
                    <?php
                        // settings_fields( $option_group:string );
                        settings_fields('myownarrangement' );
                        // do_settings_sections( $page:string )
                        do_settings_sections( 'myownarrangement' )
                    ?>
                <?php
                        $selectedorder=get_option('the_arrangement_order')
                ?>

                <select name="the_arrangement_order" id="">
                      <option <?php if($selectedorder == 'From Facebook to Whatsapp'){echo 'selected';} ?>>From Facebook to Whatsapp</option>
                      <option <?php if($selectedorder == 'From Whatsapp to Facebook'){echo 'selected';} ?>>From Whatsapp to Facebook</option>
                  </select>

                    <div class="col-md-2 mt-3">                       
                        <button class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                                    
                </form>             
            </div>
            <!-- end of row swske-top-row one-->
            <br>

             <!-- start of row swske-top-row one-->
             <div class="row swske-top-row py-4">
                <h4> Display Position:</h4>
                <hr>
                <p id="btn-place">You have successfully chosen an option(s) to place the social share bar</p>

                <p style="font-size:17px">Please choose an options to place the social share bar </p>
                <form class="btn_place_form"  method="post" action="options.php">
                    <?php
                        // settings_fields( $option_group:string );
                        settings_fields('myownbtnposition' );
                        // do_settings_sections( $page:string )
                        do_settings_sections( 'myownbtnposition' )
                    ?>
                    <?php
                    $selectedbefore=get_option('thebefore');
                    $selectedafter=get_option('theafter');
                    $selectedbelow=get_option('thebelow');
                    $selectedfloat=get_option('thefloating');
                    $selectedinside=get_option('theinside');
                    ?>
                      <div class="col-md-2 mt-1">
                        <div class="swske">
                            <input <?php if($selectedbefore == 'before'){echo 'checked';}; ?> type="checkbox" id="cpt" name="thebefore" value="before">
                            <label for="cpt">Before the post content</label><br>                      
                         </div>        
                    </div>

                    <div class="col-md-2 mt-1">
                        <div class="swske">
                            <input <?php if($selectedafter == 'after'){echo 'checked';}; ?> type="checkbox" id="cpt" name="theafter" value="after">
                            <label for="cpt">After the post content</label><br>                      
                         </div>        
                    </div>

                    <div class="col-md-2 mt-1"> 
                        <div class="swske" >
                            <input <?php if($selectedbelow == 'below'){echo 'checked';}; ?> type="checkbox" id="posts" name="thebelow" value="below" >
                            <label for="posts">below the post title</label><br>                    
                        </div>
                    </div>

                    <div class="col-md-2 mt-1">
                        <div class="swske">
                            <input <?php if($selectedfloat == 'floating'){echo 'checked';}; ?> type="checkbox" id="pages" name="thefloating" value="floating" >
                            <label for="pages">Floating on the left area</label><br>                      
                         </div>        
                    </div>

                    <div class="col-md-2 mt-1">
                        <div class="swske-">
                            <input <?php if($selectedinside == 'inside'){echo 'checked';}; ?> type="checkbox" id="cpt" name="theinside" value="inside">
                            <label for="cpt">Inside the featured image</label><br>                     
                         </div>        
                    </div>

                    <div class="col-md-2 mt-3">                       
                        <button class="btn btn-primary btn-sm">Save Options</button>      
                    </div>
                                    
                </form>             
            </div>
            <!-- end of row swske-top-row one-->
            <br>
 
        </div>

</div>
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>

    // start of btn size form
    const form = document.querySelector('.btn_size_form');
    const thankYouMessage = document.querySelector('#thank-you-message');
    form.addEventListener('submit', (e) => {
    e.preventDefault();
    thankYouMessage.classList.add('show');
    setTimeout(() => form.submit(), 2000);
    });
    // end of btn size form

    // start of btn color form
    const color_form = document.querySelector('.btn_color_form');
    const colorMessage = document.querySelector('#color-message');
    color_form.addEventListener('submit', (e) => {
    e.preventDefault();
    colorMessage.classList.add('show');
    setTimeout(() => color_form.submit(), 2000);
    });
    // end of btn color form

    // start of btn appearence form
    const order_form = document.querySelector('.btn_appearence_form');
    const order_Message = document.querySelector('#btn-order');
    order_form.addEventListener('submit', (e) => {
    e.preventDefault();
    order_Message.classList.add('show');
    setTimeout(() => order_form.submit(), 2000);
    });
    // end of btn appearence form

    // start of btn place form
    const place_form = document.querySelector('.btn_place_form');
    const place_Message = document.querySelector('#btn-place');
    place_form.addEventListener('submit', (e) => {
    e.preventDefault();
    place_Message.classList.add('show');
    setTimeout(() => place_form.submit(), 2000);
    });
    // end of btn place form



        $('.btn_color_form').on('click', function() {


            var conceptName = $('#allselectioncolor').find(":selected").text();

            if(conceptName == 'ColorPicker'){
                $("#display_block").css("display", "block");
                
                $('.ColorPickerArea').wpColorPicker()

                var c=$('.ColorPickerArea').val()
                
                $("#ColorPickerValue").val(c)
            }else if(conceptName == 'Default'){
                $("#display_block").css("display", "none");
            }


    
    });


</script>