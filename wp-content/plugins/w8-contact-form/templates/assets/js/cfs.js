/**********************************
* contact_form_slider.js
* title: Contact Form Slider
* description: Display a highly customizable Contact Form
* author: Pantherius
* website: http://pantherius.com
**********************************/ 


jQuery(document).ready(function() {
	"use strict";
	if ( cfs_params.bodyanim != "" && cfs_params.bodyanim != "disabled" && ! jQuery( 'body' ).cfslider( 'detectmob' ) ) {
		if ( cfs_params.bgtarget == "" ) {
			jQuery( 'body' ).wrapInner( '<div id="cfs_wrapper"><div id="cfs_wrapper_inside"></div></div>' );
		}
		else {
			jQuery( '' + cfs_params.bgtarget + '' ).wrapInner( '<div id="cfs_wrapper"><div id="cfs_wrapper_inside"></div></div>' );
		}
		jQuery( "#wpadminbar" ).appendTo( "body" );
		jQuery( "#cfs_wrapper_inside>.modal-survey-container" ).appendTo( "body" );
		if ( cfs_params.excludeelements != "" ) {
			var ee = cfs_params.excludeelements.split( "," );
			jQuery.each( ee,function( index, value ) {
				jQuery( value ).appendTo( "body" );
			});
		}
	}
	if ( jQuery( '#cfs-bglock' ).length == 0 ) {
		jQuery( "body" ).prepend( '<div id="cfs-bglock" onclick="jQuery(\'body\').cfslider(\'remove\')"> </div>' );
	}
});

jQuery( window ).on( "load", function() {
	"use strict";
	if ( typeof cfs_params !== 'undefined' ) {
		jQuery( 'body' ).cfslider();
	}
});

(function( jQuery ){
	"use strict";
	var defaults, space, bspace, opened_slider;
   var methods = {
    init : function(options) {
		defaults = { 
			"customfields":[],
			"customcontact":[],
			"hide_icon":"false",						//hide all icons, you can combine it with the auto open option - true or false
			"auto_open":"false",						//auto open the Like Box Slider at the bottom of the page - true or false
			"captcha":"image",							//set the captcha style - image, math, hidden field or disabled
			"sendcopy":"false",							//enable sending copy to the sender email address - true or false
			"disableimage":"false",						//hide the contact image - true or false
			"direction":"left",							//position of the Contact Slider - left or right
			"closeable":"true",							//display close icon in the corner
			"transparency":"90",						//transparency for the locked screen/transparent background in percentages
			"icon_size":"medium",						//icon size for the Like Box - small, medium or large
			"lock_screen":"true",						//set the screen locked with a transparent background when the slider opens
			"vertical_distance":"50",					//vertical position of the Like Box icon related to the top in percentages
			"dofsu":"false",							//display once for the same user - true or false
			"scheme":"light",							//light or dark
			"icon_url":"",								//absolute url of the icon for Like Box
			"skin":"default",
			"placeholder_name":"Enter your name",
			"placeholder_email":"Enter your email address",
			"placeholder_message":"Type your message...",
			"placeholder_captcha":"Enter the numbers",
			"placeholder_sendcopy":"Send a copy to my email address",
			"sendbutton_text":"SEND",
			"failed_text":"FAILED",
			"reverse_header":"false",
			"bordered_photo":"#d1d2d3",
			"photo_style":"false",
			"animationtype":"Bounce",
			"flat":"false",
			"bodyanim":"cfs_perspectiveright",
			"fontfamily":"",
			"pfontsize":"",
			"headerfontsize":"",
			"subheaderfontsize":"",
			"buttonfontsize":"",
			"fieldfontsize":"",
			"height":"full",
			"bgtarget":"",
			"pfontweight":"",
			"headerfontweight":"",
			"subheaderfontweight":"",
			"buttonfontweight":"",
			"fieldfontweight":"",
			"background":"",
			"button_background":"",
			"button_background_hover":""
	  };
	if ( typeof cfs_params !== 'undefined') options = cfs_params;
	var options = jQuery.extend({}, defaults, options);
if ( options.dom == 'true' && jQuery( 'body' ).cfslider( 'detectmob' ) == true ){
}
else {
var lastScrollTop = 0, opened = false, block_autoopen = false, fcs_enabled_on_this_page = '', customdatas = {}, customfieldsarray = new Array(), fieldname, thisdata, protocol, boxtype = '', parentbox = '', headcontent;
protocol = ('https:' == window.location.protocol ? 'https://' : 'http://');
if (options.skin=='default') {space = 8;bspace = 6;}
else {space = 4;bspace = 2;}
if (!jQuery("link[href='" + protocol + "netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css']").length) jQuery('head').append('<link rel="stylesheet" href="' + protocol + 'netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" type="text/css" />');

	function getString( number_value ) {
		return number_value.toString();
	}
	if ( ( jQuery( "body" ).html() != undefined ) ) {
		var contact_form_slider_box = '';
		var contact_form_slider_closeable = '';
		var fbroot = '';
		var fbicon1 = '';
		var fbicon2 = '';
		var fbicon3 = '';
		var fbcs_scheme_name = 'light';
		if ( options.scheme != undefined ) {
			if ( options.scheme == 'dark' ) {
				fbcs_scheme_name = options.scheme;
			}
			if ( options.scheme == 'light' || options.scheme == '' ) {
				fbcs_scheme_name = options.scheme;
			}
		}
		if ( options.hide_icon == 'true' ) {
			fbicon2 = '<span style="display:none" class="fbicon_left icon_' + options.icon_size + ' cfs-icon"></span>';
		}
		if ( options.direction == 'left' && options.hide_icon == 'false' ) {
			if ( options.icon_url == undefined || options.icon_url == '' ) {
				fbicon2 = '<span style="left:-70px;top:' + options.vertical_distance + '%" class="fbicon_left icon_' + options.icon_size + ' cfs-icon"></span>';
			}
			else {
				var imgSrc = options.icon_url;
				var _width, _height;
				jQuery( "<img/>" ).attr( "src", imgSrc + "?" + new Date().getTime() ).load( function() {
					_width = this.width; 
					_height = this.height;
				 });
				fbicon2 = '<span style="left:-' + ( _width + 50 ) + 'px;top:' + options.vertical_distance + '%" class="fbcs_left cfs-icon"><img src="' + options.icon_url + '" /></span>';
			}
		}
		if ( options.direction == 'right' && options.hide_icon == 'false' ) {
			if ( options.icon_url == undefined || options.icon_url == '' ) {
				fbicon2 = '<span style="right:-70px;top:' + options.vertical_distance + '%" class="fbicon_right icon_' + options.icon_size + ' cfs-icon"></span>';
			}
			else {
				var imgSrc = options.icon_url;
				var _width, _height;
				jQuery( "<img/>" ).attr( "src", imgSrc + "?" + new Date().getTime() ).load( function() {
					_width = this.width; 
					_height = this.height;
				 });
				fbicon2 = '<span style="right:-' + ( _width + 50 ) + 'px;top:' + options.vertical_distance + '%" class="fbcs_right cfs-icon"><img src="' + options.icon_url + '" /></span>';
			}
		}
		if ( options.closeable == 'true' ) {
			contact_form_slider_closeable = '<a class="close_contact_slider"></a>';
		}
		var socialicons = '';
		if ( options.facebook != '' ) {
			socialicons += '<a target="_blank" href="' + options.facebook + '"><i class="fa fa-facebook"></i></a>';
		}
		if ( options.googleplus != '' ) {
			socialicons += '<a target="_blank" href="' + options.googleplus + '"><i class="fa fa-google-plus"></i></a>';
		}
		if ( options.twitter != '' ) {
			socialicons += '<a target="_blank" href="' + options.twitter + '"><i class="fa fa-twitter"></i></a>';
		}
		if ( options.pinterest != '' ) {
			socialicons += '<a target="_blank" href="' + options.pinterest + '"><i class="fa fa-pinterest"></i></a>';
		}
		if ( options.linkedin != '' ) {
			socialicons += '<a target="_blank" href="' + options.linkedin + '"><i class="fa fa-linkedin"></i></a>';
		}
		if ( options.skype != '' ) {
			socialicons += '<a target="_blank" href="' + options.skype + '"><i class="fa fa-skype"></i></a>';
		}
		if ( options.tumblr != '' ) {
			socialicons += '<a target="_blank" href="' + options.tumblr + '"><i class="fa fa-tumblr"></i></a>';
		}
		if ( options.flickr != '' ) {
			socialicons += '<a target="_blank" href="' + options.flickr + '"><i class="fa fa-flickr"></i></a>';
		}
		if ( options.foursquare != '' ) {
			socialicons += '<a target="_blank" href="' + options.foursquare + '"><i class="fa fa-foursquare"></i></a>';
		}
		if ( options.youtube != '' ) {
			socialicons += '<a target="_blank" href="' + options.youtube + '"><i class="fa fa-youtube"></i></a>';
		}
		var defs = '';
		if ( options.customcontact != '' ) {
		var cimgs = [];
		var subjects = '<select class="form-field" id="contact-form-slider-subject">';
			jQuery.each( options.customcontact, function( index, value ) {
				subjects += '<option value="' + value.name + '">' + value.name + '</option>';
				cimgs.push( value.photo );
			});
			subjects += '</select>';
			preload( cimgs );
		}
function display_contact( selected, intime, outtime ) {
		jQuery( ".cform-contact" ).css({
			"-webkit-transform": "scale(0.5)",
			"-webkit-transition-duration": "" + outtime + "ms",
			"-webkit-transition-timing-function": "ease-out",
			"-moz-transform": "scale(0.5)",
			"-moz-transition-duration": "" + outtime + "ms",
			"-moz-transition-timing-function": "ease-out",
			"-ms-transform": "scale(0.5)",
			"-ms-transition-duration": "" + outtime + "ms",
			"-ms-transition-timing-function": "ease-out",
			"opacity":"0"
		});
			setTimeout( function(){
			jQuery.each( options.customcontact, function( index, value ) {
				if ( index == selected ) {
					jQuery(".cform-title .cfheader").html(value.title);
					jQuery(".cform-msg").html(value.text);
					jQuery(".cform-subtitle").html(value.subtitle);
					socialicons = '';
					if (value.facebook!=''&&value.facebook!=undefined) socialicons += '<a target="_blank" href="'+value.facebook+'"><i class="fa fa-facebook"></i></a>';
					if (value.googleplus!=''&&value.googleplus!=undefined) socialicons += '<a target="_blank" href="'+value.googleplus+'"><i class="fa fa-google-plus"></i></a>';
					if (value.twitter!=''&&value.twitter!=undefined) socialicons += '<a target="_blank" href="'+value.twitter+'"><i class="fa fa-twitter"></i></a>';
					if (value.pinterest!=''&&value.pinterest!=undefined) socialicons += '<a target="_blank" href="'+value.pinterest+'"><i class="fa fa-pinterest"></i></a>';
					if (value.linkedin!=''&&value.linkedin!=undefined) socialicons += '<a target="_blank" href="'+value.linkedin+'"><i class="fa fa-linkedin"></i></a>';
					if (value.skype!=''&&value.skype!=undefined) socialicons += '<a target="_blank" href="skype:'+value.skype+'"><i class="fa fa-skype"></i></a>';
					if (value.tumblr!=''&&value.tumblr!=undefined) socialicons += '<a target="_blank" href="'+value.tumblr+'"><i class="fa fa-tumblr"></i></a>';
					if (value.flickr!=''&&value.flickr!=undefined) socialicons += '<a target="_blank" href="'+value.flickr+'"><i class="fa fa-flickr"></i></a>';
					if (value.foursquare!=''&&value.foursquare!=undefined) socialicons += '<a target="_blank" href="'+value.foursquare+'"><i class="fa fa-foursquare"></i></a>';
					if (value.youtube!=''&&value.youtube!=undefined) socialicons += '<a target="_blank" href="'+value.youtube+'"><i class="fa fa-youtube"></i></a>';
					if ( socialicons != "" ) {
						jQuery( ".cfslider-social-icons" ).html( socialicons );
					}
					else {
						jQuery( ".cfslider-social-icons" ).css( "display", "none" );
					}
					if ( value.photo != "" ) {
						jQuery( ".cform-photo" ).html( '<img src="' + value.photo + '">' );
						jQuery( ".cform-photo" ).css( "width", "40%" );
					}
					else {
						jQuery( ".cform-photo" ).html( '' );
						jQuery( ".cform-photo" ).css( "width", "0px" );						
					}
				}
				subjects += '<option value="' + value.name + '">' + value.name + '</option>';
				jQuery(".cform-contact").css({
			"-webkit-transform": "scale(1)",
			"-webkit-transition-duration": ""+intime+"ms",
			"-webkit-transition-timing-function": "ease-out",
			"-moz-transform": "scale(1)",
			"-moz-transition-duration": ""+intime+"ms",
			"-moz-transition-timing-function": "ease-out",
			"-ms-transform": "scale(1)",
			"-ms-transition-duration": ""+intime+"ms",
			"-ms-transition-timing-function": "ease-out",
			"opacity":"1"
			});
		})
		if ( options.bordered_photo != "false" ) {
			jQuery( ".cform-photo img" ).css( "border", "1px solid " + options.bordered_photo );
		}
		if ( options.photo_style == "door" ) {
			jQuery( ".cform-photo img" ).css({
				"border-top-left-radius": "100%",
				"border-top-right-radius": "100%"
			});
		}
		if ( options.photo_style == "badge" ) {
			jQuery( ".cform-photo img" ).css({
				"border-bottom-left-radius": "100%",
				"border-bottom-right-radius": "100%"
			});
		}
		if ( options.photo_style == "leaf-right" ) {
			jQuery( ".cform-photo img" ).css({
				"border-bottom-left-radius": "100%",
				"border-bottom-right-radius": "100%",
				"border-top-left-radius": "100%"
			});
		}
		if ( options.photo_style == "leaf-left" ) {
			jQuery( ".cform-photo img" ).css({
				"border-bottom-left-radius": "100%",
				"border-bottom-right-radius": "100%",
				"border-top-right-radius": "100%"
			});
		}
		if ( options.photo_style == "bubble-right" ) {
			jQuery( ".cform-photo img" ).css({
				"border-top-left-radius": "100%",
				"border-top-right-radius": "100%",
				"border-bottom-left-radius": "100%"
			});
		}
		if ( options.photo_style == "bubble-left" ) {
			jQuery( ".cform-photo img" ).css({
				"border-top-left-radius": "100%",
				"border-top-right-radius": "100%",
				"border-bottom-right-radius": "100%"
			});
		}
		if ( options.photo_style == "rounded-left" ) {
			jQuery( ".cform-photo img" ).css({
				"border-top-left-radius": "100%",
				"border-bottom-left-radius": "100%"
			});
		}
		if ( options.photo_style == "rounded-right" ) {
			jQuery( ".cform-photo img" ).css({
				"border-top-right-radius": "100%",
				"border-bottom-right-radius": "100%"
			});
		}
		if ( options.photo_style == "rounded") {
			jQuery( ".cform-photo img" ).css({
				"border-radius": "100%"
			});
		}
			}, outtime);
}
		function preload(arrayOfImages) {
			jQuery(arrayOfImages).each(function(){
				jQuery('<img/>')[0].src = this;
			});
		}
		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test(emailAddress);
		};
		
		function display_custom_field( field ) {
			if ( field.type == "text" ) {
				return ( '<div><label for="cfs-customfields-' + field.id + '" class="cfs-inputlabel"><input type="text" autocomplete="off" name="' + field.id + '" id="cfs-customfields-' + field.id + '" class="cfs-customfield form-field ' + field.id + '" placeholder="' + field.name + '"></label></div>' );
			}
			if ( field.type == "radio" ) {
				var returninput = "";
				jQuery.each( field.name.split( "," ), function( rindex, rvalue ) {
						var subelement = rvalue.split( ":" );
						if ( subelement[ 1 ] == undefined ) subelement[ 1 ] = "";
						returninput += '<input type="radio" id="cfs-customfields-' + field.id + rindex + '" value="' + subelement[ 1 ] + '" name="' + field.id + '" class="cfs-customfield form-field"><label for="cfs-customfields-' + field.id + rindex + '">' + subelement[ 0 ] + '</label>';
					});
				return ( '<div class="' + field.id + '">' + returninput + '</div>');
			}
			if ( field.type == "checkbox" ) {
				return ( '<div class="left_indent ' + field.id + '"><input type="checkbox" name="' + field.id + '" id="cfs-customfields-' + field.id + '" class="cfs-customfield form-field"><label for="cfs-customfields-' + field.id + '">' + field.name + '</label></div>' );
			}
			if ( field.type == "textarea" ) {
				return ( '<div><label for="cfs-customfields-' + field.id + '" class="cfs-inputlabel"><textarea placeholder="' + field.name + '" id="cfs-customfields-' + field.id + '" class="cfs-customfield form-field ' + field.id + '"></textarea></label></div>' );
			}
			if ( field.type == "select" ) {
				var returninput = "";
				jQuery.each( field.name.split( "," ), function( rindex, rvalue ) {
						var subelement = rvalue.split( ":" );
						if ( subelement[ 1 ] == undefined ) subelement[ 1 ] = "";
						returninput += '<option value="' + subelement[ 1 ] + '">' + subelement[ 0 ] + '</option>';
					});
				return ( '<div><select name="' + field.id + '" id="cfs-customfields-' + field.id + '" class="cfs-customfield form-field ' + field.id + '">' + returninput + '</select></div>' );
			}
			if ( field.type == "hidden" ) {
				return ( '<input type="hidden" name="' + field.id + '" id="cfs-customfields-' + field.id + '" class="cfs-customfield form-field ' + field.id + '" value="' + field.name + '">' );
			}
		}
		
		function beat_item( element ) {
			jQuery( element ).css({
						"-webkit-transform": "scale(0.9)",
						"-webkit-transition-duration": "300ms",
						"-webkit-transition-timing-function": "ease-out",
						"-moz-transform": "scale(0.9)",
						"-moz-transition-duration": "300ms",
						"-moz-transition-timing-function": "ease-out",
						"-ms-transform": "scale(0.9)",
						"-ms-transition-duration": "300ms",
						"-ms-transition-timing-function": "ease-out"
						});
			setTimeout( function() {
				jQuery( element ).css({
					"-webkit-transform": "scale(1)",
					"-webkit-transition-duration": "200ms",
					"-webkit-transition-timing-function": "ease-out",
					"-moz-transform": "scale(1)",
					"-moz-transition-duration": "200ms",
					"-moz-transition-timing-function": "ease-out",
					"-ms-transform": "scale(1)",
					"-ms-transition-duration": "200ms",
					"-ms-transition-timing-function": "ease-out"
				});
				jQuery( element ).css({
					"-webkit-transform": "",
					"-webkit-transition-duration": "",
					"-webkit-transition-timing-function": "",
					"-moz-transform": "",
					"-moz-transition-duration": "",
					"-moz-transition-timing-function": "",
					"-ms-transform": "",
					"-ms-transition-duration": "",
					"-ms-transition-timing-function": ""
				});
			}, 300 );
		}
		jQuery( document ).on( "change", "#contact-form-slider-subject", function() {
			var selected = jQuery( this )[ 0 ].selectedIndex;
			display_contact( selected, 500, 300 );
		});
		var photoblock = '', captcha_class = "";
		if ( options.captcha == "hidden" || options.captcha == "disabled" ) {
			captcha_class = "nocaptcha";
		}
		if ( options.disableimage != "true" ) {
			photoblock = '<div class="cform-photo"></div>';
		}
		if ( options.reverse_header == "false" ) {
			headcontent = photoblock + '<div class="cform-title"><div class="cfheader"></div><p class="cform-subtitle"></p><div class="cfslider-social-icons"></div></div>';
		}
		else {
			headcontent = '<div class="cform-title"><div class="cfheader"></div><p class="cform-subtitle"></p><div class="cfslider-social-icons"></div></div>' + photoblock;
		}
		var sendcopy = '';
		if ( options.sendcopy == "true" ) {
			sendcopy = '<div class="cfslider-sendcopy-block"><label for="cfslider-form-sendcopy">' + options.placeholder_sendcopy + '</label><input type="checkbox" checked id="cfslider-form-sendcopy" value="1"></div>';
		}
		var captcha_block = '';
		if ( options.captcha == "image" ) {
			captcha_block = '<img id="cfs-form-captcha-image" src="' + cfs_params.plugin_directory + '/captcha.php"><input type="text" id="cfs-form-captcha" class="wcf-image-captcha" value="" placeholder="' + options.placeholder_captcha + '">';
		}
		if ( options.captcha == "math" ) {
			captcha_block = '<br><div class="cfs-math-captcha"><div class="math-number1">' + Math.floor( ( Math.random() * 10 ) + 1 ) + '</div> + <div class="math-number2">' + Math.floor( ( Math.random() * 10 ) + 1 ) + '</div> = </div><input type="text" id="cfs-form-captcha" class="wcf-math-captcha" value="">';
		}
		if ( options.captcha == "hidden" ) {
			captcha_block = '<input type="hidden" id="cfs-form-captcha" value="">';
		}
		contact_form_slider_box = '<div class="cfs_hdline contact-form-slider-box"><div class="cfs_hdline_inside cfs_hdline_' + options.skin + '_' + fbcs_scheme_name + ' cfs_hdline_top"><div class="cfs_hdline_line">' + contact_form_slider_closeable + '</div><div class="cfsbox" class="' + options.direction + '_side_fbbox"><div class="cform-contact"><div class="cform-head cform-' + options.direction + ' ' + fbcs_scheme_name + '">' + headcontent + '</div><div class="cform-msg message_' + fbcs_scheme_name + '"></div></div><div class="cfslider-form">'
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
				  if ( this.priority == 1 ) {
					  contact_form_slider_box += display_custom_field( this );
				  }
				})
			});
		}
			contact_form_slider_box += subjects;
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
				  if ( this.priority == 2 ) {
					  contact_form_slider_box += display_custom_field( this );
				  }
				})
			});
		}
			contact_form_slider_box += '<label for="cfs-name" class="cfs-inputlabel"><input type="text" id="cfs-name" name="name" class="cfslider-form-name form-field" autocomplete="off" placeholder="'+options.placeholder_name+'"></label>';
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
				  if ( this.priority == 3 ) {
					  contact_form_slider_box += display_custom_field( this );
				  }
				})
			});
		}
			contact_form_slider_box += '<label for="cfs-email" class="cfs-inputlabel"><input type="text" id="cfs-email" name="email" class="cfslider-form-email form-field" autocomplete="off" placeholder="'+options.placeholder_email+'"></label>';
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
				  if ( this.priority == 4 ) {
					  contact_form_slider_box += display_custom_field( this );
				  }
				})
			});
		}
			contact_form_slider_box += '<label for="cfs-message" class="cfs-inputlabel"><textarea placeholder="'+options.placeholder_message+'" class="cfslider-form-message form-field"></textarea></label>';
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
				  if ( this.priority > 4 || jQuery.isNumeric( this.priority ) == false ) {
					  contact_form_slider_box += display_custom_field( this );
				  }
				})
			});
		}
		
		contact_form_slider_box += '<div class="bottom-form-section ' + captcha_class + '">'+captcha_block+'<a href="" class="submit-button">'+options.sendbutton_text+'</a>'+sendcopy+'</div><div class="cfs-clear"></div></div></div></div>'+fbicon2+'</div>';
		if ( jQuery( ".contact-form-slider-box" ).length != 1 ) {
			if ( options.flat == "false" ) {
				jQuery( 'body' ).prepend( contact_form_slider_box );
			}
			else {
				jQuery( "#cfs-container" ).html( contact_form_slider_box );
			}
			if ( parseInt( options.shake ) > 0 ) {
				jQuery( ".contact-form-slider-box .cfs-icon" ).addClass( "shake" ).on( "animationend", function(){
				  jQuery( this ).removeClass( "shake" );
				});
				setInterval( function() {
					if ( opened == false ) {
						jQuery( ".contact-form-slider-box .cfs-icon" ).addClass( "shake" );
					}
				}, parseInt( options.shake ) );
			}
			if ( options.shake == 'heartbeat' ) {
				jQuery( ".contact-form-slider-box .cfs-icon" ).addClass( "heartbeat" );
			}
			if ( jQuery( 'body' ).cfslider( 'detectmob' ) == true ) {
				jQuery( ".cfs_hdline" ).css( "width", "80%" );
			}
			jQuery( ".contact-form-slider-box" ).addClass( "easing-" + options.animationtype.toLowerCase() );
			var inputItem = jQuery( ".cfs-inputlabel" );
			inputItem.length && inputItem.each(function() {
				var thiselem = jQuery( this ),
					input = thiselem.find( ".form-field" ),
					placeholderTxt = input.attr( "placeholder" ),
					placeholder;
				
				input.after( '<span class="placeholder ' + input.attr( "class" ).replace( "form-field", "" ).replace( " ", "" ) + '-placeholder">' + placeholderTxt + "</span>" ),
				input.attr( "placeholder", "" ),
				placeholder = thiselem.find( ".placeholder" ),
				
				input.val().length ? thiselem.addClass( "active" ) : thiselem.removeClass( "active" ),
					
				input.on("focusout", function() {
					input.val().length ? thiselem.addClass( "active" ) : thiselem.removeClass( "active" );
				}).on("focus", function() {
					thiselem.addClass( "active" );
				});
			});
			jQuery( ".cfs-inputlabel .placeholder" ).css( "backgroundColor", jQuery( "#cfs-name" ).css( "backgroundColor" ) );
			if ( options.icon_url == undefined || options.icon_url == '' ) {
				if ( options.icon_image != "" ) {
					if ( options.direction == 'left' && options.hide_icon == 'false' ) {
						jQuery( ".cfs_hdline .cfs-icon" ).css( "backgroundImage", "url(" + options.plugin_directory + "/templates/assets/img/icon" + options.icon_image + "-left.png)" );
					}
					if ( options.direction == 'right' && options.hide_icon == 'false' ) {
						jQuery( ".cfs_hdline .cfs-icon" ).css( "backgroundImage", "url(" + options.plugin_directory + "/templates/assets/img/icon" + options.icon_image + "-right.png)" );
					}
				}
			}
			if ( jQuery( '#contact-form-slider-subject' ).length > 0 ) {
				if ( jQuery( "#contact-form-slider-subject option:selected" ).text() == "" ) {
					jQuery( "#contact-form-slider-subject" ).css( "display", "none" );
				}
			}
			if ( captcha_block != '' ) {
				jQuery( ".bottom-form-section" ).css( "text-align", "right" );
			}
			var _width, _height;
			if ( jQuery( '.cfs_hdline span img' ).length > 0 ) {
				jQuery( "<img/>" ).attr( "src", jQuery( '.cfs_hdline span img' ).attr( "src" ) + "?" + new Date().getTime() ).load( function() {
					_width = this.width; 
					_height = this.height;
					jQuery( '.cfs_hdline .cfs-icon' ).css( "width", _width + "px" );
				 });
			 }
			jQuery( '.cfs_hdline .cfs-icon' ).css( "margin-top", "-" + jQuery( '.cfs_hdline .cfs-icon' ).height() / 2 + "px" );
			if ( options.fontfamily != "" ) {
				if ( ! jQuery( "link[href='" + protocol + "fonts.googleapis.com/css?family=" + options.fontfamily + "']").length ) {
					jQuery( 'head' ).append( '<link rel="stylesheet" href="' + protocol + 'fonts.googleapis.com/css?family=' + options.fontfamily + ':400,700" type="text/css" />');
				}
				jQuery( ".cfs_hdline, .cfs_hdline input, .cfs_hdline textarea, .cfs_hdline select, .cfs_hdline a" ).css( "fontFamily", options.fontfamily );
			}
			if ( options.pfontsize != "" ) {
				jQuery( ".cform-msg, .cfslider-form-sendcopy" ).css( "fontSize", options.pfontsize );
			}
			if ( options.headerfontsize != "" ) {
				jQuery( ".cform-head .cfheader" ).css( "fontSize", options.headerfontsize );
			}
			if ( options.subheaderfontsize != "" ) {
				jQuery( ".cform-head p" ).css( "fontSize", options.subheaderfontsize );
			}
			if ( options.buttonfontsize != "" ) {
				jQuery( ".cfslider-form .submit-button" ).css( "fontSize", options.buttonfontsize );
			}
			if ( options.fieldfontsize != "" ) {
				jQuery( ".cfslider-form .form-field, #cfs-form-captcha" ).css( "fontSize", options.fieldfontsize );
			}
			if ( options.pfontweight != "" ) {
				jQuery( ".cform-msg, .cfslider-form-sendcopy" ).css( "fontWeight", options.pfontweight );
			}
			if ( options.headerfontweight != "" ) {
				jQuery( ".cform-head .cfheader" ).css( "fontWeight", options.headerfontweight );
			}
			if ( options.subheaderfontweight != "" ) {
				jQuery( ".cform-head p" ).css( "fontWeight", options.subheaderfontweight );
			}
			if ( options.buttonfontweight != "" ) {
				jQuery( ".cfslider-form .submit-button" ).css( "fontWeight", options.buttonfontweight );
			}
			if ( options.fieldfontweight != "" ) {
				jQuery( ".cfslider-form .form-field, #cfs-form-captcha" ).css( "fontWeight", options.fieldfontweight );
			}
			if ( options.background != "" && options.background != "off" ) {
				jQuery( ".cfs_hdline_inside" ).css( "backgroundColor", options.background );
			}
			if ( options.defaultcolor != "" && options.defaultcolor != "off" ) {
				jQuery( ".cform-msg, .cform-head .cfheader, .cform-head p" ).css( "color", options.defaultcolor );
			}
			if ( options.buttoncolor != "" && options.buttoncolor != "off" ) {
				jQuery( ".cfslider-form .submit-button" ).css( "color", options.buttoncolor );
			}
			if ( options.button_background != "" && options.button_background != "off" ) {
				jQuery( ".cfslider-form .submit-button" ).css( "background", options.button_background );
			}
			if ( options.button_background_hover != "" && options.button_background_hover != "off" ) {
				jQuery( ".cfslider-form .submit-button" ).on( "mouseenter", function() {
					jQuery( this ).css( "background", options.button_background )
				});
				jQuery( ".cfslider-form .submit-button" ).on( "mouseleave", function() {
					jQuery( this ).css( "background", options.button_background_hover )
				});
			}
		}
		if ( ( options.captcha == "disabled" ) || ( options.captcha == "hidden" ) ) {
			jQuery( ".cfslider-form .submit-button" ).css({
				"marginLeft": "0px",
				"width": "100%"
				});
		}
		else {
			jQuery( ".cfslider-form .submit-button" ).css({
				"width": "70px"
			});
		}
		if ( options.disableimage == "true" ) {
			jQuery( ".cform-title" ).css({
				"width": "80%",
				"margin": "0 auto"
			});
			jQuery( ".cform-head" ).css( "margin", "0px" );
		}
		if ( options.direction == 'left' ) {
			jQuery( '.contact-form-slider-box' ).css( "left", '-' + ( parseInt( jQuery( ".contact-form-slider-box" ).width() ) + space ) + 'px' );
			jQuery( ".contact-form-slider-box .cfs-icon" ).css({
				"left": ( jQuery( ".contact-form-slider-box" ).width() + bspace ) + 'px'
			});
		}
		if ( options.direction == 'right' ) {
			jQuery( '.contact-form-slider-box' ).css( "right", '-' + ( jQuery( ".contact-form-slider-box" ).width() ) + 'px' );
			jQuery( ".contact-form-slider-box .cfs-icon" ).css({
				"right": ( jQuery( ".contact-form-slider-box" ).width() ) + 'px'
			});
		}
		setTimeout( function() {
			jQuery(".contact-form-slider-box").addClass( "cfsb-amin" );
		}, 1000 );
		display_contact( 0, 0, 0 );
		function check_custom_field( priority ) {
			var cfret = false;
		if ( options.customfields != "" ) {
			jQuery.each( options.customfields, function( index ) {
				jQuery.each( this, function( index2 ) {
					if ( this.priority == priority || ( priority == 0 && jQuery.isNumeric( this.priority ) == false ) ) {
						if ( this.required == 'true' && ( this.type == 'text' || this.type == 'textarea' ) ) {
							if ( jQuery( "." + this.id ).val() != "" && jQuery( "." + this.id ).val().length >= this.minlength ) {
								jQuery( "." + this.id ).css( "border", "1px solid #B4EEEC" );
							}
							else {
								jQuery( "." + this.id ).css( "border", "1px solid rgb(160, 10, 10)" );
								beat_item( ".cfslider-form ." + this.id );
								jQuery( "." + this.id ).focus();
								cfret = true;
							}
						}
						if ( this.required == 'true' && ( this.type == 'select' ) ) {
						if ( jQuery( "." + this.id + " option:selected" ).val() != "" ) {
								jQuery( "." + this.id ).css( "border", "1px solid #B4EEEC" );
							}
							else {
								jQuery( "." + this.id ).css( "border", "1px solid rgb(160, 10, 10)" );
								beat_item( ".cfslider-form ." + this.id );
								jQuery( "." + this.id ).focus();
								cfret = true;
							}
						}
						if ( this.required == 'true' && ( this.type == 'radio' ) ) {
							if ( jQuery( ".cfslider-form input[name=" + this.id + "]:checked" ).val() != undefined ) {
								jQuery( "." + this.id ).css( "border", "none" );
							}
							else {
								jQuery( "." + this.id ).css( "border", "none" );
								beat_item( ".cfslider-form ." + this.id );
								jQuery( "." + this.id ).css( "border", "none" );
								jQuery( "." + this.id ).focus();
								cfret = true;
							}
						}
						if ( this.required == 'true' && ( this.type == 'checkbox' ) ) {
							if ( jQuery( "." + this.id + ">input[type=checkbox]:checked" ).prop( 'checked' ) == true ) {
								jQuery( "." + this.id ).css( "border", "none" );
							}
							else {
								jQuery( "." + this.id ).css( "border", "none" );
								beat_item( ".cfslider-form ." + this.id );
								jQuery( "." + this.id ).css( "border", "none" );
								jQuery( "." + this.id ).focus();
								cfret = true;
							}
						}
					}
				})
			});
		}			
			return cfret;
		}
		
	jQuery(".submit-button").on( "click", function(event){
        event.preventDefault();
		if ( check_custom_field( 1 ) == true ) {
				return true;
		}
		if ( check_custom_field( 2 ) == true ) {
				return true;
		}
		if ( jQuery( ".cfslider-form-name" ).val() != "" && jQuery( ".cfslider-form-name" ).val().length >= 2 ) {
			jQuery( ".cfslider-form-name" ).css( "border", "1px solid #B4EEEC" );
		}
		else {
			jQuery( ".cfslider-form-name" ).css( "border", "1px solid rgb(160, 10, 10)" );
			beat_item( ".cfslider-form-name" );
			jQuery( ".cfslider-form-name" ).focus();
			return true;
		}
		if ( check_custom_field( 3 ) == true ) {
				return true;
		}
		if ( jQuery( ".cfslider-form-email" ).val() != "" && jQuery( ".cfslider-form-email" ).val().length >3 && ( isValidEmailAddress( jQuery( ".cfslider-form-email" ).val() ) ) ) {
			jQuery( ".cfslider-form-email" ).css( "border", "1px solid #B4EEEC" );
		}
		else {
			jQuery( ".cfslider-form-email" ).css( "border", "1px solid rgb(160, 10, 10)" );
			beat_item( ".cfslider-form-email" );
			jQuery( ".cfslider-form-email" ).focus();
			return true;
		}
		if ( check_custom_field( 4 ) == true ) {
				return true;
		}
		if ( jQuery( ".cfslider-form-message" ).val() != "" && jQuery( ".cfslider-form-message" ).val().length > 5 ) {
			jQuery( ".cfslider-form-message" ).css( "border", "1px solid #B4EEEC" );
		}
		else {
			jQuery( ".cfslider-form-message" ).css( "border", "1px solid rgb(160, 10, 10)" );
			beat_item( ".cfslider-form-message" );
			jQuery( ".cfslider-form-message" ).focus();
			return true;
		}
		if ( check_custom_field( 0 ) == true ) {
				return true;
		}
		var captcha_f = '';
		if ( options.captcha == "image" ) {
			captcha_f = jQuery( "#cfs-form-captcha" ).val();
		}
		if ( options.captcha == "hidden" ) {
			if ( jQuery( "#cfs-form-captcha" ).val().length > 0 ) {
				return true;
			}
		}
		if ( options.captcha == "math" ) {
			if ( jQuery( "#cfs-form-captcha" ).val() != parseInt( jQuery( ".math-number1" ).text() ) + parseInt( jQuery( ".math-number2" ).text() ) ) {
				jQuery( "#cfs-form-captcha" ).css( "border", "1px solid rgb(160, 10, 10)" );
				beat_item( "#cfs-form-captcha" );
				jQuery( "#cfs-form-captcha" ).focus(); 
				return true;
			}
			else {
				jQuery( "#cfs-form-captcha" ).css( "border", "1px solid #B4EEEC" );
			}
		}
		var sendc = '';
		if ( options.sendcopy == "true" && jQuery( "#cfslider-form-sendcopy" ).is( ':checked' ) ) {
			sendc = "true";
		}
		if ( jQuery( "#contact-form-slider-subject" ).find( ":selected" ).text() == "" ) {
			var subj = "Contact";
		}
		else {
			var subj = jQuery( "#contact-form-slider-subject" ).find( ":selected" ).text();
		}
		var data = {
			action: 'ajax_cfs',
			cfscmd: 'sendmail',
			remail: jQuery("#contact-form-slider-subject").find(":selected").val(),
			semail: jQuery(".cfslider-form-email").val(),
			name: jQuery(".cfslider-form-name").val(),
			subject: subj,
			message: jQuery(".cfslider-form-message").val(),
			captcha: captcha_f,
			cmode: options.captcha,
			sendc: sendc
		};

		if ( options.customfields != '' ) {
			customfieldsarray = [];
			thisdata = {};
			jQuery.each( options.customfields, function( index, value ) {
				jQuery.each( value, function( ind, val ) {
					fieldname = val.id;
					if ( val.type == undefined ) val.type = "text";
					if ( val.type == "radio" || val.type == "select" ) {
						val.minlength = 0;
					}
					if ( val.type == "select" ) {
						thisdata[ fieldname ] = jQuery( "." + val.id + " option:selected" ).val();
					}
					else if ( val.type == "radio" ) {
						thisdata[ fieldname ] = jQuery( "." + val.id + " input[type=radio]:checked:first" ).val();
					}
					else if ( val.type == "checkbox" ) {
						thisdata[ fieldname ] = jQuery( "." + val.id + ">input[type=checkbox]:checked" ).prop( 'checked' );
					}
					else {
						thisdata[ fieldname ] = jQuery( "." + val.id ).val();
					}
					if ( thisdata[ fieldname ] == "undefined" ) {
						thisdata[ fieldname ] = "empty";
					}
					customfieldsarray.push( val.id );
				});
			});
					customdatas = jQuery.extend( {}, customdatas, thisdata); 
		}
		customdatas[ 'customfieldsarray' ] = customfieldsarray;
		data = jQuery.extend( {}, data, customdatas );
		jQuery(".cfslider-form .submit-button").html('<img src="'+options.plugin_directory+'/templates/assets/img/ajax-loader.gif">');
		jQuery.post( options.path, data, function( response ) {
			if ( response == "captcha" ) {
				jQuery( "#cfs-form-captcha" ).css( "border", "1px solid rgb(160, 10, 10)" );
				beat_item( "#cfs-form-captcha" );
				jQuery( "#cfs-form-captcha" ).focus(); 
				var d = new Date();
				jQuery( "#cfs-form-captcha-image" ).attr( "src", cfs_params.plugin_directory + "/captcha.php?" + d.getTime() );
				jQuery( ".cfslider-form .submit-button" ).text( options.sendbutton_text );
				return true;
			}
			else if ( response == "success" ) {
				jQuery( ".cfs_hdline_inside" ).append( "<div class='cfs-response-message'><span class='cfs-endmessage'>" + options.success_message + "</span></div>" );
				if ( options.headerfontsize != "" ) {
					jQuery( ".cfs-response-message" ).css( "fontSize", options.pfontsize );
				}
				if ( options.flat == "true" ) {
					jQuery( ".cfs-response-message" ).css( "padding-top", ( jQuery( "#cfs-container" ).height() / 2 ) - 11 + "px" );
				}
				jQuery( ".cfsbox" ).css({
					"-webkit-transform": "scale(0.5)",
					"-webkit-transition-duration": "300ms",
					"-webkit-transition-timing-function": "ease-out",
					"-moz-transform": "scale(0.5)",
					"-moz-transition-duration": "300ms",
					"-moz-transition-timing-function": "ease-out",
					"-ms-transform": "scale(0.5)",
					"-ms-transition-duration": "300ms",
					"-ms-transition-timing-function": "ease-out",
					"opacity":"0"
					});
				setTimeout( function() {
					jQuery( ".cfs-response-message" ).css({
					"-webkit-transform": "scale(1)",
					"-webkit-transition-duration": "300ms",
					"-webkit-transition-timing-function": "ease-out",
					"-moz-transform": "scale(1)",
					"-moz-transition-duration": "300ms",
					"-moz-transition-timing-function": "ease-out",
					"-ms-transform": "scale(1)",
					"-ms-transition-duration": "300ms",
					"-ms-transition-timing-function": "ease-out",
					"opacity":"1"
					});
				}, 300 );
				setTimeout( function() {
					jQuery(".cfs-response-message").css({
					"-webkit-transform": "scale(0.5)",
					"-webkit-transition-duration": "50ms",
					"-webkit-transition-timing-function": "ease-out",
					"-moz-transform": "scale(0.5)",
					"-moz-transition-duration": "50ms",
					"-moz-transition-timing-function": "ease-out",
					"-ms-transform": "scale(0.5)",
					"-ms-transition-duration": "50ms",
					"-ms-transition-timing-function": "ease-out",
					"opacity":"0"
					});
				}, 3000 );
				setTimeout( function() {
					jQuery( ".cfsbox" ).css({
					"-webkit-transform": "scale(1)",
					"-webkit-transition-duration": "300ms",
					"-webkit-transition-timing-function": "ease-out",
					"-moz-transform": "scale(1)",
					"-moz-transition-duration": "300ms",
					"-moz-transition-timing-function": "ease-out",
					"-ms-transform": "scale(1)",
					"-ms-transition-duration": "300ms",
					"-ms-transition-timing-function": "ease-out",
					"opacity":"1"
					});						
				}, 3100 );
				setTimeout( function(){
					jQuery( 'body' ).cfslider( 'remove' );
					jQuery( ".cfslider-form input, .cfslider-form textarea" ).val( '' );
					jQuery( ".cfslider-form .submit-button" ).text( options.sendbutton_text );
				}, 2500 );
			}
			else {
				jQuery( ".cfslider-form .submit-button" ).text( options.failed_text );
				setTimeout( function() {
					jQuery( ".cfslider-form .submit-button" ).text( options.sendbutton_text );
				}, 2500 );
			}
		});
	});
	jQuery( ".open_cslider" ).on( "click", function( event ) {
		event.preventDefault();
		jQuery( 'body' ).cfslider( 'open' );
	})
	jQuery( ".close_cslider" ).on( "click", function( event ) {
		event.preventDefault();
		jQuery( 'body' ).cfslider( 'close' );
	})
	jQuery( ".close_contact_slider" ).on( "click", function( event ) {
		event.preventDefault();
		jQuery( 'body' ).cfslider( 'close' );
	})
	jQuery( ".hide_cslider" ).on( "click", function( event ) {
		event.preventDefault();
		jQuery( 'body' ).cfslider( 'hide' );
	})
	jQuery( ".show_cslider" ).on( "click", function( event ) {
		event.preventDefault();
		jQuery( 'body' ).cfslider( 'show' );
	})								
	jQuery( ".contact-form-slider-box .cfs-icon" ).on( "click", function() {
		jQuery( ".contact-form-slider-box .cfs-icon" ).removeClass( "heartbeat shake" + options.shake );
		if ( parentbox == "" || parentbox == undefined ) {
			var parent_div = jQuery( this ).parent();
		}
		else {
			var parent_div = jQuery( parentbox );
		}
		parentbox = '';
		if ( jQuery( this ).attr( "class" ).indexOf( "left" ) != -1 ) {
			var thisdirection = "left";
		}
		else {
			var thisdirection = "right";
		}
		if ( thisdirection == 'left' ) {
			block_autoopen = true;
			if ( parseInt( jQuery( parent_div ).css( "left" ).replace( "px", "" ) ) < -5 ) {
				divscroller( parent_div );
				return true;
			}
			if ( parseInt( jQuery( parent_div ).css( "left" ).replace( "px", "" ) ) >= -5 ) {
				jQuery( 'body' ).cfslider( 'remove', parent_div );
				return true;
			}
		}
		if ( thisdirection == 'right' ) {
			block_autoopen = true;
			if ( parseInt( jQuery( parent_div ).css( "right" ).replace( "px", "" ) ) < -5 ) {
				divscroller( parent_div );
				return true;
			}
			if ( parseInt( jQuery( parent_div ).css( "right" ).replace( "px", "" ) ) >= -5 ) {
				jQuery( 'body' ).cfslider( 'remove', parent_div );
				return true;
			}
		}
	});
	}

	if ( options.flat != "true" ) {
	jQuery( '.cfsbox' ).jScrollPane({
			showArrows: true,
			autoReinitialise: true,
			autoReinitialiseDelay: 1,
			verticalGutter: 0
		});
		if ( options.height == 'full' ) {
			jQuery( ".cfs_hdline" ).css({
				"height": "100%",
				"top": "0%"
			});
		}
	}
	jQuery( window ).resize( function() {
		jQuery( 'body' ).cfslider( 'resize' );
	});

	jQuery( window ).scroll( function() {
		var st = jQuery( this ).scrollTop();
		if( jQuery( window ).scrollTop() + jQuery( window ).height() > jQuery( document ).height() - ( ( jQuery( document ).height() / 100 ) * 10 ) && st > lastScrollTop && opened == false ) {
			if ( jQuery( ".contact-form-slider-box" ).length == 1 ) {
					if ( ( parseInt( jQuery( ".contact-form-slider-box" ).css( "left" ).replace( "px", "" ) ) < -5 && options.direction == 'left' ) || ( parseInt( jQuery( ".contact-form-slider-box" ).css( "right" ).replace( "px", "" ) ) < -5 && options.direction == 'right' ) ) {
						if ( options.auto_open == 'true' && ( jQuery( 'body' ).cfslider( 'getCookie', 'cfs_hdline' ) != '1' || options.dofsu == 'false' ) && ( jQuery( '.contact-form-slider-box' ) != undefined ) ) {
							if ( options.dofsu == 'true' ) {
								visitor_rememberer();
							}
							opened = true;
							if ( block_autoopen == false ) {
								opened_slider = jQuery( '.contact-form-slider-box' );
							}
							divscroller( opened_slider );
						}
					}
			}
		}
		lastScrollTop = st;
	});
	
	function visitor_rememberer() {
		var fbcscparams = [ 'cfs_hdline', '1', 999, 'days' ];
		jQuery( 'body' ).cfslider( 'setCookie', fbcscparams );
	}
	
	function divscroller( boxtype ) {
		if ( options.bodyanim != "disabled" && options.flat == "false" ) {
			if ( ! jQuery( 'body' ).cfslider( 'detectmob' ) ) {
				jQuery( "#cfs_wrapper_inside" ).addClass( options.bodyanim );
			}
		}
		var d = new Date();
		jQuery( "#cfs-form-captcha-image" ).attr( "src", cfs_params.plugin_directory + "/captcha.php?" + d.getTime() );
		opened_slider = boxtype;
		jQuery( ".cfs_hdline" ).css( "z-index", "10" );
		jQuery( opened_slider ).css( "z-index", "999999" );
		jQuery( '.fb_ltr' ).css( "width", jQuery( ".cfsbox" ).width() - 20 + 'px' );
		if ( options.lock_screen == 'true' ) {
			jQuery( '#cfs-bglock' ).css( "zIndex", "999998" );
			jQuery( '#cfs-bglock' ).css({
				"filter": "alpha(opacity=" + getString( options.transparency ) + ")",
				"-khtml-opacity": "" + getString( parseInt( options.transparency ) / 100 ) + "",
				"-moz-opacity": "" + getString( parseInt( options.transparency ) / 100 ) + "",
				"opacity": "" + getString( parseInt( options.transparency ) / 100 ) + ""
			});
		}
		var screen_width = jQuery( window ).width();
		if ( options.direction == 'left' ) {
			jQuery( boxtype ).css({
				"left": "-5px"
			})
		}
		if ( options.direction == 'right' ) {
			jQuery( boxtype ).css({
				"right": "-5px"
			});
		}
		if ( ! jQuery( 'body' ).cfslider( 'detectmob' ) ) {
		}
		else {
			jQuery( ".cform-photo" ).focus();			
		}
		setTimeout( function() {
			jQuery( ".jspScrollable" ).css( "height", "100%" );
		}, 10 );
		opened = true;
	}
}
},
	setCookie : function( params ) {
	var c_name = params[0];
	var value = params[1];
	var dduntil = params[2];
	var mode = params[3];
		if (mode=='days')
		{
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + parseInt(dduntil));
			var c_value=escape(value) + ((dduntil==null) ? "" : "; expires="+exdate.toUTCString()) + "; path=/";
			document.cookie=c_name + "=" + c_value;		
		}
		if (mode=='minutes')
		{
			var now=new Date();
			var time = now.getTime();
			time += parseInt(dduntil);
			now.setTime(time);
			var c_value=escape(value) + ((dduntil==null) ? "" : "; expires="+now.toUTCString()) + "; path=/";
			document.cookie=c_name + "=" + c_value;
		}
	},
	getCookie : function( c_name ) {
		var c_value = document.cookie;
		var c_start = c_value.indexOf(" " + c_name + "=");
		if (c_start == -1)
		  {
		  c_start = c_value.indexOf(c_name + "=");
		  }
		if (c_start == -1)
		  {
		  c_value = null;
		  }
		else
		  {
		  c_start = c_value.indexOf("=", c_start) + 1;
		  var c_end = c_value.indexOf(";", c_start);
		  if (c_end == -1)
		  {
		c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
		}
		return c_value;
	},
    destroy : function() {
		jQuery( ".cfs_hdline" ).remove();
		jQuery( "#cfs-bglock" ).remove();		
		return 1;
	},
	open : function() {
	   if (parentbox=='') 
		{
			parentbox = '.contact-form-slider-box';
			jQuery( ".contact-form-slider-box .cfs-icon" ).trigger( "click" );
		}
	},
	close : function() {
		jQuery('body').cfslider('remove');
	},
	hide : function() {
		jQuery('.cfs_hdline').hide();
	},
	show : function() {
		jQuery('.cfs_hdline').show();
	},
	detectmob : function() {
        var Uagent = navigator.userAgent||navigator.vendor||window.opera;
        return(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(Uagent)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(Uagent.substr(0,4))); 
	},
	remove : function( boxtype ) {
		if ( typeof cfs_params !== 'undefined') {
			options = cfs_params;
		}
		var options = jQuery.extend({}, defaults, options);
		if ( boxtype == undefined || boxtype == '' ) {
			boxtype = opened_slider;
		}
		if ( jQuery( '#cfs-bglock' ).length ) {
			jQuery( '#cfs-bglock' ).css({
				"filter": "alpha(opacity=0)",
				"-khtml-opacity": "0",
				"-moz-opacity": "0",
				"opacity": "0"
			});
			setTimeout( function() {
				jQuery( '#cfs-bglock' ).css({
					"zIndex": "-1"
				});				
			}, 1000 );

		}
		if ( options.direction == 'left' ) {
			jQuery( boxtype ).css({
				"left": "-" + ( parseInt( jQuery( boxtype ).width() ) + space ) + "px"
				})
		}
		if ( options.direction == 'right' ) {
			jQuery( boxtype ).css({
				"right": "-" + ( jQuery( boxtype ).width() ) + "px" 
			})
		}
		jQuery( "#cfs_wrapper_inside" ).removeClass( options.bodyanim );
	},
	resize : function() {
		if ( typeof cfs_params !== 'undefined') {
			options = cfs_params;
		}
		var options = jQuery.extend({}, defaults, options);
		if ( jQuery( ".contact-form-slider-box" ).length == 1 ) {
			if ( jQuery( 'body' ).cfslider( 'detectmob' ) == true ) {
				jQuery( ".contact-form-slider-box" ).css( "width", "80%" );
			}
			else {
				jQuery( ".contact-form-slider-box").css( "width", "35%" );
			}
			if ( options.height != 'full' ) {
				jQuery('.contact-form-slider-box').css("height",'80%');
			}
			jQuery( '.contact-form-slider-box .cfsbox' ).css( "width", ( jQuery( ".contact-form-slider-box .cfs_hdline_inside" ).width() ) + 'px' );
			jQuery( '.contact-form-slider-box .cfsbox' ).css( "height", ( jQuery( ".contact-form-slider-box .cfs_hdline_inside" ).height() - 55 ) + 'px' );
			jQuery( '.contact-form-slider-box .fb_ltr' ).css( "height", ( jQuery( ".contact-form-slider-box .cfsbox" ).height() / 100 * 90 ) + 'px' );
			jQuery( '.contact-form-slider-box .fb_ltr' ).css( "width", jQuery( ".contact-form-slider-box .cfsbox" ).width() - 20 + 'px' );
			if ( parseInt( jQuery( ".contact-form-slider-box" ).css( "left" ).replace( "px", "" ) ) < -5 ) {
				jQuery( '.contact-form-slider-box' ).css( "left", '-' + ( jQuery( ".contact-form-slider-box" ).width() + space ) + 'px' );
			}
			if ( parseInt( jQuery( ".contact-form-slider-box" ).css( "right" ).replace( "px", "" ) ) < -5 ) {
				jQuery( '.contact-form-slider-box' ).css( "right", '-' + ( jQuery( ".contact-form-slider-box" ).width() ) + 'px' );
			}
			if ( options.direction == 'left' ) {
				jQuery( '.contact-form-slider-box .cfs-icon' ).css( "left", ( parseInt( jQuery( ".contact-form-slider-box" ).width() ) + bspace ) + 'px' );
			}
			if ( options.direction == 'right' ) {
				jQuery( '.contact-form-slider-box .cfs-icon' ).css( "left", 'auto' );
				jQuery( '.contact-form-slider-box .cfs-icon' ).css( "right", ( parseInt( jQuery( ".contact-form-slider-box" ).width() ) ) + 'px' );
			}
			jQuery( ".contact-form-slider-box .fb-like-box" ).attr( "data-width", ( jQuery( ".contact-form-slider-box" ).width() - 30 ) + 'px' );
			setTimeout( function() {
				jQuery( ".jspScrollable" ).css( "height", "100%" );
			}, 10 );
		}
	}
};
jQuery.fn.cfslider = function(methodOrOptions) {
        if ( methods[methodOrOptions] ) {
            return methods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
            return methods.init.apply( this, arguments );
        } else {
            jQuery.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.cfslider' );
        }    
    };
})( jQuery );