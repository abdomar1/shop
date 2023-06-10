<?php 
 session_start();
if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>viho - Premium Admin Template</title>
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
  </head>
  <body>
    <!-- page-wrapper Start-->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-7"><img class="bg-img-cover bg-center" src="../assets/images/login/2.jpg" alt="looginpage"></div>
          <div class="col-xl-5 p-0">
            <div class="login-card">
              <form class="theme-form login-form" action="login.php" method="post">
                <h4>Login</h4>
                <h6>Welcome back! Log in to your account.</h6>
                <div class="form-group">
                  <label>Email Address</label>
                  <div class="input-group"><span class="input-group-text"><em class="icon-email"></em></span>
                    <input class="form-control" type="email" required="" name="email" placeholder="Entrer votre email">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group"><span class="input-group-text"><em class="icon-lock"></em></span>
                    <input class="form-control" type="password" name="password" required="" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                </div>
                <div class="form-group">
                    <h6 style="color: red"><?=isset($_SESSION['error_login'])?$_SESSION['error_login']:""?></h6>
                  <div class="checkbox">
                    <input id="checkbox1" type="checkbox">
                    <label class="text-muted" for="checkbox1">Remember password</label>
                  </div><a class="link" href="#">Forgot password?</a>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit" name="submit">Sign in</button>
                </div>
                  <div class="login-social-title">
                  <h5>Sign in with</h5>
                </div>
                <div class="form-group">
                  <ul class="login-social">
                    <li><a href="#" target="_blank"><em data-feather="linkedin"></em></a></li>
                    <li><a href="#" target="_blank"><em data-feather="twitter"></em></a></li>
                    <li><a href="#" target="_blank"><em data-feather="facebook"></em></a></li>
                    <li><a href="#" target="_blank"><em data-feather="instagram"></em></a></li>
                  </ul>
                </div>
                <p>Don't have account?<a class="ms-2" href="sign-up.php">Create Account</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/config.js"></script>
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="../assets/js/script.js"></script>
<!-- Code de connexion -->
  </body>
</html>