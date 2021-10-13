Plugin Name: Mzk Custom Field<br>
Contributors: Max Cherenov<br>
Plugin URI:  https://github.com/Mzk-Dev/Mzk-Custom-Fields<br>
Author URI:  https://github.com/Mzk-Dev<br>
Version:     1.0<br>
<br>
Plugin made to easily add WordPress metaboxes with using functions.
<br>
After starting the plugin, the following functions will be available to you:
<br>
* mzk_add_input($post_id , '$meta_key' , '$label');
* mzk_add_textarea($post_id  , '$meta_key' , '$label' );
* mzk_add_image($post_id , '$meta_key' , '$label');
* mzk_add_wysiwyg($post_id , '$meta_key' , '$label');
* mzk_add_color( $post_id , '$meta_key' , '$label');
* mzk_add_video($post_id , '$meta_key' , '$label');
* mzk_add_slider($post_id , '$meta_key');
<br>
* mzk_save_metabox($post_id , '$meta_key');<br>
* mzk_save_slider($post_id , '$meta_key');<br>
* mzk_save_video($post_id , '$meta_key');<br>
<br>
Parameters #
<br>
$post_id :
(int) (Required) Post ID.
<br>
$meta_key :
(string) (Required) The meta key to retrieve. By default, returns data for all keys.
<br>
$label :
(string) The line that will be before your field in the wordpress admin panel
<br>
<br>
For example :<br>
mzk_add_input($post_id , 'my_input', 'Example input');<br>
And how it shows in admin panel <br>
<img src="https://user-images.githubusercontent.com/73549506/136402066-223f5362-5044-40f8-a468-42af842741f6.png">
To save the value in our field, you also need to use the function:<br>
mzk_save_metabox( $post_id , 'my_input');<br>
<br>
Function "mzk_save_metabox($post_id , '$meta_key')" suitable for storing fields created by functions:<br>
* mzk_add_input($post_id , '$meta_key' , '$label');<br>
* mzk_add_textarea($post_id  , '$meta_key' , '$label' );<br>
* mzk_add_image($post_id , '$meta_key' , '$label');<br>
* mzk_add_wysiwyg($post_id , '$meta_key' , '$label');<br>
* mzk_add_color( $post_id , '$meta_key' , '$label');<br>
<br>
Slider is a metabox that stores the value of several custom fields, such as image_id, image_title, image_subtitle, button_name, button_link, image_signature and image_content.<br>
In addition, you can add an unlimited number of images.<br>
Example slider with two images :<br><br>
<img src="https://user-images.githubusercontent.com/73549506/136538264-b3b49cf7-b9ff-4573-b5ca-5a67909d44bc.png">

<br>
For slider and video saving you need two other functions:<br>
* mzk_save_slider($post_id , '$meta_key');<br>
* mzk_save_video($post_id , '$meta_key');<br>
<br>
<br>
To take the values of custom fields in your files use the standard function :<br>
* get_post_meta( int $post_id, string $meta_key = '', bool $single = false );<br>
Parameters #<br>
$post_id<br>
(int) (Required) Post ID.<br>
<br>
$meta_key
(string) (Optional) The meta key to retrieve. By default, returns data for all keys.<br>
Default value: ''<br>
<br>
$single<br>
(bool) (Optional) Whether to return a single value. This parameter has no effect if $meta_key is not specified.<br>
Default value: false<br>
<br>
In the end, your functions.php file (or whatever) will look like this:<br><br>
<img src="https://user-images.githubusercontent.com/73549506/137158680-fd3023db-62b2-4bbb-bf20-a1019f5752d5.png">
<img src="https://user-images.githubusercontent.com/73549506/137158805-e2ddb1a0-e093-439d-9410-5812d822f03a.png">
