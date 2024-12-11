<?php

include 'libs/load.php';

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<!--hover.css CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" integrity="sha512-SJw7jzjMYJhsEnN/BuxTWXkezA2cRanuB8TdCNMXFJjxG9ZGSKOX5P3j03H6kdMxalKHZ7vlBMB4CagFP/de0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <?php
  load_template('_head'); 
  ?>

  <body>

    <header> 
      <?php
      load_template('_header');
      ?>
    </header>

    <main>

      <?php
      load_template('_signup');
      ?>
 
    </main>

    <?php
    load_template('_togglebar');
    load_template('_footer');
    ?>

    <script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
