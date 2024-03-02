<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POLLS - HOME</title>

    <!-- CSS LINKS -->
    <link rel="stylesheet" href="style.css" />

    <!-- SCRIPT FILES -->
    <script src="script.js" type="text/javascript"></script>
</head>

<body>
    <video playsinline autoplay muted loop>
        <source src="bg_video.mp4" type="video/mp4">
        Your browser doesn't support video file
    </video>
    <main>
        <header>
            <h1>VOTERIGHT</h1>
            <i class="slogan">An online voting platform</i>
        </header>

        <section class="intro">
            <h2>Use VOTERIGHT today</h2>
            <ul>
                <li>Secure </li>
                <li>Fast</li>
                <li>Convinient</li>
                <li>Reliable</li>
                <a href="home/index.html">Home</a>
            </ul>
        </section>

        <!-- LOGIN FORM -->
        <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
            require "login.php";
        ?>
            <fieldset>
                <h2>Login Form</h2>

                <div class="<?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" autofocus required/>
                <span class="help"><?php echo $email_err; ?></span>
                </div>

                <div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" value="<?php echo $password; ?>" required/>
                <span class="help"><?php echo $password_err; ?></span>

                <br />
                <a target="_blank" style="margin-top: 10px; margin-bottom: 5px;" href="./password_reset.php">Forget password? </a>
                </div>

                <a href="#signForm" onclick="openReg('signForm', 'loginForm')">New Registration!</a><br/>

                <button type="submit" style="background: #007700; color: #fff;">Login</button>
                <button type="reset">Cancel</button>
            </fieldset>
        </form>

        <!-- SIGN IN FORM -->
        <form id="signForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
            require "signup.php";
        ?>
            <fieldset>
                <h2>Sign-in Form</h2>

                <div class="<?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" placeholder="Opeyemi" value="<?php echo $firstname; ?>" autofocus required/>
                <span class="help-block"><?php echo $firstname_err; ?></span>
                </div>

                <div class="<?php echo (!empty($othername_err)) ? 'has-error' : ''; ?>">
                <label for="othername">Othername</label>
                <input type="text" id="othername" name="othername" placeholder="Ayomide" value="<?php echo $othername; ?>" required/>
                </div>

                <div class="<?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" placeholder="Okunola" value="<?php echo $lastname; ?>" required/>
                <span class="help-block"><?php echo $lastname_err; ?></span>
                </div>

                <div class="<?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@email.com" value="<?php echo $email; ?>" required/>
                <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                
                <div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" value="<?php echo $password; ?>" required/>
                <span class="help-block"><?php echo $password_err; ?></span>
                </div>

                <div class="<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="confirm_password" placeholder="********" value="<?php echo $confirm_password; ?>" required/>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>

                <a href="#loginForm" onclick="openReg('loginForm', 'signForm')">Login here!</a><br />

                <button type="submit" style="background: #007700; color: #fff;">Submit</button>
                <button type="reset">Cancel</button>
            </fieldset>
        </form>
    </main>
</body>
</html>