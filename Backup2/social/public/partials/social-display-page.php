<?php

if($arrangement == 'From Facebook to Whatsapp'){
    if($facebook){?> <label class="face1" id="swske-share"><a href="https://www.facebook.com/login"><i id="ic"  class="fa fa-facebook"> Share</i></a></label><?php }
    if($twitter){?><label class="twit1"  id="swske-share"><a href="https://twitter.com/home"><i id="ic" class="fa fa-twitter"> Tweet</i></a></label><?php }
    if($linkedin){?><label class="link1"  id="swske-share"> <a href="https://www.linkedin.com/"><i id="ic" class="fa fa-linkedin"> Share</i></a></label><?php }
    if($pinterest){?><label class="int1"  id="swske-share"><a href="https://www.pinterest.com/login/"><i id="ic"  class="fa fa-pinterest"> Share</i></a></label><?php }
    if($email){?><label class="mail1"  id="swske-share"><a href="https://mail.google.com/"><i id="ic" class="fa fa-envelope"> Share</i></a></label><?php }
    if($whatsapp){ ?> <label class="what1"   id="swske-share"><a href="https://www.whatsapp.com/"><i id="ic"  class="fa fa-whatsapp"> Share</i></a></label><?php }
}

if($arrangement == 'From Whatsapp to Facebook'){
    if($whatsapp){ ?> <label class="what1"   id="swske-share"><a href="https://www.whatsapp.com/"><i id="ic"  class="fa fa-whatsapp"> Share</i></a></label><?php }
    if($email){?><label class="mail1"  id="swske-share"><a href="https://mail.google.com/"><i id="ic" class="fa fa-envelope"> Share</i></a></label><?php }
    if($pinterest){?><label class="int1"  id="swske-share"><a href="https://www.pinterest.com/login/"><i id="ic"  class="fa fa-pinterest"> Share</i></a></label><?php }
    if($linkedin){?><label class="link1"  id="swske-share"> <a href="https://www.linkedin.com/"><i id="ic" class="fa fa-linkedin"> Share</i></a></label><?php }
    if($twitter){?><label class="twit1"  id="swske-share"><a href="https://twitter.com/home"><i id="ic" class="fa fa-twitter"> Tweet</i></a></label><?php }
    if($facebook){?> <label class="face1" id="swske-share"><a href="https://www.facebook.com/login"><i id="ic"  class="fa fa-facebook"> Share</i></a></label><?php }
        }

?>

<?php

// small button
if($swskebtnsize == 'small'){?> <script src="wp-content/plugins/social/public/js/social-sm-btn-size.js"></script> <?php }

// medium button
if($swskebtnsize == 'medium'){?> <script src="wp-content/plugins/social/public/js/social-md-btn-size.js"></script> <?php }

// Large button
if($swskebtnsize == 'large'){?> <script src="wp-content/plugins/social/public/js/social-lg-btn-size.js"></script> <?php }


if($color == 'Default'){ ?> <script>
    const facebook = document.getElementsByClassName("face1");
    const twitter = document.getElementsByClassName("twit1");
    const linkedin = document.getElementsByClassName("link1");
    const pinterest = document.getElementsByClassName("int1");
    const email = document.getElementsByClassName("mail1");
    const whatsapp = document.getElementsByClassName("what1");

    var elem1=document.querySelectorAll('#ic');

    for (let i = 0; i < facebook.length; i++) { facebook[i].style.backgroundColor = "#1499F1";}
    
    for (let i = 0; i < elem1.length; i++) { elem1[i].style.color = "#ffffff"; }

    for (let i = 0; i < twitter.length; i++) { twitter[i].style.backgroundColor = "#40BBF4"; }

    for (let i = 0; i < linkedin.length; i++) { linkedin[i].style.backgroundColor = "#0073B1"; }

    for (let i = 0; i < pinterest.length; i++) { pinterest[i].style.backgroundColor = "#E84121"; }

    for (let i = 0; i < email.length; i++) { email[i].style.backgroundColor = "#2161EA"; }

    for (let i = 0; i < whatsapp.length; i++) { whatsapp[i].style.backgroundColor = "#5FC85B"; }
 
    </script> <?php
     }

if($color !== 'Default'){ ?> <script>
    var elem=document.querySelectorAll('#swske-share');
    var elem1=document.querySelectorAll('#ic');

    for (var i = 0; i < elem.length; i++) {
    var currentEl = elem[i];
    var php_var = "<?php echo $color; ?>";
    currentEl.style.backgroundColor = php_var;} 
    for (let i = 0; i < elem1.length; i++) { elem1[i].style.color = "#ffffff"; }

</script><?php
}	

if($below){
    add_filter('the_title', 'add_content_after_title');
    // add_filter('get_the_archive_title', 'add_content_after_title');
}

if($floating){
    ?><script>
        var elem = document.querySelectorAll('#swske-share');
        for (var i = 0; i < elem.length; i++) {
            var currentEl = elem[i];
            currentEl.classList.add('defes');
            // currentEl.style.cssText = 'border:1px solid black;padding:10px;display:block;margin-top:10px;position:relative;top:180px;left:50px;width:5%;height:100%;border-radius:100px';
        }
</script><?php
}

if($before){
    if($arrangement == 'From Facebook to Whatsapp'){add_filter('the_content', 'add_content_before');}
    if($arrangement == 'From Whatsapp to Facebook'){add_filter('the_content', 'add_content_before2');}
  }

if($after){
    if($arrangement == 'From Facebook to Whatsapp'){add_filter('the_content', 'add_content_after');}
    if($arrangement == 'From Whatsapp to Facebook'){add_filter('the_content', 'add_content_after2');}
}

if($inside){
    
//   add_filter('the_content', 'add_content_after');
//   add_filter('the_content', 'add_content_before');


}	