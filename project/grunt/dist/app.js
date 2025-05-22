/*Processed by SNA labs on Last Sync: 21/5/2025 @ 17:34:41*/
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
    console.log(post_id);
    $.post('/api/posts/like', {
        id: post_id
    }, function (data, textSuccess, xhr) {
        console.log("like")
         console.log(textSuccess);
         console.log(data);
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
$(document).on('click', '.btn-delete', function () {
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
                            }, 200); // Delay optional
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
});

// $(document).ready(function(){
//     // dialog("Notify","Page Loaded");

//     $.get('/api/demo/modal',function(data,textStatus,xhr){
//         $('main').html(data);
//     })
// });

$('#liveToastBtn').click(function(){
    var el = $('#liveToast').get(0); // Get the native DOM element
    var toast = new bootstrap.Toast(el, { delay: 3000 }); // Set delay to 3 seconds
    toast.show(); // Show the toast
});
//# sourceMappingURL=app.js.map