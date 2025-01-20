<?php

$login_page = true;   //like controller of a page, once authenticated it sets to false.

//TODO: Redirect to a requested URL instead of base path on login
if (isset($_POST['username']) and isset($_POST['password'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $result = UserSession::authenticate($user, $pass);
  $login_page = false;
}

//authorization is done in webAPI class
if (!$login_page) {
  if ($result) {
    $should_redirect = Session::get('_redirect');
    $redirect_to = get_config('base_path');
    if(isset($should_redirect)){
      $redirect_to = $should_redirect;
      Session::set('_redirect', false);
    }
    ?>
      <script>
      window.location.href = "<?=$redirect_to ?>"
      </script>
    <?php
} else {//TODO:fix error div ui at darkmode.
  ?>
    <main class="container">
      <div class="bg-light p-5 rounded mt-3">
      <h1>Login Failed</h1>
      <p class="lead">Please <a href="/login.php">try again</a></p>
      </div>
    </main>
  <?php
}
} else {
  ?>
  <main class="form-login w-100 m-auto">
    <form action="login.php" method="post">
      <img class="mb-4" src="https://cdn-icons-png.flaticon.com/128/10401/10401230.png" alt="" width="100" height="87">
      <h1 class="h3 mb-3 fw-normal">Please login</h1>

      <div class="form-floating">
                  <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                  <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
                  <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button class="btn btn-primary w-100 py-2 hvr-wobble-vertical" type="submit">log in</button>
      <a href="/signup.php" class="w-100 btn btn-link">Not registered? sign up</a>
    </form>
  </main>
  <?php
}