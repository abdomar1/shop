<?php
session_start();
if (isset($_SESSION['id_client'])):
    if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;
    require_once('../database/conexion.php');
    $stm=$db->prepare('SELECT * FROM click_shop.produit');
    $stm->execute();
    $Produit=$stm->fetchAll(PDO::FETCH_OBJ);

    ?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>Click_shop</title>
</head>
    <body>
    <div class="page-wrapper compact-wrapper" id="pageWrapper" >
        <?php  require_once('header.php'); ?>
        <main id="main" class="main" >
            <div class="pagetitle">
                <h1>Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=index">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="<?=$_SESSION['profil_client']?>" style="height:auto" alt="Profile" class="rounded-circle">
                                <h2><?=$_SESSION['nom_client']?></h2>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><em class="bi bi-twitter"></em></a>
                                    <a href="#" class="facebook"><em class="bi bi-facebook"></em></a>
                                    <a href="#" class="instagram"><em class="bi bi-instagram"></em></a>
                                    <a href="#" class="linkedin"><em class="bi bi-linkedin"></em></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                            <div class="col-lg-9 col-md-8"><?=$_SESSION['nom_client']?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Company</div>
                                            <div class="col-lg-9 col-md-8">Click_shop</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                            <div class="col-lg-9 col-md-8">Maroc</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                            <div class="col-lg-9 col-md-8"><?=$_SESSION['adress']?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8"><?=$_SESSION['tel']?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"><?=$_SESSION['Email']?></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form method="post" action="editProfile.php?image=true" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img src=<?=$_SESSION['profil_client']?> style="height:auto" alt="Profile" id="profil">
                                                    <div class="pt-2">
                                                        <a onclick="importData()" class="btn btn-primary btn-sm" title="Upload new profile image"><em class="bi bi-upload"></em></a>
                                                        <input onchange="afficher(event)" type="file" id="file" name="file" accept="image/*" style="display:none">
                                                        <a onclick="return confirm('do you want to delete your image profil')" href="editProfile.php?image=delete" class="btn btn-danger btn-sm" title="Remove my profile image"><em class="bi bi-trash"></em></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="fullName" type="text" class="form-control" id="fullName" value='<?=$_SESSION['nom_client']?>'>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="country" type="text" class="form-control" id="Country" value="maroc" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="address" type="text" class="form-control" id="Address" value='<?=$_SESSION['adress']?>'>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="phone" type="text" class="form-control" id="Phone" value='<?=$_SESSION['tel']?>'>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email" class="form-control" id="Email" value='<?=$_SESSION['Email']?>'>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sexe:</label>
                                                <div class="input-group">
                                                    <label class="input-group-text mx-2" for="homme"><input type="radio" name="sexe" <?=($_SESSION['sexe']==="Homme")?'checked':''?> value="Homme" id="homme">Homme</label>
                                                    <label class="input-group-text mx-2" for="femme"><input type="radio" name="sexe" <?=($_SESSION['sexe']==="Femme")?'checked':''?> value="Femme" id="femme">Femme</label>
                                                </div>
                                            </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                        </form><!-- End Profile Edit Form -->
                                    </div>
                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form method="post" action="editProfile.php">
                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                                </div>
                                            </div>
                                                <button type="submit" name="change" class="btn btn-primary">Change Password</button>
                                        </form><!-- End Change Password Form -->
                                    </div>
                                </div><!-- End Bordered Tabs -->
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main><!-- End #main -->
    </div>
    <!-- footer start-->
    <?php require_once('footer.php')?>
    </body>
    </html>
<?php
else:
    header('location:../login-logout-signUp/login_one.php');
endif;
ob_end_flush();?>