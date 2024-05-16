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
        
        
        $(document).ready(function()
         {  
              $('#txt_pwd').on('input', function() {
            var pwdValue = $(this).val();
            if (pwdValue.length > 0) {
                $('#txt_cpwd').prop('disabled', false);
            } else {
                $('#txt_cpwd').prop('disabled', true);
            }
            });
      
          $('#btn_Register').click(function(event) 
          { 
            event.preventDefault(); // Prevents default submission lal form
        
            if($('#txt_pwd').val()!= $('#txt_cpwd').val() )
            {
              $('#result1').html("re-check your passwords, make sure they're identical"); 
              $('#txt_cpwd').val(''); 
            }
            else {
            var email = $('#txt_email').val();
            var password = $('#txt_pwd').val(); 
            var name = $('#txt_name').val();
              $.ajax({
                  url: '/Register',
                  type: 'POST',
                  data:{
                    '_token': '{{ csrf_token() }}',
                    'email': email,
                    'password': password,
                    'name'    :name,
                  },
                  success: function(response) 
                  {
                    if(response.success)
                    {  
                      window.location.href = '/Login';       
                    }
                    else $('#result2').html("Invalid Email Address"); 
                  },
                  error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMsg = '';
                    for (var error in errors) {
                        if (errors.hasOwnProperty(error)) {
                            errorMsg += errors[error] + '<br>';
                        }
                    }
                    $('#result2').html(errorMsg);
                    alert(errorMsg);
                }
              });
            }
          });
      });
    </script>
         

<style> 
*{color:wheat;
  overflow-y: hidden;}
</style>
</head>
<body style="background-color: #100C08;">
    
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" ></i>
          <!-- <span class="h1 fw-bold mb-0"><img src="{{asset('imgs/logo.png')}}"></span> -->
          <h1>Food Blog</h1>
        </div>
        <div  class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-2 pt-5 pt-xl-0 mt-xl-n5">
        <form style="width: 25rem;">
      
              <h3 class="fw-Large mb-3 pb-3" style="letter-spacing: 1px; color:#0D6EFD">Registration</h3>
      
              <div class="form-outline mb-2" >
                <input type="text" id="txt_name" class="form-control form-control-lg"  required/> <!--name-->
                <label class="form-label" for="txt_name">Name</label>
              </div>
      
              <div class="form-outline mb-2" >
              <div id="result2" style="color: red;"></div>
                <input type="email" id="txt_email" class="form-control form-control-lg"required /> <!--email-->
                <label class="form-label" for="txt_email">Email address</label>
              </div>
      
              <div class="form-outline mb-2">
                <input type="password" id="txt_pwd" class="form-control form-control-lg" required/> <!--pwd-->
                <label class="form-label" for="txt_pwd">Password</label>
              </div>
                    
              <div class="form-outline mb-2" >
                  <div id="result1" style="color: red;"></div>
                  <input type="password" id="txt_cpwd" class="form-control form-control-lg" disabled/> <!--pwd-->
                  <label class="form-label" for="form2Example28">Confirm Password</label>
            </div>
      
              <div class="pt-0 mb-4">
                <button class="btn btn-primary" type="submit" id="btn_Register">Register</button>
              </div>
            </form>
            
          </div>
      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="{{asset('imgs/background5.jpg')}}"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
      
    </div>
  </div>
</section>
</body>
</html>
