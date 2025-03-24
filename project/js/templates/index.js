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