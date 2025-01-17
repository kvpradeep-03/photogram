<?php

//TODO:Redirect to requested URL instead of basepath on login
$user = $_POST['username'] ?? null;
$pass = $_POST['password'] ?? null;

//authorization is done in webAPI class
if ($user && $pass) {
    $result = User::login($user, $pass);
    if ($result) {
        if (UserSession::authenticate($user, $pass)) {
            ?>
                <script>
                    window.location.href = "<?=get_config('base_path')?>"
                </script>
            <?php
        }  
    } else {
      ?>
      <main class="container">
          <div class="bg-body-tertiary p-5 rounded mt-3">
              <h1>Login failed :( </h1>
              <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>login.php">Login Again</a></p>
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
  </form>
</main>
<?php
}