<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - ShinyFlakes</title>
    <link href="../assets/dist/css/stylelog.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('authLogin') }}" method="POST">
                @csrf
                <h2 class="title">Log In Form</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="email" class="form-control" required/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required/>
                </div>
                <input type="submit" value="Login" class="btn solid" />
                <p class="error-message" id="error-message"></p>
            </form>
        </div>
    </div>
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>Welcome Back, Dude!</h3>
                <p>Enter Your personal details and start journey with us</p>
            </div>
            <img src="../assets/images/favicon.png" class="image" alt="" style="width: 210px; margin-right: 120px;">
        </div>
    </div>
</div>

</body>
</html>
