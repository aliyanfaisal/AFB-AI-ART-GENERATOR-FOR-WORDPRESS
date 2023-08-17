<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typeface-poppins@1.1.13/index.min.css">
<style>
    .p__5 {
        padding: 50px 30px;
    }

    .afb-container {
        max-width: 100% !important;
    }

    .b_grey {
        background-color: #dddd;
    }

    .afb-header .afb-title {
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        /* width: 100%; */
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        font-weight: 700;
        font-size: 4rem;
        line-height: 1.3;
        text-align: center;
        max-width: 700px;
        margin: auto
    }

    .afb-upload-card {
        max-width: 500px;
        border-radius: 20px;
        box-shadow: 0px 0px 6px 2px #b5b5b5 !important;
        width: 100%;
        text-align: center;
        padding: 40px 20px;
        background-color: white;
        margin-top: 30px
    }

    .afb_row {
        display: flex;
        flex-wrap: wrap;
        max-width: 95% !important;
        margin: auto;
    }

    .afb_first .img_container {
        min-height: 450px;
        border: 2px solid #ffffff;
        width: 100%;
        /* background-color: #dddddd; */
        display: flex;
        /* flex-direction: column; */
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .afb_row>.afb_first {
        flex: 0 45%;
        max-width: 45%;
        display: flex;
    }

    .afb_row>.afb_second {
        flex: 0 55%;
        max-width: 55%;
    }

    .afb_second {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .img_container,
    .img_container img,
    .prev_img {
        border-radius: 10px;
        box-shadow: 0px 0px 4px -2px #fff;
        width: 100%;
    }

    .img_container img,
    .prev_img {
        max-width: 350px;
        margin: 10px 12px
    }

    .img_upload_btn {
        margin: 15px 0px;
        padding: 12px 40px;
        border-radius: 10px;
        background-color: #111111;
        color: white
    }

    #img_upload_submit , #afb_call_login{
        background-color: #023bd8;
    }

    #img_upload_download {
        background-color: #4602d8;
    }

    .downloadButton {
        background-color: darkorange
    }

    #img_upload_btn:hover {
        background-color: white;
        color: #111111;
        border: 1px solid grey
    }

    .loading_btn_{
        background-color: #d80202 !important;
    }


    /* Style for the progress container */
    .progress {
        width: 100%;
        height: 20px;
        background-color: #f0f0f0;
        border-radius: 5px;
        margin-top: 10px;
    }

    /* Style for the progress bar */
    .progress-bar {
        height: 100%;
        background-color: #191919;
        border-radius: 5px;
        width: 0;
        transition: width 0.3s;
    }




    @media (max-width: 768px) {
        .afb_row {
            flex-direction: column-reverse;
        }

        .afb_row>.afb_first {
            flex: 0 100%;
            max-width: 100%;
        }

        .afb_row>.afb_second {
            flex: 0 100%;
            max-width: 100%;
        }

        .afb-header .afb-title {
            font-size: 3rem;
        }

        .afb-upload-card {
            width: 90%;
        }

        .afb_first {
            margin-top: 30px;
        }
    }
</style>

<section class="afb_row p__5 b_grey">
    <section class="afb_first">
        <div class="img_container">
            <img src="" id="img_uploaded" alt="">
            <!-- <img src="" id="img_generated" alt=""> -->

            <!-- <canvas id="prev_img"></canvas> -->
        </div>
    </section>

    <section class="afb-container afb_second">
        <div class="afb-header">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <h2 class="afb-title">Lag kunst av ditt kjæledyr med DyrekunstAI</h2>
        </div>

        <div class="afb-upload-card">
            <div>
                <svg class="d-inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16" height="16mm" width="22mm"
                    data-v-0f3bcab4="">
                    <path
                        d="M.787 6.411l10.012 5.222a.437.437 0 0 0 .402 0l10.01-5.222a.434.434 0 0 0 .186-.585.45.45 0 0 0-.186-.187L11.2.417a.441.441 0 0 0-.404 0L.787 5.639a.439.439 0 0 0-.184.588.453.453 0 0 0 .184.184z"
                        fill="#DDDFE1" data-v-0f3bcab4=""></path>
                    <path
                        d="M21.21 9.589l-1.655-.864-7.953 4.148a1.31 1.31 0 0 1-1.202 0L2.444 8.725l-1.657.864a.437.437 0 0 0-.184.583.427.427 0 0 0 .184.187l10.012 5.224a.437.437 0 0 0 .402 0l10.01-5.224a.434.434 0 0 0 .186-.586.444.444 0 0 0-.186-.184z"
                        fill="#EDEFF0" data-v-0f3bcab4=""></path>
                </svg>

            </div>

            <form action="" method="post" id="img_upload_form">
                <input required name="_image" type="file" hidden id="img_upload_field">
                <input type="text" id="product_id" hidden>
                <div>
                    <button class="img_upload_btn" id="img_upload_btn">Velg Bilde</button>
                    <button class="img_upload_btn <?php echo is_user_logged_in() ? "":"afb_call_loginx"; ?>" id="<?php echo is_user_logged_in() ? "img_upload_submit":"afb_call_loginx"; ?>">Last Opp Bilde</button>
                    <button class="img_upload_btn" id="img_upload_download">Lag AI Bilde</button>
                    <button class="img_upload_btn downloadButton" id="downloadButton">Last Ned Bilde med Vannmerke</button>
                    <button class="img_upload_btn downloadButton" id="buyButton">Kjøp Bilde Uten Vannmerke</button>

                </div>
            </form>

        </div>

    </section>

</section>


<script>
    var s3Url = {};
    var afbBaseUrl = '<?php echo rest_url("afb/v1"); ?>'

    var fileName = "";
    var fileExtension = ""
    var mimeType = ""
    var orderId = ""

    console.log("rest url", '<?= AFB_ART_GEN_WATERFALL; ?>')


    jQuery(function ($) {
        $(".progress").hide()
        $("#img_upload_download").hide()
        $("#img_upload_submit").hide()
        $(".downloadButton").hide()


        /**
         * 
         * BIND EVENTS 
         */
        $(document).on("change", "#img_upload_field", function () {
            var input = this;

            // Ensure that a file is selected
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {

                    $("#img_uploaded").attr("src", e.target.result)
					
                    if (e.target.result != "") {
                        $("#img_upload_submit").show()
                    }
                    // $('#img_upload_form').submit()

                };

                // Read the selected file as a data URL
                reader.readAsDataURL(input.files[0]);
            }

        })

        $("#img_upload_btn").click(function (e) {
            e.preventDefault()
            $("#img_upload_field").click()

            $("#img_upload_download").hide()
            $(".downloadButton").hide()


        })


        $('#img_upload_form').submit(function (e) {

            e.preventDefault();

            $("#img_upload_submit").hide()


            getS3Url()

        })


        $("#img_upload_download").click(function (e) {

            e.preventDefault()
            getOrderDetails()
        })

        $("#buyButton").click(function(e){
            e.preventDefault()
            let prod_id = $("#product_id").val()
            if(prod_id==""){
                alert("Failed fetching Purchase ID, try again")
            }
            else{
                window.open("/?add-to-cart="+prod_id)
            }
           
        })



        function getS3Url() {

            var input = document.querySelector("#img_upload_field")

            fileName = input.files[0].name;
            fileExtension = fileName.split('.').pop();

            // Get MIME type
            mimeType = input.files[0].type;

            if (mimeType != undefined && fileExtension != undefined) {

                let form = document.querySelector("#img_upload_form")
                var formDatax = new FormData(form);
                formDatax.append("image", input.files[0])
                formDatax.append("fileName", fileName)
                formDatax.append("fileExtension", fileExtension)
                formDatax.append("mimeType", mimeType)

                $.post({
                    url: afbBaseUrl + "/get-s3-url",
                    data: formDatax,
                    processData: false, contentType: false,
                    xhr: function () {
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function (event) {
                                $(".progress").show()
                                var percent = (event.loaded / event.total) * 100;
                                $('.progress-bar').css('width', percent + '%');
                                $('.progress-bar').attr('aria-valuenow', percent);
                            });
                        }
                        return xhr;
                    },
                    success: function (data) {
//                         console.log("s# URL", data['orderId'])
                        createOrder(data)
						return false
                        s3Url = data
                        if (data['orderId'] != "") {

                            $("#img_upload_download").show()
                            $("#img_upload_download").addClass("loading_btn_").attr("disabled", true)
                                .html("Prosesserer Bilde...")
                            setTimeout(function () {
                                $("#img_upload_download").removeAttr("disabled").html("Generate Image").removeClass("loading_btn_")
                            }, 10000)


                            orderId = data['orderId']
                        }
                        else {
                            orderId = ""
                            alert("Failed fetching Your Order, try again!")

                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.log("eror", error)
                        alert("Error : "+ error)
                    }

                })
            }
        }

		
		/**
		 * 
		 * 
		 * Create Order
		 *
		 */
		 
		 function createOrder(s3Url){
			 var formDatax = new FormData();
                formDatax.append("s3Url", s3Url.s3Url)
                formDatax.append("url", s3Url.url)

                $.post({
                    url: afbBaseUrl + "/create-s3-order",
                    data: formDatax,
                    processData: false, contentType: false,
                    success: function (data) {
						
						if("failed" in data){
							if(data.failed.status==487){
								createOrder(s3Url)
							}else{
								alert("Error: "+data.failed.detail)
								console.log("Error ", data)
							}
						
						}
						else{
							
                        console.log("Order ", data)
						
                        s3Url = data
                        if (data['orderId'] != "") {

                            $("#img_upload_download").show()
                            $("#img_upload_download").addClass("loading_btn_").attr("disabled", true)
                                .html("Processing Image...")
                            setTimeout(function () {
                                $("#img_upload_download").removeAttr("disabled").html("Generate Image").removeClass("loading_btn_")
                            }, 10000)


                            orderId = data['orderId']
                        }
                        else {
                            orderId = ""
                            alert("Failed fetching Your Order, try again!")

                        }
					 }

                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.log("eror", error)
                        alert("Error : "+ error)
                    }

                })
		 }

        /**
         * 
         * GET ORDER DETAILS
         */
        function getOrderDetails() {
            let order_id = orderId;

            var formData = new FormData();
            formData.append("order_id", order_id)
            $.ajax({
                url: afbBaseUrl + "/get-order",
                type: 'POST',
                data: formData,
                processData: false, contentType: false,
                success: function (response) {
                    try {
                        // Handle success response from the server
                        console.log("Order detail", response)
                        if ('images' in response) {

                            $.each(response.images, function (index, image) {

                                let imageURL = image
                                // $("#img_generated").attr("src", imageURL)

                                showImgWithWaterMark(imageURL)

                            });

                            $("#product_id").val(response.product_id)

                            $(".downloadButton").show()
                        }
                        else if ("failed" in response) {
                            alert("Failed:" + response.failed)
                        }
                        else {

                        }

                    }
                    catch (e) {
                        alert("Failed uploading your image, try again!")
                    }

                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.log("eror", error)
                    alert("Failed uploading your image, try again!")
                }
            });


        }



        /**
         * 
         * SHOW IMAGE WITH WaTERMARK
         * 
         */
        function showImgWithWaterMark($img) {
            const canvas = document.createElement("canvas")
            canvas.classList.add('prev_img');
            const ctx = canvas.getContext('2d');

            const mainImage = new Image();
            mainImage.src = $img;

            const watermarkImage = new Image();
            watermarkImage.src = '<?= AFB_ART_GEN_WATERFALL; ?>';
			console.log("water mark ", watermarkImage)

            mainImage.onload = function () {
                canvas.width = mainImage.width;
                canvas.height = mainImage.height;

                // Draw the main image on the canvas
                ctx.drawImage(mainImage, 0, 0, canvas.width, canvas.height);

//                 // Draw the watermark image on the canvas
//                 ctx.globalAlpha = 0.7; // Adjust the opacity as needed
//                 ctx.drawImage(watermarkImage, canvas.width - watermarkImage.width - 20, canvas.height - watermarkImage.height - 20);
//                 ctx.globalAlpha = 1; // Reset the alpha value

                // Attach click event to the download button
                const downloadButton = document.getElementById('downloadButton');
                downloadButton.addEventListener('click', function (e) {
                    e.preventDefault()
                    const downloadLink = document.createElement('a');
                    downloadLink.href = canvas.toDataURL('image/jpeg'); // You can change the format if needed
                    downloadLink.download = 'watermarked_image.jpg'; // Change the filename as needed
                    downloadLink.click();
                    return false
                });

            };


            document.querySelector(".img_container").appendChild(canvas)

        }

    })




</script>