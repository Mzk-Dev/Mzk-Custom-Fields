<?php
function mzk_add_color($post_id, $meta_key, $label){
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    ?>
  
    <div class="inside">
      <div>
        <label for="<?php echo $meta_key;?>"><strong><?php echo $label ?> :</strong></label>
      </div>
  
      <div>
        <input id="<?php echo $meta_key;?>" type="color" name="<?php echo $meta_key;?>" style="max-width:200px"  value="<?php echo $meta_value ; ?>" />
      </div>
    </div>
    <?php 
  }