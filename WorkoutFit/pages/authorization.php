<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>fit</title>
    <link rel='stylesheet' type='text/css' href='../assets/styles/reset.css'>
    <link rel='stylesheet' type='text/css' href='../assets/styles/authorization_registration.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="../assets/scripts/jquery.js"></script>
</head>
<body>
    <section class="main-container">
        <a class="logo" href="/">
            <div class="l1"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M20 0C8.95431 0 0 8.95431 0 20V44C0 55.0457 8.95431 64 20 64H44C55.0457 64 64 55.0457 64 44V20C64 8.95431 55.0457 0 44 0H20ZM38.63 19.7H34.01L29.96 34.43L26.63 19.7H20.81L16.73 34.49L13.28 19.7H8.33L13.64 41H19.22L23.42 25.88L26.93 41H32.48L38.63 19.7ZM40.8702 19.7V41H52.9302L53.1402 38.99H43.1802V19.7H40.8702Z" fill="white"/>
            </svg></div>
            <div class="l2"><span>Workout</span>Labs</div>
            <div class="l3">Fit</div>
        </a>
        <div class="form-container">
            <div class="title">
                Welcome back!
            </div>
            <a class="sign-in-apple-btn">
                <svg xmlns="http://www.w3.org/2000/svg" style="pointer-events: none; overflow: visible;" width="100%" height="100%">
                    <g>
                      <svg xmlns="http://www.w3.org/2000/svg" style="overflow: visible;" width="100%" height="50%" y="25%" viewBox="0 -11 111.046875 14" fill="#fff">
                        <defs>
                          <style>
                            
                  @font-face {
                    font-family: "applied-button-font-0";
                    src: url(data:application/x-font-woff;charset=utf-8;base64,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) format("woff")
                  }
                          </style>
                        </defs>
                        <text font-size="12px" textLength="111.046875" font-family="applied-button-font-0" direction="ltr"> Sign in with Apple</text>
                      </svg>
                    </g>
                  </svg>
            </a>
            <div class="desc-container">
                <span class="desc">
                    or sign in below
                </span>
            </div>
            <form novalidate>
                <div class="login-input-container">
                    <input id='login-input' type="text" name="login" required>
                    <label for="login-input">Email or username</label>
                </div>
                <div class="password-input-container">
                    <input id='password-input' type="password" name="password" required>
                    <label for="password-input">Password</label>
                </div>
                <button class="sign-in-btn" type="submit">Sign in</button>
            </form>
            <a class="reset-password">Reset my password</a>
        </div>
        <div class="sign-up-container">
            Don't have an account yet? <a href="registration.php" class="sign-up">Sign up</a>
        </div>
    </section>
    <script src="../assets/scripts/authorization_input.js"></script>
</body>
</html>