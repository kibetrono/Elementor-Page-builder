<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link        https://author.example.com/
 * @since      1.0.0
 *
 * @package    Rono
 * @subpackage Rono/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<br>
<div class=" container mt-3 p-3">

  <form id="my_main" method='post' action="options.php">
    <?php
      // settings_fields( $option_group:string );
      settings_fields('you_channels' );
      // do_settings_sections( $page:string )
      
      do_settings_sections( 'you_channels' )
    ?>
  <h1 class="text-center">YouTube API Importer</h1>  

  <div class="form-group">
    <label for="exampleFormControlInput1">YouTube API Key</label>
    <input type="text" name="theKey" value="<?php echo get_option( 'theKey'); ?>" class="form-control" id="exampleFormControlInput1" placeholder="YouTube API Key">
  </div>
<br>
  <div class="form-group">
  <label for="exampleFormControlInput1">Your YouTube Channel ID</label>
  <input type="text" name="theID" value="<?php echo get_option( 'theID' ); ?>" class="form-control" id="exampleFormControlInput1" placeholder="Your channel ID">
 
  </div>
  <!-- <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div> -->
  <div class="form-group">
      <button type='submit' class="btn btn-primary mt-2"> Submit</button>
  </div>
</form>
</div>

<?php

        //Get videos from channel by YouTube Data API
        $youtubeAPIKey = get_option( 'theKey' );
        // AIzaSyC01dwcUcsQ-K9sanvY7ZodFJmvqYW6PSM
        $youtubeChannelID  = get_option( 'theID' );
        $total_number=1;
        $videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$youtubeChannelID.'&maxResults='.$total_number.'&key='.$youtubeAPIKey.''));
        

        //load in each video
        foreach($videoList->items as $item){
      

  //determine if we already have this video
  $videxists = strpos($compvids , $item->id->videoId);
	
  //check to see if this video exists
  if ($videxists > 0) {

    //echo ('found' . $videxists . '<br>');

  } else {

			//add the video because IT WAS NOT FOUND IN OUR DATABASE STRING
				  //INSERT A NEW POST VIDEO
		  $data = array(
			'post_title' => $item->snippet->title,
			'post_content' => $item->snippet->description,
			'post_category' => array($_POST['uncategorized']),
			'tags_input' => array($tags),
			'post_status' => 'publish',
			'post_type' => 'wp10yvids'
		  );
           //insert this post into the DB and RETRIEVE the ID
		  $result = wp_insert_post( $data );
		  //echo ($results);
	
		  //capture the ID of the post
		  if ( $result && ! is_wp_error( $result ) ) {
			$thenewpostID = $result;
			//add the youtube meta data
			add_post_meta( $thenewpostID, 'videoID', $item->id);
			add_post_meta( $thenewpostID, 'publishedAt', $item->snippet->publishedAt);
			add_post_meta( $thenewpostID, 'channelId', $item->snippet->channelId);
			add_post_meta( $thenewpostID, 'ytitle', $item->snippet->title);
			add_post_meta( $thenewpostID, 'ydescription', $item->snippet->description);
			add_post_meta( $thenewpostID, 'imageresmed', $item->snippet->thumbnails->medium->url);
			add_post_meta( $thenewpostID, 'imagereshigh', $item->snippet->thumbnails->high->url);

            echo ('<img src="'.get_post_meta($thenewpostID,'imageresmed',true).'"/>');
	
		  }
	
		  }
        }



?>