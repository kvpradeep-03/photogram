<!-- Purpose: Master template for the website. -->

<!doctype html>
<html lang="en">

<?php
  Session::loadTemplate('_head');
?>

<style>
  body {
    background-color:
      #010100;
  }
</style>

<body>

  <header>
    <?php
    Session::loadTemplate('_header');
?>
  </header>

  <main class="height:100vh" style="background-color:#010001">

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

  <!-- This is used as dummy to clone further dialog -->
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




  <!--jquery CDN-->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!--imagesloaded CDN-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>

  <!--mansory cdn-->
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  <script
    src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js">
  </script>

  <script src="/js/app.o.js"></script>
  <script src="/js/dialog.js"></script>
  <script src="/js/toast.js"></script>



</body>

</html>