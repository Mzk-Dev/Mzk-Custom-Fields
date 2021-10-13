<?php 
function mzk_add_textarea($post_id, $meta_key, $label){
    $meta_value = get_post_meta( $post_id, $meta_key, true );
    ?>
    <div class="inside">
      <div>
        <label for="<?php echo $meta_key;?>"><strong><?php echo $label ?> :</strong></label>
      </div>
      <div>
        <textarea id="<?php echo $meta_key;?>" name="<?php echo $meta_key;?>" style="width: 100%;" rows="3" maxlength="1024"><?php echo $meta_value;?></textarea>
      </div>
    </div>
    <?php
  }