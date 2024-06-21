<link href="{{ asset('css/tailwindstyles.css') }}" rel="stylesheet">
<style>
    .wrapper {
        --input-focus: #2d8cf0;
        --font-color: #323232;
        --font-color-sub: #666;
        --bg-color: #fff;
        --bg-color-alt: #666;
        --main-color: #323232;
    }
    /* switch card */
    .switch {
        transform: translateY(-350px);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 30px;
        width: 50px;
        height: 20px;
    }
    .card-side::before {
        position: absolute;
        content: 'Log in';
        left: -70px;
        top: 0;
        width: 100px;
        text-decoration: underline;
        color: var(--font-color);
        font-weight: 600;
    }
    .card-side::after {
        position: absolute;
        content: 'Sign up';
        left: 70px;
        top: 0;
        width: 100px;
        text-decoration: none;
        color: var(--font-color);
        font-weight: 600;
    }
    .toggle {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        box-sizing: border-box;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--bg-colorcolor);
        transition: 0.3s;
    }
    .slider:before {
        box-sizing: border-box;
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        border: 2px solid var(--main-color);
        border-radius: 5px;
        left: -2px;
        bottom: 2px;
        background-color: var(--bg-color);
        box-shadow: 0 3px 0 var(--main-color);
        transition: 0.3s;
    }
    .toggle:checked + .slider {
        background-color: var(--input-focus);
    }
    .toggle:checked + .slider:before {
        transform: translateX(30px);
    }
    .toggle:checked ~ .card-side:before {
        text-decoration: none;
    }
    .toggle:checked ~ .card-side:after {
        text-decoration: underline;
    }
    /* card */ 
    .flip-card__inner {
        width: 300px;
        height: 350px;
        position: relative;
        background-color: transparent;
        perspective: 1000px;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }
    .toggle:checked ~ .flip-card__inner {
        transform: rotateY(180deg);
    }
    .toggle:checked ~ .flip-card__front {
        box-shadow: none;
    }
    .flip-card__front, .flip-card__back {
        padding: 20px;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        background: lightgrey;
        gap: 20px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
    }
    .flip-card__back {
        width: 100%;
        transform: rotateY(180deg);
    }
    .flip-card__form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .title {
        margin: 20px 0 20px 0;
        font-size: 25px;
        font-weight: 900;
        text-align: center;
        color: var(--main-color);
    }
    .flip-card__input {
        width: 250px;
        height: 40px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        background-color: var(--bg-color);
        box-shadow: 4px 4px var(--main-color);
        font-size: 15px;
        font-weight: 600;
        color: var(--font-color);
        padding: 5px 10px;
        outline: none;
    }
    .flip-card__input::placeholder {
        color: var(--font-color-sub);
        opacity: 0.8;
    }
    .flip-card__input:focus {
        border: 2px solid var(--input-focus);
    }
    .flip-card__btn:active, .button-confirm:active {
        box-shadow: 0px 0px var(--main-color);
        transform: translate(3px, 3px);
    }
    .flip-card__btn {
        margin: 20px 0 20px 0;
        width: 120px;
        height: 40px;
        border-radius: 5px;
        border: 2px solid var(--main-color);
        background-color: var(--bg-color);
        box-shadow: 4px 4px var(--main-color);
        font-size: 17px;
        font-weight: 600;
        color: var(--font-color);
        cursor: pointer;
    } 
</style>
<body class=" ">
    <div class="flex flex-col ">
        <div class="wrapper">
            <div class="card-switch">
                <label class="switch">
                    <input type="checkbox" class="toggle">
                    <span class="slider"></span>
                    <span class="card-side"></span>
                    <div class="flip-card__inner">
                        <div class="flip-card__front">
                            <div class="title">Log in</div>
                            <form class="flip-card__form" id="loginForm">
                            <div id="result2" style="color: red;"></div>
                                <input class="flip-card__input" id="login_email" name="email" placeholder="Email" type="email">
                                <span id="result1"  style="color: red;"></span>
                                <input class="flip-card__input" id="login_password" name="password" placeholder="Password" type="password">
                                <button class="flip-card__btn" id="btn_login">Let's go!</button>
                            </form>
                        </div>
                        <div class="flip-card__back">
                            <div class="title">Sign up</div>
                            <form class="flip-card__form" id="registrationForm">
                                <input class="flip-card__input" id="register_name" name="name" placeholder="Name" type="text" required>
                                <input class="flip-card__input" id="register_username" name="username" placeholder="User Name" type="text" required>
                                    <div id="resgisterresult1" style="color: red;"></div>
                                <input class="flip-card__input mt-2" id="register_email" name="email" placeholder="Email" type="email" required>
                                <input class="flip-card__input mt-4" id="register_password" name="password" placeholder="Password" type="password" required>
                                    <div id="resultpass" class="mt-2" style="color: red;"></div>
                                <input class="flip-card__input " id="register_confirm_password" name="confirm_password" placeholder="Confirm Password" type="password" disabled>
                                <button class="flip-card__btn" id="btn_register">Confirm!</button>
                            </form>
                            <x-extracomponents.tooltip/>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#btn_login').click(function (e) {
                e.preventDefault();

                var email = $('#login_email').val();
                var password = $('#login_password').val();
                $.ajax({
                    type: 'POST',
                    url: '/Login',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email,
                        'password': password
                    },
                    success: function (data) {
                        if(data.success) { 
                            window.location.href = '/Recipes';         
                        } else {  
                            $('#login_password').val(''); 
                            $('#result1').html('re-check your password'); 
                            $('#result2').html('your email might be incorrect, please try again');
                        }
                    },
                });
            });

            $('#register_password').on('input', function() {
                var pwdValue = $(this).val();
                if (pwdValue.length > 0) {
                    $('#register_confirm_password').prop('disabled', false);
                } else {
                    $('#register_confirm_password').prop('disabled', true);
                }
            });

            $('#registrationForm').on('submit', function(event) {
                event.preventDefault(); // Prevents default submission

                if ($('#register_password').val() != $('#register_confirm_password').val()) {
                    $('#resultpass').html("Re-check your passwords, make sure they're identical");
                    $('#register_confirm_password').val('');
                } else {
                    $('#resultpass').html("");
                    var email = $('#register_email').val();
                    var password = $('#register_password').val();
                    var name = $('#register_name').val();
                    var username = $('#register_username').val();
                    alert(username);
                    $.ajax({
                        url: '/Register',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'email': email,
                            'password': password,
                            'name': name,
                            'username': username,
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = '/Login';
                            } else {
                                $('#resgisterresult1').html(response.message);
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;
                            var errorMsg = '';
                            for (var error in errors) {
                                if (errors.hasOwnProperty(error)) {
                                    errorMsg += errors[error] + '<br>';
                                }
                            }
                            $('#resgisterresult1').html(errorMsg);
                        }
                    });
                }
            });
        });
    </script>
<body>
