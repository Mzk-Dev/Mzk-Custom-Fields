<?php
function mzk_add_slider($post_id, $meta_key)
{
    $value = get_post_meta($post_id, $meta_key, true);
    $meta_value = json_decode($value, true);

    // $image_gallery = [];
    $number = 0;
    $i = 0;
    // foreach ( $meta_value  as $one_attachment ) {
    // $attachment_id = $one_attachment['image_id'];
    $image_gallery[] = $number;


?>
    <div id="gallery_images_container">
        <ul class="gallery_images" data-key="<?php echo $meta_key ?>">
            <?php if (($meta_value)) :

                foreach ($meta_value as $meta_val) : ?>
                    <li class="image attachment details" data-attachment_id="<?php echo $meta_val['image_id']; ?>" data-number="<?php echo $number; ?>">
                        <input type="hidden" name="<?php echo $meta_key; ?>_ID[]" value="<?php echo $post_id ?>">
                        <input type="hidden" name="<?php echo $meta_key; ?>_number[]" value="<?php echo $number; ?>" />
                        <input type="hidden" name="<?php echo $meta_key; ?>_attachment_id[]" value="<?php echo $meta_val['image_id']; ?>" />
                        <!-- <input type="hidden" name="<?php echo $meta_key; ?>_key" value="<?php echo $meta_key; ?>"/> -->
                        <div class="attachment-preview">
                            <div class="thumbnail"><img src="<?php echo wp_get_attachment_image_url($meta_val['image_id']) ?>" height="150" width="150" /></div>
                            <a href="#" class="delete check" title="' . __( 'Remove image', 'easy-slider' ) . '">
                                <div class="media-modal-icon"></div>
                            </a>
                            <div class="slider_desc">
                                <table>
                                    <tr>
                                        <th><label for="<?php echo $meta_key; ?>_title_<?php echo $meta_val['image_id']; ?>">Slider title</label></th>
                                        <td><input name="<?php echo $meta_key; ?>_title[]" id="slider_title_<?php echo $meta_val['image_id']; ?>" type="text" value="<?php echo $meta_val['image_title']; ?>" /></td>
                                        <th><label for="<?php echo $meta_key; ?>_subtitle_<?php echo $meta_val['image_id']; ?>">Slider subtitle</label></th>
                                        <td><input name="<?php echo $meta_key; ?>_subtitle[]>" id="slider_subtitle_<?php echo $meta_val['image_id']; ?>" type="text" value="<?php echo $meta_val['image_subtitle']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <th><label for="<?php echo $meta_key; ?>_name_<?php echo $meta_val['image_id']; ?>">Button name</label></th>
                                        <td><input name="<?php echo $meta_key; ?>_name[]" id="button_name_<?php echo $meta_val['image_id']; ?>" type="text" value="<?php echo $meta_val['button_name']; ?>" /></td>
                                        <th><label for="<?php echo $meta_key; ?><?php echo $meta_val['image_id']; ?>">Button link</label></th>
                                        <td><input name="<?php echo $meta_key; ?>_link[]>" id="button_link_<?php echo $meta_val['image_id']; ?>" type="text" value="<?php echo $meta_val['button_link']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <th colspan="1"><label for="<?php echo $meta_key; ?>_<?php echo $meta_val['image_id']; ?>">Image signature</label></th>
                                        <td colspan="3"><input name="<?php echo $meta_key; ?>_signature[]" id="image_signature_<?php echo $meta_val['image_id']; ?>" type="text" value="<?php echo $meta_val['image_signature']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <th colspan="1"><label for="<?php echo $meta_key; ?>_content_<?php echo $meta_val['image_id']; ?>">Slider content</label></th>
                                        <td colspan="3"><textarea name="<?php echo $meta_key; ?>_content[]" id="slider_content_<?php echo $meta_val['image_id']; ?>"><?php echo $meta_val['image_content']; ?></textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </li>

            <?php $number++;
                endforeach;
            endif;

            // }

            $image_gallery = implode(', ', $image_gallery);
            ?>
        </ul>
        <input type="hidden" id="image_gallery" name="image_gallery" value="<?php echo esc_attr($image_gallery); ?>" />
    </div>

    <p class="add_gallery_images_<?php echo $meta_key ?> hide-if-no-js">
        <a href="#" data-key="<?php echo $meta_key ?>"><?php _e('Add gallery images', 'easy-slider'); ?></a>
    </p>


    <script type="text/javascript">
        jQuery(document).ready(function($) {

            // Uploading files
            var image_gallery_frame;
            var $image_gallery_ids = $('#image_gallery');
            var $gallery_images = $("#gallery_images_container ul.gallery_images[data-key=<?php echo $meta_key; ?>]");


            jQuery(".add_gallery_images_<?php echo $meta_key; ?>").on('click', 'a', function(event) {
                var number = <?php echo $number; ?>;
                var key = '<?php echo $meta_key; ?>';
                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if (image_gallery_frame) {
                    image_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e('Add Images to Gallery', 'easy-slider'); ?>',
                    button: {
                        text: '<?php _e('Add to gallery', 'easy-slider'); ?>',
                    },
                    multiple: true
                });
                // console.log(image_gallery_frame.cid);

                // When an image is selected, run a callback.
                image_gallery_frame.on('select', function() {

                    var selection = image_gallery_frame.state().get('selection');

                    selection.map(function(attachment) {

                        attachment = attachment.toJSON();

                        if (attachment.id) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $gallery_images.append('\
                                    <li class="image attachment details" data-attachment_id="' + attachment.id + '" data-number="' + number + '">\
                                        <input type="hidden" name="' + key + '_number[]" value="' + number + '"/>\
                                        <input type="hidden" name="' + key + '_attachment_id[]" value="' + attachment.id + '"/>\
                                        <div class="attachment-preview">\
                                            <div class="thumbnail">\
                                                <img src="' + attachment.url + '" />\
                                            </div>\
                                            <a href="#" class="delete check" title="<?php _e('Remove image', 'easy-slider'); ?>"><div class="media-modal-icon"></div></a>\
                                            <div class="slider_desc">\
                                                <table>\
                                                    <tr>\
                                                        <th><label>Slider title</label></th>\
                                                        <td><input name="' + key + '_title[]" type="text"/></td>\
                                                        <th><label>Slider subtitle</label></th>\
                                                        <td><input name="' + key + '_subtitle[]" type="text"/></td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th><label>Button name</label></th>\
                                                        <td><input name="' + key + '_name[]" type="text"/></td>\
                                                        <th><label>Button link</label></th>\
                                                        <td><input name="' + key + '_link[]" type="text"/></td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th colspan="1"><label>Image signature</label></th>\
                                                        <td colspan="3"><input name="' + key + '_signature[]" type="text"/></td>\
                                                    </tr>\
                                                    <tr>\
                                                        <th colspan="1"><label>Slider content</label></th>\
                                                        <td colspan="3"><textarea name="' + key + '_content[]"></textarea></td>\
                                                    </tr>\
                                                </table>\
                                            </div>\
                                        </div>\
                                    </li>');
                        }
                    });

                    $image_gallery_ids.val(attachment_ids);

                    number++;


                });
                //image_gallery_frame.cid
                // Finally, open the modal.
                image_gallery_frame.open();

            });

            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'eig-metabox-sortable-placeholder',
                start: function(event, ui) {
                    ui.item.css('background-color', '#f6f6f6');
                },
                stop: function(event, ui) {
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var numbers = '';

                    $('#gallery_images_container ul li.image').css('cursor', 'default').each(function() {
                        var number = jQuery(this).attr('data-number');
                        numbers = numbers + number + ',';
                    });

                    $image_gallery_ids.val(numbers);
                }
            });

            // Remove images
            $('a.delete').on('click', function() {

                $(this).closest('li.image').remove();

                var numbers = '';

                $('#gallery_images_container ul li.image').css('cursor', 'default').each(function() {
                    var number = jQuery(this).attr('data-number');
                    numbers = numbers + number + ',';
                });

                $image_gallery_ids.val(numbers);

                return false;
            });

        });
    </script>
<?php

}
