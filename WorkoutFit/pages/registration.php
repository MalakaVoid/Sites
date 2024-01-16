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
                Take a week of workouts on us 🙌
            </div>
            <div class="desc-container-register">
                <span class="desc">
                    Enjoy unlimited access free for 7 days
                </span>
            </div>
            <form method="post" novalidate>
                <div class="names-container">
                    <div class="first-name-input-container">
                        <input id='first-name-input' type="text" name="first_name" required>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <g id="&#x421;&#x43B;&#x43E;&#x439;_1">
                                <g>
                                    <polygon points="27,55 6,33 9,29 26,41 55,12 59,16 		"/>
                                </g>
                            </g>
                            <g id="Email_Open">
                            </g>
                            <g id="Money">
                            </g>
                        </svg>
                        <label for="first-name-input">First name</label>
                    </div>
                    <div class="last-name-input-container">
                        <input id='last-name-input' type="text" name="last_name" required>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <g id="&#x421;&#x43B;&#x43E;&#x439;_1">
                                <g>
                                    <polygon points="27,55 6,33 9,29 26,41 55,12 59,16 		"/>
                                </g>
                            </g>
                            <g id="Email_Open">
                            </g>
                            <g id="Money">
                            </g>
                        </svg>
                        <label for="last-name-input">Last name</label>
                    </div>
                </div>
                <div class="login-input-container margin-add">
                    <input id='login-input' type="text" name="login" required>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <g id="&#x421;&#x43B;&#x43E;&#x439;_1">
                                <g>
                                    <polygon points="27,55 6,33 9,29 26,41 55,12 59,16 		"/>
                                </g>
                            </g>
                            <g id="Email_Open">
                            </g>
                            <g id="Money">
                            </g>
                        </svg>
                    <label for="login-input">Email</label>
                </div>
                <div class="password-input-container">
                    <input id='password-input' type="password" name="password" required>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <g id="&#x421;&#x43B;&#x43E;&#x439;_1">
                                <g>
                                    <polygon points="27,55 6,33 9,29 26,41 55,12 59,16 		"/>
                                </g>
                            </g>
                            <g id="Email_Open">
                            </g>
                            <g id="Money">
                            </g>
                        </svg>
                    <label for="password-input">Create password</label>
                </div>
                <button class="sign-in-btn">Claim my free week</button>
            </form>
        </div>
        <div class="sign-up-container">
            Already a member? <a href="authorization.php" class="sign-up">Sign in</a>
        </div>
    </section>
    <script src="../assets/scripts/registration_input.js"></script>
</body>
</html>