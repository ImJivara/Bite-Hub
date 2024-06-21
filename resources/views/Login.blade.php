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


<style> 

</style>
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-50 flex items-center justify-center min-h-screen">
         <x-extracomponents.LogReg/>   
</body>
</html>
