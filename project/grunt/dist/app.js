/*Processed by SNA labs on Last Sync: 24/3/2025 @ 3:31:32*/
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
//# sourceMappingURL=app.js.map