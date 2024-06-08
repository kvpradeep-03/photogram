<!--signup form-->
<main class="form-signup w-100 m-auto">
  <form action="test.php" method="post">
    <img class="mb-4" src="https://cdn-icons-png.flaticon.com/128/10401/10401230.png" alt="" width="100" height="87">
    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
    <div class="form-floating">
      <input name = "username" type="text" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInputusername">Username</label>
    </div>
    <div class="form-floating">
      <input name = "phone" type="text" class="form-control" id="floatingInput" placeholder="phone">
      <label for="floatingInputphone">Phone</label>
    </div>
    <div class="form-floating">
      <input name = "email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInputemail">Email address</label>
    </div>
    <div class="form-floating">
      <input name = "password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
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