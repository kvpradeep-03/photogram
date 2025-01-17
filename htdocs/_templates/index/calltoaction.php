<!--Album Example section-->
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <?//Session::getUser() is setted an user class instance in that we accessing username by getter/setter funnction.?>
        <h1 class="fw-light">What are you upto, <?=(Session::getUser()->getUsername());?></h1>
        <p class="lead text-body-secondary">Share a photo that talks about it.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Upload</a>
          <a href="#" class="btn btn-secondary my-2">Clear</a>
        </p>
      </div>
    </div>
  </section>
  
 