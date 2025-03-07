<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | ITS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--login.css-->
    <link rel="stylesheet" href="assets/css/login.css">
</head>


<body>
    <!-- WRAPPER -->


    <div class="container right-panel-active">
        <div class="container__form container--signup">
            <form method="post" action="login.php" class="form" id="form2">
                <h2 class="form__title">Sign In</h2>
                <input type="text" name="id" placeholder="Id" class="input" />
                <input type="password" name="pw" placeholder="Password" class="input" />
                <a href="#" class="link">Forgot your password?</a>
                <button type="submit" class="btn">Sign In</button>
                <!-- <button type="submit" class="btn btn-primary btn-lg btn-block" id="login-btn" -->
                    <!-- onclick="button()">LOGIN</button> -->
            </form>
        </div>
        <div class="container__form container--signin">
            <form method="post" action="register.php" class="form" id="form1">
                <h2 class="form__title">Sorry,<br> Please contact manager</h2>
                <p>010-3775-5496</p>
                <!-- <input type="text" placeholder="User" class="input" />  -->
                 <input type="text" name="id" placeholder="Id" class="input" />
                <input type="password" name ="pw"placeholder="Password" class="input" />
                <button class="btn">Sign Up</button>
            </form>

        </div>
        <!-- Overlay -->
        <div class="container__overlay">
            <div class="overlay">
                <div class="overlay__panel overlay--left">
                    <button class="btn" id="signUp">Sign Up</button>
                </div>
                <div class="overlay__panel overlay--right">
                    <button class="btn" id="signIn">Sign In</button>

                </div>
            </div>
        </div>
    </div>




    <!-- END WRAPPER -->
    <script src="assets/js/login.js"></script>
</body>

</html>