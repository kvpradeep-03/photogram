<!-- Purpose: Master template for the website. -->

<!doctype html>
<html lang="en" data-bs-theme="auto">
    
  <?php
  Session::loadTemplate('_head');
  ?>
 
  <body>

    <header> 
      <?php
      Session::loadTemplate('_header');
      ?>
    </header>

    <main>

      <?php
      // Load the request page ,by calling the currentScript method of the Session class which returns basename.
      //Session::loadTemplate(Session::currentScript());
      
        Session::loadTemplate(Session::currentScript());
        
      ?>
 
    </main>

    <?php
    Session::loadTemplate('_togglebar');
    Session::loadTemplate('_footer');
    ?>

    <script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.o.js"></script>


  </body>
</html>

