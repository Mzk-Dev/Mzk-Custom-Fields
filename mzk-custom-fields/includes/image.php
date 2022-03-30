<?php 
function mzk_add_image($post_id, $meta_key, $label){
  $meta_value = get_post_meta( $post_id, $meta_key, true );
  ?>
<div class="inside">
  <label for="<?php echo $meta_key;?>" style="display:block;"><strong><?php echo $label ?> :</strong></label>
  <?php 
  if($meta_value){
    ?>
    <a href="#" class="<?php echo $meta_key;?>"><img style="max-width:600px;max-height:600px;" src="<?php echo wp_get_attachment_url($meta_value) ?>" /></a>
    <a href="#" style="display:block;padding:20px 0;" class="rmv">Remove image</a>
    <input type="hidden" name="<?php echo $meta_key;?>" value="<?php echo $meta_value ?> ">
  <?php }else {?>
    <a href="#" style="display:block;padding:20px 0;" class="<?php echo $meta_key;?>">Upload image</a>
    <a href="#" class="rmv" style="display:none;padding:20px 0;">Remove image</a>
    <input type="hidden" name="<?php echo $meta_key;?>" value="">
  <?php } ?>
</div>
  <script>
    jQuery(function($){
    // on upload button click
    $('body').on( 'click', ".<?php echo $meta_key;?>" , function(e){
      e.preventDefault();
      var button = $(this),
      custom_uploader = wp.media({
        title: 'Insert image',
        library : {
          // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
          type : 'image'
        },
        button: {
          text: 'Use this image' // button label text
        },
        multiple: false
      }).on('select', function() { // it also has "open" and "close" events
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        button.html('<img src="' + attachment.url + '">').next().val(attachment.id).next().show();
        $('input[name="<?php echo $meta_key;?>"]').val(attachment.id);
      }).open();

    });

    $('body').on('click', '.rmv', function(e){
 
    e.preventDefault();
 
    var button = $(this);
    button.next().val(''); 
    button.hide().prev().html('Upload image');
  });

  });
  </script><?php 

}
