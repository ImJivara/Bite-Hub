<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <script src="{{asset('jquery-3.7.1.js')}}"></script>
       
<script>
    $(document).ready(function () 
    {
        $('#btn_login').click(function (e)
         {
            e.preventDefault();

            var email = $('#txt_email').val();
            var password = $('#txt_pwd').val();
            $.ajax({
                type: 'POST',
                url: '/Login',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': email,
                    'password': password
                },
                success: function (data)
                {
                    if(data.success)
                    { 
                       window.location.href = '/Recipes';         
                    }
                    else{  
                      $('#txt_pwd').val(''); 
                      $('#result1').html('re-check your password'); 
                      $('#result2').html('your email might be incorrect, please try again');
                    }
                },
               
            });
        });
    });
</script>

     </script>
<style> 
*{color:white;}
</style>
</head>
<!-- <body class="bg-cover bg-center bg-no-repeat overflow-y-hidden" style="background-image: url({{asset('imgs/bg1.jpg')}});"> -->

<body class=" bg-cover "style="background-image: url({{asset('imgs/backgroundimgs/black.jpg')}}); background-size: contain; overflow-y-hidden background-position: center;">
  <section class="vh-100">
    <div class="container-fluid">
        <div class="col-sm-6 text-black">
          <div class="px-5 ms-xl-4">
              <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" ></i>
              <!-- <span class="h1 fw-bold mb-0"><img src="{{asset('imgs/logo.png')}}"></span> -->
              <h1>Food Blog</h1>
          </div>
          <div  class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
            <form style="width: 23rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                <div class="form-outline mb-4">
                  <div id="result2" style="color: red;"></div>
                  <input type="email" id="txt_email" class="form-control form-control-lg border-red-500" /> <!-- email -->
                  <label class="form-label" for="txt_email">Email address</label>
                </div>
                <div class="form-outline mb-4">
                  <div id="result1" style="color: red;"></div>
                  <input type="password" id="txt_pwd" class="form-control form-control-lg border-red-500" required /> <!-- pwd -->
                  <label class="form-label" for="txt_pwd">Password</label>
                </div>
                <div class="pt-1 mb-4">
                  <input class="btn btn-primary" type="submit" id="btn_login" value="Login">
                </div>
              <p>Don't have an account? <a href="/Registration" class="link">Register here</a></p>
            </form> 
            </div>
         </div>
        <!-- <div class="col-sm-6 px-0 d-none d-sm-block"> -->
          <!-- <img src="{{asset('imgs/bg1.jpg')}}"
            alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div> -->
    </div>
  </section>
</body>
</html>
