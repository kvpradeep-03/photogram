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
