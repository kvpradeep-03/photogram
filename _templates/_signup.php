<?php
    $signup = false;
    if(isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $error = User::signup($username,$password,$email,$phone);   //fetches the error from User.clss.php and assigns signuped user data to user class
      $signup = true;   //when all the datas are fetched from form them sigup sets true
    }
?>

<?php
    if($signup){
      if(!$error){
?>
        <main class="container">
          <div class="bg-body-tertiary p-5 rounded mt-3">
            <h1>Signup Success</h1>
            <p class="lead">Now you can login <a href="/photogram/app/login.php">here</a></p>
          </div>
        </main>
<?php
    } else {
?>  
        <main class="container">
          <div class="bg-body-tertiary p-5 rounded mt-3">
            <h1>Signup Fail</h1>
            <p class="lead">Something went wrong, <?=$error?></p>
          </div>
        </main>
<?php
    } 
  } else {
?>
<!--signup form-->
<main class="form-signup w-100 m-auto">
  <form action="signup.php" method="post">
    <img class="mb-4" src="https://cdn-icons-png.flaticon.com/128/10401/10401230.png" alt="" width="100" height="87">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="username" required>
      <label for="floatingInputusername">Username</label>
    </div>
    <div class="form-floating">
      <input name="phone" type="text" class="form-control" id="floatingInput" placeholder="phone" required>
      <label for="floatingInputphone">Phone</label>
    </div>
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInputemail">Email address</label>
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
    <button class="btn btn-primary w-100 py-2 hvr-wobble-vertical" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-body-secondary">© 2017–2024</p>
  </form>
</main>

<?php
  }
?>
