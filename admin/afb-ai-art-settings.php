<?php  wp_enqueue_media(); ?>

<div class="wrap">
    <h2>AI Art Settings</h2>
    <form method="post" action="options.php">
        <?php settings_fields('ai_art_settings_group'); ?>
        <?php do_settings_sections('ai-art-settings'); ?>
        <table class="form-table">
        <tr>
                <th scope="row"><label for="afb_ai_art_api_key">Nueral Love API key</label></th>
                <td>
                    <textarea required placeholder="Enter API Kye here" cols="70" rows="2" type="text" id="" name="afb_ai_art_api_key"
                        value="<?php echo esc_attr(get_option('afb_ai_art_api_key')); ?>"><?php echo esc_attr(get_option('afb_ai_art_api_key')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="afb_ai_art_price">Price per AI ART</label></th>
                <td>
                    <input required placeholder="Enter Price here"   type="text" id="" name="afb_ai_art_price"
                        value="<?php echo esc_attr(get_option('afb_ai_art_price')); ?>"> 
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="afb_ai_art_default_product_img">Default Product Featured Image</label></th>
                <td>
                    <input   type="file" id="afb_img_selector" name=""> 
                    
                    <input required  hidden  type="number" id="afb_ai_art_default_product_img" name="afb_ai_art_default_product_img"
                        value="<?php echo esc_attr(get_option('afb_ai_art_default_product_img')); ?>"> 
                    
                    <img src="<?= wp_get_attachment_url(get_option('afb_ai_art_default_product_img')) ?>" alt="" id="afb-preview-image" width="100">
                </td>
            </tr>
			
			<tr>
                <th scope="row"><label for="afb_ai_art_default_watermark_img">Watermark</label></th>
                <td>
                    <input   type="file" id="afb_watermark_selector" name=""> 
                    
                    <input required  hidden  type="number" id="afb_ai_art_default_watermark_img" name="afb_ai_art_default_watermark_img"
                        value="<?php echo esc_attr(get_option('afb_ai_art_default_watermark_img')); ?>"> 
                    
                    <img src="<?= wp_get_attachment_url(get_option('afb_ai_art_default_watermark_img')) ?>" alt="" id="afb-watermark-image" width="100">
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="afb_ai_art_price">Default Product Category</label></th>
                <td>
                    <?php display_product_category_dropdown(get_option('afb_ai_art_product_category')); ?>
                </td>
            </tr> 

            <tr>
                <th scope="row"><label for="afb_ai_art_prompt">Prompt</label></th>
                <td>
                    <textarea required placeholder="Enter prompt here" cols="70" rows="5" type="text" id="" name="afb_ai_art_prompt"
                        value="<?php echo esc_attr(get_option('afb_ai_art_prompt')); ?>"><?php echo esc_attr(get_option('afb_ai_art_prompt')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="afb_ai_art_style">Style</label></th>
                <td>
                    <select required name="afb_ai_art_style">
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "PAINTING" ? "selected" : ""; ?>
                            value="PAINTING">PAINTING</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "FANTASY" ? "selected" : ""; ?>
                            value="FANTASY">FANTASY</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "ANIME" ? "selected" : ""; ?> value="ANIME">
                            ANIME</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "CYBERPUNK" ? "selected" : ""; ?>
                            value="CYBERPUNK">CYBERPUNK</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "NATURE" ? "selected" : ""; ?>
                            value="NATURE">
                            NATURE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "STEAMPUNK" ? "selected" : ""; ?>
                            value="STEAMPUNK">STEAMPUNK</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "SCIFI" ? "selected" : ""; ?> value="SCIFI">
                            SCIFI</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "SPACE" ? "selected" : ""; ?> value="SPACE">
                            SPACE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "CREEPY" ? "selected" : ""; ?>
                            value="CREEPY">
                            CREEPY</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "TATTOO" ? "selected" : ""; ?>
                            value="TATTOO">
                            TATTOO</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "TEXTURE" ? "selected" : ""; ?>
                            value="TEXTURE">TEXTURE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "ANYTHING" ? "selected" : ""; ?>
                            value="ANYTHING">ANYTHING</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "PHOTO" ? "selected" : ""; ?> value="PHOTO">
                            PHOTO</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "TAROT" ? "selected" : ""; ?> value="TAROT">
                            TAROT</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "IMPASTO" ? "selected" : ""; ?>
                            value="IMPASTO">IMPASTO</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "CHILDDRAWING" ? "selected" : ""; ?>
                            value="CHILDDRAWING">CHILDDRAWING</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "GAMELOADINGSCREEN" ? "selected" : ""; ?>
                            value="GAMELOADINGSCREEN">GAMELOADINGSCREEN</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "SALADWAVE" ? "selected" : ""; ?>
                            value="SALADWAVE">SALADWAVE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "WOOLWORLD" ? "selected" : ""; ?>
                            value="WOOLWORLD">WOOLWORLD</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "SYNTHWAVE" ? "selected" : ""; ?>
                            value="SYNTHWAVE">SYNTHWAVE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "MIDJOURNEY" ? "selected" : ""; ?>
                            value="MIDJOURNEY">MIDJOURNEY</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "XMAS" ? "selected" : ""; ?> value="XMAS">
                            XMAS
                        </option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_style')) == "DEBUG" ? "selected" : ""; ?> value="DEBUG">
                            DEBUG</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="afb_ai_art_layout">Layout</label></th>
                <td>
                    <select required name="afb_ai_art_layout">
                        <option <?php echo esc_attr(get_option('afb_ai_art_layout')) == "SQUARE" ? "selected" : ""; ?>
                            value="SQUARE">
                            SQUARE</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_layout')) == "VERTICAL" ? "selected" : ""; ?>
                            value="VERTICAL">VERTICAL</option>
                        <option <?php echo esc_attr(get_option('afb_ai_art_layout')) == "HORIZONTAL" ? "selected" : ""; ?>
                            value="HORIZONTAL">HORIZONTAL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="afb_ai_art_amount">Quantity</label></th>
                <td>
                    <input placeholder="No. of results to be generated" cols="70" rows="5" type="number" id="" name="afb_ai_art_amount"
                        value="<?php echo esc_attr(get_option('afb_ai_art_amount')); ?>">
                </td>
            </tr>
        </table>
        <?php submit_button('Save Settings'); ?>
    </form>
</div>


<script>
    jQuery(document).ready( function($) {

jQuery('input#afb_img_selector').click(function(e) {

       e.preventDefault();
       var image_frame;
       if(image_frame){
           image_frame.open();
       }
       // Define image_frame as wp.media object
       image_frame = wp.media({
                     title: 'Select Media',
                     multiple : false,
                     library : {
                          type : 'image',
                      }
                 });

                 image_frame.on('close',function() {
                    // On close, get selections and save to the hidden input
                    // plus other AJAX stuff to refresh the image preview
                    var selection =  image_frame.state().get('selection');
                    var gallery_ids = new Array();
                    var my_index = 0;
                    $url="";
                    selection.each(function(attachment) {
                        $url = attachment['attributes'].url

                       gallery_ids[my_index] = attachment['id'];
                       my_index++;
                    });
                   
                    var ids = gallery_ids.join(",");
                    if(ids.length === 0) return true;//if closed withput selecting an image
                    jQuery('input#afb_ai_art_default_product_img').val(ids);
                    jQuery('#afb-preview-image').attr("src", $url)
                    // Refresh_Image(ids);
                 });

                image_frame.on('open',function() {
                  // On open, get the id from the hidden input
                  // and select the appropiate images in the media manager
                  var selection =  image_frame.state().get('selection');
                  var ids = jQuery('input#afb_ai_art_default_product_img').val().split(',');
                  ids.forEach(function(id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add( attachment ? [ attachment ] : [] );
                  });

                });

              image_frame.open();
});
		
jQuery('input#afb_watermark_selector').click(function(e) {

       e.preventDefault();
       var image_frame;
       if(image_frame){
           image_frame.open();
       }
       // Define image_frame as wp.media object
       image_frame = wp.media({
                     title: 'Select Media',
                     multiple : false,
                     library : {
                          type : 'image',
                      }
                 });

                 image_frame.on('close',function() {
                    // On close, get selections and save to the hidden input
                    // plus other AJAX stuff to refresh the image preview
                    var selection =  image_frame.state().get('selection');
                    var gallery_ids = new Array();
                    var my_index = 0;
                    $url="";
                    selection.each(function(attachment) {
                        $url = attachment['attributes'].url

                       gallery_ids[my_index] = attachment['id'];
                       my_index++;
                    });
                   
                    var ids = gallery_ids.join(",");
                    if(ids.length === 0) return true;//if closed withput selecting an image
                    jQuery('input#afb_ai_art_default_watermark_img').val(ids);
                    jQuery('#afb-watermark-image').attr("src", $url)
                    // Refresh_Image(ids);
                 });

                image_frame.on('open',function() {
                  // On open, get the id from the hidden input
                  // and select the appropiate images in the media manager
                  var selection =  image_frame.state().get('selection');
                  var ids = jQuery('input#afb_ai_art_default_watermark_img').val().split(',');
                  ids.forEach(function(id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add( attachment ? [ attachment ] : [] );
                  });

                });

              image_frame.open();
});

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id){
  var data = {
      action: 'myprefix_get_image',
      id: the_id
  };

  jQuery.get(ajaxurl, data, function(response) {

      if(response.success === true) {
          jQuery('#afb-preview-image').replaceWith( response.data.image );
      }
  });
}
</script>