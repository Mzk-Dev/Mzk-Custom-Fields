<?php 
function mzk_add_wysiwyg($post_id, $meta_key, $label){
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  ?>
  <div class="inside">
    <div>
      <label for="<?php echo $meta_key;?>" style="display:block;"><strong><?php echo $label ?> :</strong></label>
    </div>
  </div>
  <?php  wp_editor( $meta_value, $meta_key );
}