<?php
if (!defined('ABSPATH')) exit;

// function mzk_check_post($post_id){
//     if (
//       !isset($_POST['options_metabox_nonce'])
//       || !wp_verify_nonce($_POST['options_metabox_nonce'], basename(__FILE__))
//     ) {
//       return $post_id;
//     }
//     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
//       return $post_id;
//     }
//     if (!current_user_can('edit_post', $post_id)) {
//       return $post_id;
//     }
//     return false;

// }

function mzk_save_metabox($post_id, $meta_key)
{
  $meta_value = $_POST[$meta_key] ?? '';
  update_post_meta($post_id, $meta_key, $meta_value);
}

function mzk_save_video($post_id, $meta_key)
{
  if (!empty($_FILES[$meta_key]['name'])) {

    $supported_types = array('video/mp4');

    $arr_file_type = wp_check_filetype(basename($_FILES[$meta_key]['name']));
    $uploaded_type = $arr_file_type['type'];

    if (in_array($uploaded_type, $supported_types)) {
      $upload = wp_upload_bits($_FILES[$meta_key]['name'], null, file_get_contents($_FILES[$meta_key]['tmp_name']));
      // var_dump($upload);

      if (isset($upload['error']) && $upload['error'] != 0) {
        wp_die('There was an error uploading your file. The error is: ' . json_encode($upload['error']));
      } else {
        update_post_meta($post_id, $meta_key, $upload);
      }
    } else {
      wp_die("The file type that you've uploaded is not a mp4.");
    }
  }
}

function mzk_save_slider($post_id, $meta_key)
{
  $key = $meta_key;
  $number = $_POST["$key" . "_number"];
  $attachment = $_POST["$key" . "_attachment_id"];
  $title = $_POST["$key" . "_title"];
  $subtitle = $_POST["$key" . "_subtitle"];
  $name = $_POST["$key" . "_name"];
  $link = $_POST["$key" . "_link"];
  $signature = $_POST["$key" . "_signature"];
  $content = $_POST["$key" . "_content"];

  if (is_array($number)) {
    for ($i = 0; $i < count($number); $i++) {
      $meta_val[$i] = array('key' => "$key" . "_subtitle", 'image_id' => $attachment[$i], 'image_title' => $title[$i], 'image_subtitle' => $subtitle[$i], 'button_name' => $name[$i], 'button_link' => $link[$i], 'image_signature' => $signature[$i], 'image_content' => $content[$i]);
    }
  } else {
    if ($number) {
      $meta_val[0] = array('key' => "$key" . "_subtitle", 'image_id' => $attachment[0], 'image_title' => $title[0], 'image_subtitle' => $subtitle[0], 'button_name' => $name[0], 'button_link' => $link[0], 'image_signature' => $signature[0], 'image_content' => $content[0]);
    } else {
      $meta_val = null;
    }
  }

  $meta_value = json_encode($meta_val, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS);
  // $meta_value = $_POST[$meta_key] ?? '';
  update_post_meta($post_id, $meta_key, ($meta_value));
}
