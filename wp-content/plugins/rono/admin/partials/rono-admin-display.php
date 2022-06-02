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
      settings_fields('myownsettings' );
      // do_settings_sections( $page:string )
      
      do_settings_sections( 'myownsettings' )
    ?>
  <h1 class="text-center">Example Plugin</h1>  

  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" name="theemail" value="<?php echo get_option( 'theemail','default@gmail.com' ); ?>" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
      <?php

      $selectedoption= get_option('thedays');

      ?>
    <label for="exampleFormControlSelect1">Example select</label>
    <select name="thedays" class="form-control" id="exampleFormControlSelect1">
      <option <?php if($selectedoption == '1'){echo 'selected';}; ?>>1</option>
      <option <?php if($selectedoption == '2'){echo 'selected';};?> >2</option>
      <option <?php if($selectedoption == '3'){echo 'selected';};?> >3</option>
      <option <?php if($selectedoption == '4'){echo 'selected';};?> >4</option>
      <option <?php if($selectedoption == '5'){echo 'selected';};?> >5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select name="themuiltiselect" multiple class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <!-- <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div> -->
  <div class="form-group">
      <button type='submit' class="btn btn-primary mt-2"> Submit Settings</button>
  </div>
</form>
</div>

