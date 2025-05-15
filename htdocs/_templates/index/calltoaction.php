<?php

ob_start(); // Start output buffering

if(isset($_POST['post_text']) and isset($_FILES['post_image'])) {
    $img_tmp = $_FILES['post_image']['tmp_name'];    // post_image-> will ne tne name give at form field, tmp_name-> Temporary file path ,php stores the file in a temporary location until it is moved to the desired location.
    $text = $_POST['post_text'];

    Post::registerPost($text, $img_tmp);

    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['REQUEST_URI']);	//temp fix , for permanent fix remove html whitespace or php echos at scripts.
    exit;


    ob_end_flush(); // Send output

}
?>

<!--Album Example section-->
<section class="py-5 text-center container" style="background-color:#010001">
	<div class="row py-lg-5" style="background-color:#010001">
		<form action="/" method="post" enctype="multipart/form-data">
			<div class="col-lg-6 col-md-8 mx-auto">
				<?//Session::getUser() is setted an user class instance in that we accessing username by getter/setter funnction.?>
				<h1 class="fw-light">What are you upto,
					<?=(Session::getUser()->getUsername());?>
				</h1>
				<p class="lead text-body-secondary">Share a photo that talks about it.</p>
				<textarea id="post_text" style="background-color:#010100" class="form-control" name="post_text" placeholder="What are you upto?" rows="3"></textarea>
				<div class="input-group mb-3">
					<input type="file" style="background-color:#010100" class="form-control" accept="image/*" name="post_image" id="inputGroupFile02">
					<!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
				</div>
				<p>
					<button class="btn btn-primary my-2">Upload</button>
					<!-- <a href="#" class="btn btn-secondary my-2">Clear</a> -->
				</p>
			</div>
		</form>
	</div>
</section>