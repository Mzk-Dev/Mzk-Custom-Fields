<?php
function mzk_add_video($post_id, $meta_key, $label)
{
  $meta_value = get_post_meta($post_id, $meta_key, true);
?>
  <div class="inside">
    <?php if ($meta_value && $meta_value['url'] && $meta_value['file']) : ?>
      <div id="<?php echo $meta_key ?>_show" style="<?php if (!$meta_value) echo 'display: none'; ?>">
        <div><label for="remove_video"><strong><?php echo $label ?>: </strong></label><a href="<?php echo $meta_value['url'] ?>"><?php echo $meta_value['url']; ?></a></div>
        <div><a href="#" id="remove_video" data-postid="<?php echo $post_id; ?>" data-value="<?php echo $meta_value['file'] ?>" data-type="<?php echo $meta_value['type'] ?>" data-key="<?php echo $meta_key ?>" class="remove_video" target="_blank">Remove file</a></div>
      </div>
    <?php endif; ?>
    <div id="<?php echo $meta_key ?>_upload" style="<?php if ($meta_value) echo 'display: none'; ?>">
      <p class="description">Upload your Fullscreen video .mp4</p>
      <input type="file" id="<?php echo $meta_key ?>" name="<?php echo $meta_key ?>" value="<?php echo $meta_value ?>" size="25" />
    </div>
  </div>

  <script>
    jQuery(function($) {
      $('body').on('click', '.remove_video', function(e) {
        e.preventDefault();

        var client_video = $(this).data('value');
        var postid = $(this).data('postid');
        var type = $(this).data('type');
        var key = $(this).data('key');
        <?php $url = admin_url('admin-ajax.php'); ?>;
        var data = {
          action: 'remove_video',
          client_video: client_video,
          postid: postid,
          type: type,
          key: key
        }

        $.ajax({
          url: '<?php echo "$url" ?>',
          type: 'POST',
          data: data,
          success: function(data) {
            $('#' + key + '_show').hide();
            $('#' + key + '_upload').show();
          }
        });
      });
    });
  </script>
<?php
};

if (wp_doing_ajax()) {
  add_action('wp_ajax_remove_video', 'mzk_remove_video_callback');
  function mzk_remove_video_callback()
  {
    if (
      empty($_POST['client_video']) || !is_string($_POST['client_video']) ||
      empty($_POST['postid']) || !is_string($_POST['postid']) ||
      empty($_POST['type']) || !is_string($_POST['type'])
    ) {
      header400();
      header_json();
      echo json_encode(['code' => 'wrong_removing', 'message' => 'Wrong post']);
      die();
    }

    // $filepath = rtrim(ABSPATH, '/') . '/' . ltrim($_POST['client_video'], '/');

    $filepath = ltrim($_POST['client_video']);

    if (is_file($filepath)) {
      unlink($filepath);
    }

    unlink($filepath);
    update_post_meta($_POST['postid'], $_POST['key'], '');

    header200();
    header_json();
    echo json_encode(['status' => 'success']);
    die();
  }
}
