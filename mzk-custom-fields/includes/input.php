<?php
function mzk_add_input($post_id, $meta_key, $label)
{
  $meta_value = get_post_meta($post_id, $meta_key, true);
?>
  <div class="inside">
    <div>
      <label for="<?php echo $meta_key; ?>"><strong><?php echo $label ?> :</strong></label>
    </div>

    <div>
      <input id="<?php echo $meta_key; ?>" type="text" name="<?php echo $meta_key; ?>" style="width: 100%;" value="<?php echo $meta_value; ?>" />
    </div>
  </div>
<?php
}
