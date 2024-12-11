<?php

$username = $_POST['email'];
$password = $_POST['password'];

$result = User::login($email,$pass);;

if($result){
    ?>
    <main class="container">
        <div class="bg-body-tertiary p-5 rounded mt-3">
            <h1>Login Success</h1>
            <p class="lead">Now you can explore the trending clicks!.</p>
            <p class="lead"><a href="/photogram/app">here</a></p>
        </div>
    </main>
    <?
} else {

?>

<main class="form-login w-100 m-auto">
  <form action="login.php" method="post">
    <img class="mb-4" src="https://cdn-icons-png.flaticon.com/128/10401/10401230.png" alt="" width="100" height="87">
    <h1 class="h3 mb-3 fw-normal">Please login</h1>

    <div class="form-floating">
      <input name = "email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input name = "password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
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
?>