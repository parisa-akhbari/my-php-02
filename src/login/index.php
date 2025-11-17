<?php
session_start();
if(isset($_SESSION['error'])){
    echo '<p style="color:red; text-align:center;">'.$_SESSION['error'].'</p>';
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
    echo '<p style="color:green; text-align:center;">'.$_SESSION['success'].'</p>';
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login/Signup Form</title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<style>
html, body * { box-sizing: border-box; font-family: 'Open Sans', sans-serif; }

body {
  background:
    linear-gradient(rgba(246,247,249,0.8), rgba(246,247,249,0.8)),
    url(https://dl.dropboxusercontent.com/u/22006283/preview/codepen/sky-clouds-cloudy-mountain.jpg) no-repeat center center fixed;
  background-size: cover;
}

.container { width: 100%; padding-top: 60px; padding-bottom: 100px; }

.frame {
  height: 575px;
  width: 430px;
  background: linear-gradient(rgba(35,43,85,0.75), rgba(35,43,85,0.95)),
              url(https://dl.dropboxusercontent.com/u/22006283/preview/codepen/clouds-cloudy-forest-mountain.jpg) no-repeat center center;
  background-size: cover;
  margin: 0 auto;
  border-top: solid 1px rgba(255,255,255,.5);
  border-radius: 5px;
  box-shadow: 0px 2px 7px rgba(0,0,0,0.2);
  overflow: hidden;
  transition: all .5s ease;
}

.frame-long { height: 615px; }
.frame-short { height: 400px; margin-top:50px; box-shadow: 0px 2px 7px rgba(0,0,0,0.1); }

.nav { width: 100%; height: 100px; padding-top: 40px; opacity: 1; transition: all .5s ease; }
.nav-up { transform: translateY(-100px); opacity: 0; }

li { padding-left: 10px; font-size: 18px; display: inline; text-align: left; text-transform: uppercase; padding-right: 10px; color: #ffffff; }
.signin-active a, .signup-active a { color: #ffffff; text-decoration: none; border-bottom: solid 2px #1059FF; padding-bottom: 10px; cursor:pointer;}
.signin-inactive a, .signup-inactive a { color: rgba(255,255,255,.3); cursor:pointer; text-decoration:none; }

.form-signin, .form-signup {
  width: 430px;
  font-size: 16px;
  font-weight: 300;
  padding-left: 37px;
  padding-right: 37px;
  padding-top: 55px;
  transition: all .5s ease;
}

.form-signin { height: 375px; }
.form-signup { height: 375px; position: relative; top: -375px; left: 400px; opacity:0; }

.form-signin-left { transform: translateX(-400px); opacity:0; }
.form-signup-left { transform: translateX(-399px); opacity:1; }
.form-signup-down { top:0px; opacity:1; }

input.form-styling {
  width: 100%;
  height: 35px;
  padding-left: 15px;
  border: none;
  border-radius: 20px;
  margin-bottom: 20px;
  background: rgba(255,255,255,.2);
  color: #fff;
  font-size: 13px;
}

input.form-styling:focus {
  outline:none;
  background: rgba(255,255,255,.3);
}

label {
  font-weight: 400;
  text-transform: uppercase;
  font-size: 13px;
  padding-left: 15px;
  padding-bottom: 10px;
  color: rgba(255,255,255,.7);
  display:block;
}

button {
  width: 100%;
  height: 35px;
  border-radius: 20px;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 13px;
  color: #fff;
  border: none;
  cursor:pointer;
}

.btn-signup { background-color: #1059FF; margin-top:23px; }
.btn-signin { background-color: rgba(16,89,255,1); margin-top:23px; }

.success { width: 80%; height: 150px; text-align:center; position: relative; top:-890px; left:450px; opacity:0; transition: all .8s .4s ease; }
.success-left { transform: translateX(-406px); opacity:1; }

</style>
</head>
<body>

<div class="container">
  <div class="frame">

    <div class="nav">
      <ul class="links">
        <li class="signin-active"><a class="btn">Sign in</a></li>
        <li class="signup-inactive"><a class="btn">Sign up</a></li>
      </ul>
    </div>

    <!-- فرم ورود -->
    <form class="form-signin" action="login.php" method="post">
        <label>Username</label>
        <input class="form-styling" type="text" name="username">

        <label>Password</label>
        <input class="form-styling" type="password" name="password">

        <button type="submit" class="btn-signin">Sign in</button>
    </form>

    <!-- فرم ثبت‌نام -->
    <form class="form-signup" action="signup.php" method="post">
        <label>Full name</label>
        <input class="form-styling" type="text" name="username">

        <label>Password</label>
        <input class="form-styling" type="password" name="password">

        <label>Confirm password</label>
        <input class="form-styling" type="password" name="confirmpassword">

        <button type="submit" class="btn-signup">Sign Up</button>
    </form>

    <!-- پیام موفقیت -->
    <div class="success">
      <div class="successtext">
        <p>Thanks for signing up! Check your email for confirmation.</p>
      </div>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    $(".btn").click(function() {
        $(".form-signin").toggleClass("form-signin-left");
        $(".form-signup").toggleClass("form-signup-left");
        $(".frame").toggleClass("frame-long");
        $(".signup-inactive").toggleClass("signup-active");
        $(".signin-active").toggleClass("signin-inactive");
    });
});

$(function() {
    $(".btn-signup").click(function() {
        $(".form-signup-left").toggleClass("form-signup-down");
        $(".success").toggleClass("success-left");
        $(".frame").toggleClass("frame-short");
    });
});
</script>

</body>
</html>
