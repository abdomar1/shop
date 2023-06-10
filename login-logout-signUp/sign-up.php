<?php session_start();if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;?>
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
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="../../css2.css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="../../css2-1.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="../../css2-2.css?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>         
      <div class="container-fluid p-0"> 
        <div class="row m-0">
          <div class="col-xl-7 p-0"><img class="bg-img-cover bg-center" src="../assets/images/login/1.jpg" alt="looginpage"></div>
          <div class="col-xl-5 p-0"> 
            <div class="login-card">
                <form class="theme-form login-form" action="create.php" method="post">
                    <h4>Create your account</h4>
                    <h6>Enter your personal details to create account</h6>
                    <div class="form-group">
                        <label>Full Name</label>
                        <div class="small-group">
                            <div class="input-group"><span class="input-group-text"><em class="icon-user"></em></span>
                                <input class="form-control" type="text" required="" placeholder="Full Name" name="Nom">
                            </div>
                            <div class="input-group"><span class="input-group-text"><em class="icon-user"></em></span>
                                <input class="form-control" type="tel" required="" placeholder="Telephone" name="tel">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Home Address</label>
                        <div class="input-group">
                            <textarea name="Adrr" rows="2" class="col-12" placeholder="home adress"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sexe:</label>
                        <div class="input-group">
                            <label class="input-group-text mx-2" for="homme"><input type="radio" name="sexe" value="Homme" id="homme">Homme</label>
                            <label class="input-group-text mx-2" for="femme"><input type="radio" name="sexe" value="Femme" id="femme">Femme</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group"><span class="input-group-text"><em class="icon-email"></em></span>
                            <input class="form-control" type="email" required="" placeholder="exemple@click.shop" name="email">
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
                        <input class="btn btn-primary btn-block" type="submit" name="btn" value="Create Account"/>
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
                    <p>Already have an account?<a class="ms-2" href="login_one.php">Sign in</a></p>
                </form>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>