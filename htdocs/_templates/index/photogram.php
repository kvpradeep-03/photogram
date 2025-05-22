<!--main post section-->
<div class="album py-5" style="background-color:#010001;">
	<div class="container" style="background-color:#010001;">

		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-2 " id="masonry-area">
			<?php
          $posts = Post::getAllPosts();
			use Carbon\Carbon;

			foreach ($posts as $post) {
			    $p = new Post($post['id']);
			    $uploaded_time = Carbon::parse($p->getUploadedTime());
			    $uploaded_time_str = $uploaded_time->diffForHumans()

			    ?>

			<div class="col"
				id="post-<?=$post['id']?>">
				<div class="card shadow-sm">
					<div class="card-header" style="background-color:#010001; padding-top: 15px; padding-bottom: 15px;">
						<span
							class="badge bg-info-subtle border border-info-subtle text-info-emphasis rounded-pill"><?="@".$p->getOwner()?></span>

					</div>
					<img src="<?=$p->getImageUri()?>">
					<div class="card-body" style="background-color:#010001;">
						<p class="card-text text-white" style="color:#f4f4f4">
							<?=$p->getPostText()?></p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="btn-group"
								data-id="<?=$post['id']?>">
								<button type="button" class="btn btn-sm btn-outline-primary btn-like"
									style="color:#f4f4f4">Like</button>
								<!-- <button type="button" class="btn btn-sm btn-outline-success">Share</button> -->
								<?php
			              if(Session::isOwnerOf($p->getOwner())) {
			                  ?>
								<button type="button" class="btn btn-sm btn-outline-danger btn-delete"
									style="color:#f4f4f4">Delete</button>
								<?php
			              }?>
							</div>
							<small
								class="text-body-secondary"><?= $uploaded_time_str?></small>
						</div>
					</div>
				</div>
			</div>

			<?php
			}
			?>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.album').imagesLoaded(function() {
			console.log('All images are loaded');
      
		});
	});
</script>