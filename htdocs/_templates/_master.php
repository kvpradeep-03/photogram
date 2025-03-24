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
    <div id="modalsGarbage">
      <div class="modal fade animate__animated" id="dummy-dialog-modal" tabindex="-1" role="dialog" aria-labelledby=""
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content blur" style="box-shadow: rgba(3, 102, 214, 0.3) 0px 0px 0px 3px">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
	</div>


    <script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.o.js"></script>


  </body>
</html>

