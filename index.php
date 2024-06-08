<?php

include 'libs/load.php';

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  
  <?php
  load_template('_head');
  ?>

  <body>
    <?php
    load_template('_header');
    ?>

    <main>

      <?php
      load_template('_calltoaction');
      ?>

      <?php
      load_template('_photogram');
      ?>

    </main>

    <?php
    load_template('_togglebar');
    load_template('_footer');
    ?>

    <script src="/photogram/app/assets/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
