// init Masonry
var $grid = $('#masonry-area').masonry({
    // itemSelector: '.col',
    // columnWidth: '.col',
    percentPosition: true
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress(function () {
    $grid.masonry('layout');
});

$(document).on('click', '.album .btn-like', function () {
    post_id = $(this).parent().attr('data-id');
    $this = $(this);
    $(this).html() == "Like" ? $(this).html("Liked") : $(this).html("Like");
    $(this).hasClass('btn-outline-primary') ? $(this).removeClass('btn-outline-primary').addClass('btn-primary') : $(this).removeClass('btn-primary').addClass('btn-outline-primary');
    $.post('/api/posts/like', {
        id: post_id
    }, function (data, textSuccess, xhr) {
        if (textSuccess == "success") {
            if (data.liked) {
                $($this).html("Liked");
                $($this).removeClass('btn-outline-primary').addClass('btn-primary');
            } else {
                $($this).html("Like");
                $($this).removeClass('btn-primary').addClass('btn-outline-primary');
            }
        }
    });
});


//delete post
$('.btn-delete').on('click', function () {
    var post_id = $(this).parent().attr('data-id');
    d = new Dialog("Delete Post", "Are you sure want to remove this post");
    d.setButtons([
        {
            'name': "Delete",
            "class": "btn-danger",
            "onClick": function (event) {
                console.log(`Assume this post ${post_id} is deleted`);
                // $(`#post-${post_id}`).remove();

                $.post('/api/posts/delete',
                    {
                        id: post_id
                    }, function (data, textSuccess, xhr) {
                        // console.log(textSuccess);
                        // console.log(data);

                        if (textSuccess == "success") { //means 200
                            $(`#post-${post_id}`).remove();
                            // Refresh the page
                            setTimeout(function () {
                                location.reload();
                            }, 500); // Delay optional
                        }
                    });

                $(event.data.modal).modal('hide')
            }
        },
        {
            'name': "Cancel",
            "class": "btn-secondary",
            "onClick": function (event) {
                $(event.data.modal).modal('hide');
            }
        }
    ]);
    d.show();
    // Redirect to avoid form resubmission
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
});
