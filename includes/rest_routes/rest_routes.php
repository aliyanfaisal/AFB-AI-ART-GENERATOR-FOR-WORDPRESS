<?php


add_action('rest_api_init', function () {
    register_rest_route(
        'afb/v1',
        '/get-s3-url',
        array(
            'methods' => 'POST',
            'callback' => 'getS3Url',
            'permission_callback' => '__return_true',
        )
    );


    register_rest_route(
        'afb/v1',
        '/get-order',
        array(
            'methods' => 'POST',
            'callback' => 'getOrderDetails',
            'permission_callback' => '__return_true',
        )
    );
	
    register_rest_route(
        'afb/v1',
        '/create-s3-order',
        array(
            'methods' => 'POST',
            'callback' => 'createOrderx',
            'permission_callback' => '__return_true',
        )
    );
	
});


// Permission callback function
function getS3Url()
{
	ini_set('display_errors', 1);
        error_reporting(E_ALL);
    $data = $_POST;
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://api.neural.love/v1/upload', [
        'body' => '{"extension":"' . $data['fileExtension'] . '","contentType":"' . $data['mimeType'] . '","batchId":"1a52371a11728fba278c9878c8c5b9728fba2788e4628fba278c8c5b98e46218"}',
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . NUERAL_API_KEY,
            'content-type' => 'application/json',
        ],
    ]);


    $response = new \WP_REST_Response($response->getBody(), 200);


    $s3Url = json_decode($response->get_data());

//     print_r($s3Url); exit;
//     echo "<br><br>";
    // print_r($_FILES['image']["tmp_name"]);
    // echo " <hr> ". $data['mimeType'] ."   ||  ". $data['fileExtension'];

    if (isset($s3Url->url)) {

        $upload = uploadImage($s3Url->url, $_FILES['image']);

        if ($upload) {
			
//             $order = createOrderx($s3Url);
//             echo $order;
            echo json_encode($s3Url);
            exit;
        } else {

            echo json_encode(["failed" => "upload fail"]);
            exit;
        }

    } else {

        echo json_encode(["failed" => "no url"]);
        exit;
    }
}






function getOrderDetails()
{
	
    $orderID = isset($_POST['order_id']) ? $_POST['order_id'] : "";

    if ($orderID != "") {

		try{
			
		
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.neural.love/v1/ai-art/orders/' . $orderID, [
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer ' . NUERAL_API_KEY,
            ],
        ]);

        $response->getBody();

        $order = json_decode($response->getBody());
		}
		catch(Exception $e){
			$error= json_decode($e->getResponse()->getBody()->getContents());
			echo  json_encode([
				"failed"=>$error->detail
			]);
			exit;
		}
		
		
		try{
		
        if ($order) {

            $imgs = [];
			$waterMarkImgs=[];
			$responseWaterMarkImgs=[];
            ///asdas
            foreach ($order->output as $img_output) {
                $image_url = $img_output->full;

                $upload_img_id = addMediaToWordPress($image_url);
				
				$watermarkImage= afbAddWaterMark($image_url);
				$watermarkImageID = addMediaToWordPress($watermarkImage, true);

                if ($upload_img_id) {

                    $img_url = wp_get_attachment_url($upload_img_id);
                    $imgs[] = $img_url;
					
                }
				
				if ($watermarkImageID) {

                    $waterMarkImgURL = wp_get_attachment_url($watermarkImageID);
                    $waterMarkImgs[] = [
						$waterMarkImgURL,
						$watermarkImageID
					];
					
					
					$responseWaterMarkImgs[]= $waterMarkImgURL;
                }
            }

// 			print_r($waterMarkImgs); exit;
			
            if (count($imgs) > 0) {

                $image_name = basename($imgs[0]);
                $image_caption = $order->output[0]->caption;

                //add a product in woocommerce for this
                $product_id = afbAddWooProduct($imgs, $image_name, $image_caption,$waterMarkImgs);


                echo json_encode([
                    "images" => $responseWaterMarkImgs,
                    "product_id" => $product_id
                ]);
                exit;

            } else {
                echo json_encode(["failed" => 'Still processing, try again in a short while!']);
                exit;
            }
        } else {
            echo json_encode(["failed" => 'Failed getting image data, try again!']);
            exit;
        }
		}
		catch(Exception $e){
			echo json_encode(["failed" => $e->getMessage()]);
            exit;
		}
    } else {
        echo json_encode(["failed" => 'Fatal Error']);
            exit;
    }
}






function createOrderx()
{
	$s3Url= $_POST;
// 	print_r($s3Url['s3Url']); exit;
// ini_set('display_errors', 1);
//         error_reporting(E_ALL);

	try{
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://api.neural.love/v1/ai-art/generate', [
        'body' => '{
            "style":"' . (get_option('afb_ai_art_style') == "" ? get_option('afb_ai_art_style') : "PAINTING") . '",
            "layout":"' . (get_option('afb_ai_art_layout') == "" ? get_option('afb_ai_art_layout') : "SQUARE") . '",
            "amount":' . (get_option('afb_ai_art_layout') == "" ? get_option('afb_ai_art_layout') : "1") . ',
            "isPublic":true,
            "isPriority":false,
            "isHd":false,
            "steps":25,
            "cfgScale":7.5,
            "prompt":"' . (get_option('afb_ai_art_prompt') == "" ? get_option('afb_ai_art_prompt') : "") . '",
            "imageUrl":"' . $s3Url['s3Url'] . '"
        }',
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . NUERAL_API_KEY,
            'content-type' => 'application/json',
        ],
    ]);

		 echo $response->getBody();
	}
	catch(Exception $e){
		
		$error= json_decode($e->getResponse()->getBody()->getContents());
		echo  json_encode([
			"failed"=>$error
		]);
	}
   
}


function uploadImage($s3Url, $image)
{

    $preSignedUrl = $s3Url;

    $imagePath = $image['tmp_name'];

    // echo "FILE: ".fopen($imagePath, 'r')." <hr> ";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $preSignedUrl);
    curl_setopt($ch, CURLOPT_PUT, 1);
    curl_setopt($ch, CURLOPT_INFILE, fopen($imagePath, 'r'));
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($imagePath));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false) {

        echo curl_error($ch);
        return false;
    } else {
        return true;
    }




}



function addMediaToWordPress($image_url, $isBase64=false)
{

	$extension="png";
	if($isBase64){
		$base64ImageData = $image_url;

		// Decode the base64 data
		$binaryImageData = base64_decode($base64ImageData);

		if ($binaryImageData !== false) {
			// Create a temporary file
			$tempFilePath = tempnam(sys_get_temp_dir(), 'temp_image');
			file_put_contents($tempFilePath, $binaryImageData);

			// Get the file extension using the finfo extension
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $tempFilePath);
			finfo_close($finfo);

			// Determine the file extension based on the MIME type
			$extensions = [
				'image/jpeg' => 'jpg',
				'image/png'  => 'png',
				'image/gif'  => 'gif',
				// Add more MIME types and extensions as needed
			];

			$extension = isset($extensions[$mime]) ? $extensions[$mime] : 'png';

			// Remove the temporary file
			unlink($tempFilePath);

		}

	}
	else{
		$extension = strtok($image_url, '?');
    	$extension = pathinfo($extension, PATHINFO_EXTENSION);
	}

    
    // Get the file name from the URL
    $image_name = "AI_ART_IMG_" . time() . "." . $extension;
	
	
    // Fetch the image data
    $image_data="";
    if($isBase64){
		$image_data=base64_decode($image_url);
	}
	else{
		$image_data = file_get_contents($image_url);
	}
    


    // Upload directory details
    $upload_dir = [];
	$upload_dir['path']= ABSPATH."/wp-content/uploads/woocommerce_uploads";
	
    $image_path = $upload_dir['path'] . '/' . $image_name;

    // Upload the image
    if (wp_mkdir_p($upload_dir['path'])) {
		
        file_put_contents($image_path, $image_data);

        // Create a unique filename to prevent conflicts
        $unique_filename = wp_unique_filename($upload_dir['path'], $image_name);

        // Move the uploaded file to a unique location
        $unique_image_path = $upload_dir['path'] . '/' . $unique_filename;
        
		
		rename($image_path, $unique_image_path);
		$attachment = [
// 			'guid' => $upload_dir['url'] . '/' . $unique_filename,
            'post_mime_type' => 'image/jpeg',
            // Adjust mime type if needed
            'post_title' => sanitize_file_name($unique_filename),
            'post_content' => '',
            'post_status' => 'inherit'
        ];

        // Insert the image into the media library
        $attach_id = wp_insert_attachment($attachment, $unique_image_path);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $unique_image_path);
        wp_update_attachment_metadata($attach_id, $attach_data);

        return $attach_id;
        // return $upload_dir['url'] . '/' . $unique_filename;
    }

    return false; // Return false if upload fails


}






function afbAddWooProduct($image_url, $image_name, $image_caption,$watermarkImg)
{

// 	$approved_download_directories = get_option('woocommerce_file_download_paths', array());

// 	print_r($approved_download_directories); exit;
    $category_id = get_option('afb_ai_art_product_category');
    $product_img = get_option('afb_ai_art_default_product_img');
    $price = get_option("afb_ai_art_price") == "" ? 10 : get_option("afb_ai_art_price");

    // Create a new product object
    $new_product = new WC_Product_Simple();

    // Set product data
    $new_product->set_name("AI ART {$image_name} ");
    $new_product->set_description($image_caption);
    $new_product->set_status('publish');
    $new_product->set_regular_price($price);
    // $new_product->set_sale_price('80.00');
    $new_product->set_downloadable(true);
    $new_product->set_virtual(true);

    if ($category_id != "") {
        $current_categories = wp_get_post_terms($new_product->get_id(), 'product_cat', array('fields' => 'ids'));

        // Add the new category ID
        $current_categories[] = $category_id;

        // Set the categories for the product
        wp_set_post_terms($new_product->get_id(), $current_categories, 'product_cat');

    }
    if (isset($watermarkImg[0][1])) {
        $new_product->set_image_id($watermarkImg[0][1]);
    }
	elseif($product_img!=""){
		$new_product->set_image_id($watermarkImg[0][1]);
	}
    // Set downloadable files
    $download_files = [];
	
	foreach($image_url as $key=>$d_img){
		$download_files[]= array(
            'name' => $image_name."_".$key,
            'file' => $d_img,
        );
	}
	
    $new_product->set_downloads($download_files);

    // Save the product
    $new_product->save();

    return $new_product->get_id();

}



function afbAddWaterMark($mainImageUrl){
	
	
	// Load the main image and watermark image
	$watermarkImageUrl = AFB_ART_GEN_WATERFALL;
	
	$imagePath = $mainImageUrl;
$watermarkPath = $watermarkImageUrl;

// Create an Imagick object for the main image
$image = new Imagick($imagePath);

// Create an Imagick object for the watermark image
$watermark = new Imagick($watermarkPath);

// Get the dimensions of the main image
$imageWidth = $image->getImageWidth();
$imageHeight = $image->getImageHeight();

// Get the dimensions of the watermark image
$watermarkWidth = $watermark->getImageWidth();
$watermarkHeight = $watermark->getImageHeight();

// Calculate the position to overlay the watermark (centered)
$positionX = ($imageWidth - $watermarkWidth) / 2;
$positionY = ($imageHeight - $watermarkHeight) / 2;

// Composite the watermark onto the main image
$image->compositeImage($watermark, Imagick::COMPOSITE_OVER, $positionX, $positionY);

// Get the image data as binary
$imageData = $image->getImageBlob();

// Convert the binary data to base64
$base64Image = base64_encode($imageData);

// Clean up resources
$image->clear();
$image->destroy();
$watermark->clear();
$watermark->destroy();

return $base64Image;

	
	
	
	
	
	
	
	
	
	
// 	// Get the image type
// 	$imageInfo = getimagesize($mainImageUrl);
// 	$imageType = $imageInfo[2];

// 	// Load the source image based on its type
// 	switch ($imageType) {
// 		case IMAGETYPE_JPEG:
// 			$mainImage = imagecreatefromjpeg($mainImageUrl);
// 			break;
// 		case IMAGETYPE_PNG:
// 			$mainImage = imagecreatefrompng($mainImageUrl);
// 			break;
// 		case IMAGETYPE_GIF:
// 			$mainImage = imagecreatefromgif($mainImageUrl);
// 			break;
// 		// Add more cases for other image types if needed
// 		default:
// 			return ("Unsupported image format.");
// 	}
	
	
	
// 		// Get the image type
// 	$watermarkImageUrlInfo = getimagesize($watermarkImageUrl);
	
	
// 	$watermarkImageUrlType = $watermarkImageUrlInfo[2];
// $watermarkImage="";
// 	// Load the source image based on its type
// 	switch ($watermarkImageUrlType) {
// 		case IMAGETYPE_JPEG:
// 			$watermarkImage = imagecreatefromjpeg($mainImageUrl);
// 			break;
// 		case IMAGETYPE_PNG:
			
// 			$watermarkImage = imagecreatefrompng($mainImageUrl);
// 			break;
// 		case IMAGETYPE_GIF:
// 			$watermarkImage = imagecreatefromgif($mainImageUrl);
// 			break;
// 		// Add more cases for other image types if needed
// 		default:
// 			return ("Unsupported image format.");
// 	}


// 	print_r( $watermarkImage); exit;
	
// 	// Get the dimensions of the images
// 	$mainWidth = imagesx($mainImage);
// 	$mainHeight = imagesy($mainImage);
// 	$watermarkWidth = imagesx($watermarkImage);
// 	$watermarkHeight = imagesy($watermarkImage);

// 	// Calculate the position to place the watermark (e.g., bottom right corner)
// 	$positionX = $mainWidth - $watermarkWidth - 10; // Adjust as needed
// 	$positionY = $mainHeight - $watermarkHeight - 10; // Adjust as needed

// 	// Merge the images
// 	imagecopy($mainImage, $watermarkImage, $positionX, $positionY, 0, 0, $watermarkWidth, $watermarkHeight);

// 	// Save the resulting image to a buffer
// 	ob_start();
// 	imagejpeg ($mainImage);
// 	$imageData = ob_get_clean();

// 	// Convert the image data to base64
// 	$base64Image = base64_encode($imageData);


// 	// Clean up
// 	imagedestroy($mainImage);
// 	imagedestroy($watermarkImage);
	
// 	return $base64Image;

}
