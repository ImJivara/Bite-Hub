<html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <script src="{{asset('jquery-3.7.1.js')}}"></script>
<style>/* Hide the registration form initially */
  .hidden {
    display: none;
  }
  </style>

  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class="px-5 ms-xl-4">
            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4"></i>
            <h1>Food Blog</h1>
          </div>
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-2 pt-5 pt-xl-0 mt-xl-n5">
            <form id="login-form" style="width: 25rem;">
            <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class="px-5 ms-xl-4">
            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4"></i>
            <h1>Food Blog</h1>
          </div>
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-2 pt-5 pt-xl-0 mt-xl-n5">
            <form style="width: 25rem;">

              <h3 class="fw-Large mb-3 pb-3" style="letter-spacing: 1px; color:#0D6EFD">Registration</h3>

              <div class="mb-2">
                <input type="text" id="txt_name" class="form-control form-control-lg border-black" required/> <!--name-->
                <label class="form-label" for="txt_name">Name</label>
              </div>

              <div class="mb-2">
                <div id="result2" style="color: red;"></div>
                <input type="email" id="txt_email" class="form-control form-control-lg border-black" required/> <!--email-->
                <label class="form-label" for="txt_email">Email address</label>
              </div>

              <div class="mb-2">
                <input type="password" id="txt_pwd" class="form-control form-control-lg border-black" required/> <!--pwd-->
                <label class="form-label" for="txt_pwd">Password</label>
              </div>

              <div class="mb-2">
                <div id="result1" style="color: red;"></div>
                <input type="password" id="txt_cpwd" class="form-control form-control-lg border-black" disabled/> <!--pwd-->
                <label class="form-label" for="form2Example28">Confirm Password</label>
              </div>

              <div class="pt-0 mb-4">
                <button class="btn btn-primary" type="submit" id="btn_Register">Register</button>
              </div>
            </form>

          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="{{asset('bla')}}" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>

      </div>
    </div>
  </section>
</form>
            <form id="registration-form" class="hidden" style="width: 25rem;">
            <section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" ></i>
          <!-- <span class="h1 fw-bold mb-0"><img src="{{asset('imgs/logo.png')}}"></span> -->
          <h1>Food Blog</h1>
        </div>
        <div  class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form style="width: 23rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px ;">Log in</h3>

          <div class="form-outline mb-4">
              <div id="result2" style="color: red;"></div>
                  <input type="email" id="txt_email" class="form-control form-control-lg"  /> <!--email-->
                  <label class="form-label" for="form2Example18">Email address</label>
          </div>
          

          <div class="form-outline mb-4">
                  <div id="result1" style="color: red;"></div>
                  <input type="password" id="txt_pwd" class="form-control form-control-lg"  required/> <!--pwd-->
                  <label class="form-label" for="form2Example28">Password</label>
          </div>
          

              <div class="pt-1 mb-4">
                  <input class="btn btn-primary" type="submit" id="btn_login" value="Login">
              </div>
            <p>Don't have an account? <a href="/reg" class="link">Register here</a></p>
            </form>
          </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="{{asset('bla')}}"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
      
    </div>
  </div>
</section>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="{{asset('bla')}}" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
</body>
</html>
<script>// Get the login and registration forms
  const loginForm = document.getElementById('login-form');
  const registrationForm = document.getElementById('registration-form');
  
  // Add event listener to toggle between login and registration forms
  loginForm.addEventListener('click', toggleForms);
  registrationForm.addEventListener('click', toggleForms);
  
  function toggleForms() {
    // Toggle the 'hidden' class to show/hide forms
    loginForm.classList.toggle('hidden');
    registrationForm.classList.toggle('hidden');
  }
</script>  

