/*Processed by SNA labs on Last Sync: 31/3/2025 @ 12:12:22*/
// init Masonry
var $grid = $('#masonry-area').masonry({
  // itemSelector: '.col',
  // columnWidth: '.col',
  percentPosition: true
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});

//delete post
$('.btn-delete').on('click', function(){
  var post_id = $(this).parent().attr('data-id');
  d = new Dialog("Delete Post", "Are you sure want to remove this post");
  d.setButtons([
      {
          'name': "Delete",
          "class": "btn-danger",
          "onClick": function(event){
              console.log(`Assume this post ${post_id} is deleted`);
              // $(`#post-${post_id}`).remove();
              
              $.post('/api/posts/delete',
              {
                  id: post_id
              }, function(data, textSuccess, xhr){
                  console.log(textSuccess);
                  console.log(data);

                  if(textSuccess =="success" ){ //means 200
                      $(`#post-${post_id}`).remove();
                  }
              });

              $(event.data.modal).modal('hide')
          }
      },
      {
          'name': "Cancel",
          "class": "btn-secondary",
          "onClick": function(event){
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