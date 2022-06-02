<?php

if($arrangement == 'From Facebook to Whatsapp'){
    if($facebook){?> <label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label><?php }
    if($twitter){?><label id="swske-share"><a href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label><?php }
    if($linkedin){?><label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label><?php }
    if($pinterest){?><label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label><?php }
    if($email){?><label id="swske-share"><a href="https://mail.google.com/"><i  class="fa fa-envelope"> Share</i></a></label><?php }
    if($whatsapp){ ?> <label  id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label><?php }
}

if($arrangement == 'From Whatsapp to Facebook'){
    if($whatsapp){ ?> <label id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label><?php }
    if($email){?><label id="swske-share"><a href="https://mail.google.com/"><i  class="fa fa-envelope"> Share</i></a></label><?php }
    if($pinterest){?><label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label><?php }
    if($linkedin){?><label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label><?php }
    if($twitter){?><label id="swske-share"><a href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label><?php }
    if($facebook){?> <label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label><?php }
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
    const collection = document.querySelectorAll("#swske-share");
    for (let i = 0; i < collection.length; i++) {
    collection[i].style.backgroundColor = "white";
    }</script> <?php }

if($color !== 'Default'){ ?> <script>
    var elem=document.querySelectorAll('#swske-share');
    for (var i = 0; i < elem.length; i++) {
    var currentEl = elem[i];
    var php_var = "<?php echo $color; ?>";
    currentEl.style.backgroundColor = php_var;
} </script><?php
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