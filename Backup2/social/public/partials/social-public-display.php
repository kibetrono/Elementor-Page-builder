<?php defined( 'ABSPATH' ) or die( );  ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php
$facebook=get_option('thefacebook');
$twitter=get_option('thetwitter');
$pinterest=get_option('thepinterest');
$linkedin=get_option('thelinkedin');
$email=get_option('theemail');
$whatsapp=get_option('thewhatsapp');
// post type
$typepost=get_option('swsketheposts');
$typepage=get_option('swskethepages');
$typelandingpages=get_option('thelandingpages');
$typetemplates=get_option('thetemplates');
// btn sizes
$swskebtnsize=get_option('thebuttonsize');
//  btn color
$color=get_option('thecolor');

// arrangement
$arrangement=get_option('the_arrangement_order');
// btn position
$below=get_option('thebelow');
$floating=get_option('thefloating');
$before=get_option('thebefore');
$after=get_option('theafter');
$inside=get_option('theinside');	

if($typepage){
    if(get_post_type() === 'page'){
        require_once 'social-display-page.php';
    }
}

if($typepost){
    if (get_post_type() === 'post'){
        require_once 'social-display-post.php';
    }
}

function add_content_after_title($content) {
    $face='<label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label>';
    $twit='<label id="swske-share"><a  href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label>';
    $link='<label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label>';
    $int='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label>';
    $mail='<label id="swske-share"><a href="https://mail.google.com/"><i  class="fa fa-envelope"> Share</i></a></label>';
    $what='<label id="swske-share" ><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label>';
    $arr = array($face,$twit,$link,$int,$mail,$what);
    $before_content=join(" ",$arr);
    $fullcontent = $before_content . $content ;
    return $fullcontent;	
}

function add_content_before($content) {
    $face='<label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label>';
    $twit='<label id="swske-share"><a  href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label>';
    $link='<label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label>';
    $int='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label>';
    $mail='<label id="swske-share"><a href="https://mail.google.com/"><i  class="fa fa-envelope"> Share</i></a></label>';
    $what='<label id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label>';
    $arr = array($face,$twit,$link,$int,$mail,$what);
    $before_content=join(" ",$arr);
    $fullcontent = $before_content . $content ;
    return $fullcontent;
}

function add_content_before2($content) {
    $face='<label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label>';
    $twit='<label id="swske-share"><a  href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label>';
    $link='<label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label>';
    $int='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label>';
    $mail='<label id="swske-share"><a href="https://mail.google.com/"><i  class="fa fa-envelope"> Share</i></a></label>';
    $what='<label id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label>';
    $arr = array($what,$mail,$int,$link,$twit,$face);
    $before_content=join(" ",$arr);
    $fullcontent = $before_content . $content ;
    return $fullcontent;
}

function add_content_after($content) {
    $face='<label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label>';
    $twit='<label id="swske-share"><a  href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label>';
    $link='<label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label>';
    $int='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label>';
    $mail='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-envelope"> Share</i></a></label>';
    $what='<label id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label>';
    $arr = array($face,$twit,$link,$int,$mail,$what);
    $after_content =join(" ",$arr);
    $fullcontent = $content . $after_content;
    return $fullcontent;
}

function add_content_after2($content) {
    $face='<label id="swske-share"><a href="https://www.facebook.com/login"><i  class="fa fa-facebook"> Share</i></a></label>';
    $twit='<label id="swske-share"><a  href="https://twitter.com/home"><i  class="fa fa-twitter"> Tweet</i></a></label>';
    $link='<label id="swske-share"> <a href="https://www.linkedin.com/"><i  class="fa fa-linkedin"> Share</i></a></label>';
    $int='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-pinterest"> Share</i></a></label>';
    $mail='<label id="swske-share"><a href="https://www.pinterest.com/login/"><i  class="fa fa-envelope"> Share</i></a></label>';
    $what='<label id="swske-share"><a href="https://www.whatsapp.com/"><i  class="fa fa-whatsapp"> Share</i></a></label>';
    $arr = array($what,$mail,$int,$link,$twit,$face);
    $after_content =join(" ",$arr);
    $fullcontent = $content . $after_content;
    return $fullcontent;
}
