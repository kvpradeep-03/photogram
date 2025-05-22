<?php

ob_start(); // Start output buffering

$toastMsg = '';
$toastType = 'danger';

ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
ini_set('memory_limit', '128M');

if(isset($_POST['post_text']) and isset($_FILES['post_image'])) {
    $img_tmp = $_FILES['post_image']['tmp_name'];
    $text = $_POST['post_text'];
    $error = $_FILES['post_image']['error'];

    // Check for upload errors
    if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
        $toastMsg = "Image is too large. Please upload a smaller file.";
    } elseif ($error !== UPLOAD_ERR_OK) {
        $toastMsg = "Image upload failed.";
    } elseif (!is_uploaded_file($img_tmp) || empty($img_tmp)) {
        $toastMsg = "Image upload failed or no file selected.";
    } else {

        Post::registerPost($text, $img_tmp);
        // Redirect to avoid form resubmission and show toast
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;


    }

    ob_end_flush(); // Send output
}

?>

<!-- Toast Notification at the top of the page -->
<?php if (!empty($toastMsg)): ?>
<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0  p-3" style="z-index: 9999">
	<div class="toast align-items-center text-bg-<?= $toastType ?> border-0 show"
		role="alert" aria-live="assertive" aria-atomic="true">
		<div class="d-flex">
			<div class="toast-body">
				<?= htmlspecialchars($toastMsg) ?>
			</div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
				aria-label="Close"></button>
		</div>
	</div>
</div>
<script>
	var toastElList = [].slice.call(document.querySelectorAll('.toast'))
	toastElList.map(function(toastEl) {
		var toast = new bootstrap.Toast(toastEl)
		toast.show()
	})
</script>
<?php endif; ?>

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
				<textarea id="post_text" style="background-color:#010100" class="form-control" name="post_text"
					placeholder="What are you upto?" rows="3"></textarea>
				<div class="input-group mb-3">
					<input type="file" style="background-color:#010100" class="form-control" accept="image/*"
						name="post_image" id="inputGroupFile02">
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