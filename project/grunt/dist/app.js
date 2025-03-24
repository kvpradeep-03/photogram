/*Processed by SNA labs on Last Sync: 24/3/2025 @ 10:8:23*/
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