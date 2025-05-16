<?php
$signup = false;
if(isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $error = User::signup($username, $password, $email, $phone);   //fetches the error from User.clss.php and assigns signuped user data to user class
    $signup = true;   //when all the datas are fetched from form them sigup sets true
}
?>

<?php
    if($signup) {
        if((int)$error) { //(changed !error tempfix)
            ?>
            <main class="container">
              <div class="bg-body-tertiary p-5 rounded mt-3">
                <h1>Signup Success</h1>
                <p class="lead">Now you can login <a
                    href="<?php echo get_config('base_path'); ?>login.php">here</a>
                </p>
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
<div class="d-flex justify-content-around">
<div class="row">
    <div class="col">
      <form action="signup.php" method="post">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg>
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

            <div class="form-floating mb-2">
              <input name="username" type="text" style="background-color:#010100" class="form-control" id="floatingInputUsername" placeholder="username"
                required>
              <label for="floatingInputUsername">Username</label>
            </div>

            <div class="form-floating mb-2">
              <input name="phone" type="text" style="background-color:#010100" class="form-control" id="floatingInputPhone" placeholder="phone" required>
              <label for="floatingInputPhone">Phone</label>
            </div>

            <div class="form-floating mb-2">
              <input name="email" type="email" style="background-color:#010100" class="form-control" id="floatingInputEmail" placeholder="name@example.com"
                required>
              <label for="floatingInputEmail">Email address</label>
            </div>

            <div class="form-floating mb-3">
              <input name="password" type="password" style="background-color:#010100" class="form-control" id="floatingPassword" placeholder="Password"
                required>
              <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check text-start my-3">
              <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Remember me
              </label>
            </div>

            <button class="btn btn-primary w-100 py-2 hvr-wobble-vertical" type="submit">Sign up</button>
            <a href="/login.php" class="w-100 btn btn-link">Already have an account?</a>
          </form>
    </div>
    <div class="col d-flex p-4 d-none d-md-block p-3">        
      <img
          src="https://images.unsplash.com/photo-1554080353-a576cf803bda?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHBob3RvZ3JhcGh5fGVufDB8fDB8fHww"
          alt="" class="img-fluid h-75 w-100" style="border-radius: 60px;">
    </div>
  </div>
</div>



<?php
    }
?>