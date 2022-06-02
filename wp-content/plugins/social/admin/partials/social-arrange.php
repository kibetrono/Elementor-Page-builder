<?php defined( 'ABSPATH' ) or die( );  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- start of new -->
<div class="swske-social-page">
    <h1>Softwareske Social Share</h1>
    <p>Use the shortcode [socialShareShortcode] to display the icons inside your content.</p>
    <div class="row">
        <div class="col-md-2">
            <h3>Main Social Networks:</h3>
        </div>

        <div class="col-md-10">
            <p id="icon-choice">You have successfully chosen your preffered social share icons. </p>
            <br>
            <form class="btn_color_form mt-2 " method="post" action="options.php">
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
                $selectedwhatsapp=get_option('thewhatsapp');
                $selectedtypepost=get_option('swsketheposts');
                $selectedtypepage=get_option('swskethepages');
                $selectedtypelandingpage=get_option('thelandingpages');
                $selectedtypetemplates=get_option('thetemplates');
                $selectedoption= get_option('thebuttonsize');
                $selectedcolor=get_option('thecolor');
                $selectedorder=get_option('the_arrangement_order');
                $selectedbefore=get_option('thebefore');
                $selectedafter=get_option('theafter');
                $selectedbelow=get_option('thebelow');
                $selectedfloat=get_option('thefloating');
                $selectedinside=get_option('theinside');
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
                        <input <?php if($selectedwhatsapp == 'whatsapp'){echo 'checked';}; ?> type="checkbox" id="whatsapp" name="thewhatsapp" value="whatsapp">
                        <label for="whatsapp"><span><i class="fa  fa-whatsapp"></i></span> Whatsapp</label>
                        <br>
                    </div>        
                </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
         <h3> Share Options:</h3>
        </div>
        <div class="col-md-10">
            <div class="mt-1"> 
                <br>
                <input <?php if($selectedtypepost == 'is_single()'){echo 'checked';}; ?> type="checkbox" name="swsketheposts" value="is_single()">
                <label> Posts</label>
                <br>
               
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
        </div>
    </div>
<!-- button size -->
    <div class="row">
        <div class="col-md-2">
            <h3> Button Sizes:</h3>
        </div>
        <div class="col-md-10">
            <div class="mt-1"> 
            <br>
            <select name="thebuttonsize"  id="exampleFormControlSelect1">
                <option <?php if($selectedoption == 'small'){echo 'selected';}; ?> >small</option>
                <option <?php if($selectedoption == 'medium'){echo 'selected';};?> >medium</option>
                <option <?php if($selectedoption == 'large'){echo 'selected';};?> >large</option>
            </select>
        </div>
    </div>
<!-- end of button size -->

<!-- button color -->
    <div class="row">
        <div class="col-md-2">
            <h3> Button Colors: </h3>
        </div>
        <div class="col-md-10">
            <br>
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
    </div>
<!-- end of button color -->

<!-- button order -->
    <div class="row">
        <div class="col-md-2">
             <h3> Button Order:</h3>
        </div>
        <div class="col-md-10">
            <br>
            

            <input type="hidden" name="theorderrevision" id="inputdroppeditems" value="FacebookTwitterLinkedinPinterestWhatsapp">
      
       <div style="display:none;height:10vh;border:1px solid black;padding:20px;width:20%"class="containear" id="droppeditems">

       </div>
            <div class="contain">
            <!-- <div style="height:5vh;background-color:black"  draggable="true" class="box"></div> -->

            <div draggable="true" data-title="Facebook" class="box"><span class="left-icon"><i class="fa fa-arrows"></i></span> <span class="media-icon"><i class="fa fa-facebook"></i></span><input type="hidden"  value="1"> Facebook</div>
            <div draggable="true" data-title="Twitter" class="box"><span class="left-icon"><i class="fa fa-arrows"></i></span> <span class="media-icon"><i class="fa fa-twitter"></i></span><input type="hidden" value="2"> Twitter</div>
            <div draggable="true" data-title="Linkedin" class="box"><span class="left-icon"><i class="fa fa-arrows"></i></span> <span class="media-icon"><i class="fa fa-linkedin"></i></span><input type="hidden" value="3"> Linkedin</div>
            <div draggable="true" data-title="Pinterest" class="box"><span class="left-icon"><i class="fa fa-arrows"></i></span> <span class="media-icon"><i class="fa fa-pinterest"></i></span><input type="hidden" value="4"> Pinterest</div>
            <div draggable="true" data-title="Whatsapp" class="box"><span class="left-icon"><i class="fa fa-arrows"></i></span> <span class="media-icon"><i class="fa fa-whatsapp"></i></span><input type="hidden" value="6"> Whatsapp</div>
          
        </div>
            

        </div>
    </div>
<!-- end of button order -->

<!-- display position -->
    <div class="row">
        <div class="col-md-2">
            <h3> Display Position:</h3>
        </div>
        <div class="col-md-10">
            <br>
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
            <div class="mt-1">
                <div class="col-md-2 mt-3">                       
                    <button id="savebtn"  class="btn btn-primary btn-sm">Save Options</button>      
                </div>
            </div>              
        </form>  

    </div>
   
    <!-- end of display position -->

</div>
<!-- end of new -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>
    $('.box').on('keydown change paste drop',function(event) {
    var _this = this;
    setTimeout(function() {
        console.log(_this.value, event.type);
    }, 0); //this timeout is necessary  to get the value
});
    $('#savebtn').on('click', function() {
        var c=$('.ColorPickerArea').val()
        $("#ColorPickerValue").val(c)
    });

    $('#allselectioncolor').on('click', function() {
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
    // start of social share icons
    const icon_form = document.querySelector('.btn_color_form');
    const icon_Message = document.querySelector('#icon-choice');
    icon_form.addEventListener('submit', (e) => {
    e.preventDefault();
    icon_Message.classList.add('show');
    setTimeout(() => icon_form.submit(), 1000);
});
// end of social share icons

// document.addEventListener('DOMContentLoaded', (event) => {
//     function 
// });
// start dragging
document.addEventListener('DOMContentLoaded', (event) => {

function handleDragStart(e) {
  this.style.opacity = '0.4';
  dragSrcEl = this;
  document.getElementById('droppeditems').innerHTML = "";

e.dataTransfer.effectAllowed = 'move';
e.dataTransfer.setData('text/html', this.innerHTML);
// console.log(dragSrcEl);
}

function handleDragEnd(e) {
  this.style.opacity = '1';

  items.forEach(function (item) {
    item.classList.remove('over');
  });
}

function handleDragOver(e) {
  e.preventDefault();
  return false;
}

function handleDragEnter(e) {
  this.classList.add('over');
  
}

function handleDragLeave(e) {
  this.classList.remove('over');
}
function handleDrop(e) {
  e.stopPropagation();

  if (dragSrcEl !== this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
    
  }

  return false;
}

function handleDrop2(e) {
  e.stopPropagation();
  if (dragSrcEl !== this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
    
  }

//   var els = document.getElementsByClassName("box");
// for(var i = 0; i < els.length; i++)
// {
//   console.log(els[i]);
// }

  var region=document.getElementById("droppeditems")
  var region2=document.getElementById("inputdroppeditems")
  
let items = document.querySelectorAll('.contain .box');
for(var i = 0; i < items.length; i++)
{
//   console.log(els[i]);
  var y=items[i].innerText;


  region.append(y)

//   region2.value="This is good"


}

var x =region.innerText
region2.value=x
// console.log("This is ",x);
// for(var i = 0; i < region.length; i++)
// {
//   var y=region[i].innerText;

//   region2.value=y
//   console.log("Morning");


// }



//   var y=items.innerText;

//   region.append(y + " ")
  
//   region.innerHTML = this.innerText;
//     this.innerHTML = e.dataTransfer.getData('text/html');
  

}


let items = document.querySelectorAll('.contain .box');
items.forEach(function(item) {
  item.addEventListener('dragstart', handleDragStart);
  item.addEventListener('dragover', handleDragOver);
  item.addEventListener('dragenter', handleDragEnter);
  item.addEventListener('dragleave', handleDragLeave);
  item.addEventListener('dragend', handleDragEnd);
  item.addEventListener('drop', handleDrop2);
});
});
// end dragging

</script>