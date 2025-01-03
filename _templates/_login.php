<?php

$user = $_POST['username'] ?? null;
$pass = $_POST['password'] ?? null;
Session::set('mode','web');

if (isset($_GET['logout'])) {
    if (Session::isset("session_token")) {
        $Session = new UserSession(Session::get("session_token"));
        if ($Session->removeSession()) {
            echo "<h3> Pervious Session is removing from db </h3>";
        } else {
            echo "<h3>Pervious Session not removing from db </h3>";
        }
    }
    Session::destroy();
    die("Session destroyed, <a href=\"" . htmlspecialchars(get_config('base_path')) . "login.php\">Login Again</a>");
}

if ($user && $pass) {
    $result = User::login($user, $pass);

  if ($result) {
      if (Session::isset("session_token")) {
          if (UserSession::authorize(Session::get("session_token"))) {
              ?>
                <main class="container">
                    <div class="bg-body-tertiary p-5 rounded mt-3">
                        <h1>Welcome back <?= htmlspecialchars($result) ?></h1>
                        <p class="lead">Now you can explore the trending clicks!.</p>
                        <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>">explore</a></p>
                        <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>login.php">logout</a></p>
                    </div>
                </main>
              <?php
          } else {
              Session::destroy();
              ?>
              <main class="container">
                  <div class="bg-body-tertiary p-5 rounded mt-3">
                      <h1>Session not Found -_- </h1>
                      <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>login.php">Login Again</a></p>
                  </div>
              </main>
              <?php
          }
      } else {
          if (UserSession::authenticate($user, $pass)) {
              ?>
              <main class="container">
                  <div class="bg-body-tertiary p-5 rounded mt-3">
                      <h1>Login successful <?= htmlspecialchars($result) ?></h1>
                      <p class="lead">Now you can explore the trending clicks!.</p>
                      <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>">explore</a></p>
                      <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>login.php">logout</a></p>
                  </div>
              </main>
              <?php
          } else {
              ?>
              <main class="container">
                  <div class="bg-body-tertiary p-5 rounded mt-3">
                      <h1>Login failed -_- </h1>
                      <p class="lead"><a href="<?= htmlspecialchars(get_config('base_path')) ?>login.php">Login Again</a></p>
                  </div>
              </main>
              <?php
          }
      }
  } else {
      ?>
      <main class="container">
          <div class="bg-body-tertiary p-5 rounded mt-3">
              <h1>Login failed -_- </h1>
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
    <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
  </form>
</main>
<?php
}