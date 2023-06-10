<?php

session_start();
if (isset($_SESSION['id_client'])) {
    require_once('../database/conexion.php');
    $stmdel = $db->prepare('select profil_client from client where id_client=?');
    $stmdel->execute([$_SESSION['id_client']]);$ligne = $stmdel->fetch(PDO::FETCH_OBJ);
    if (isset($_GET['image'])) {
        $stmg = $db->prepare('update client set profil_client=? where id_client=?');
        $flagimg = $stmg->execute(['../assets/images/user/user.png',$_SESSION['id_client']]);
        if ($flagimg) {
            $_SESSION['profil_client'] ='../assets/images/user/user.png';
            if (file_exists($ligne->profil_client) && $ligne->profil_client !== '../assets/images/user/user.png'):
                unlink($ligne->profil_client);endif;
        }
    }
    if (isset($_FILES['file'])) {
        if (!empty(trim($_POST['fullName'])) &&
            !empty(trim($_POST['address'])) &&
            !empty(trim($_POST['phone'])) &&
            !empty(trim($_POST['email']))&&
            !empty(trim($_POST['sexe']))) {
            if (!empty($_FILES['file']['name'])) {
                $name_image = "click_shop_C" . date("YmdHis") . $_FILES['file']['name'];
                $cheman = "../assets/images/user/$name_image";
                if ($_FILES['file']['size'] !== 0) {
                    $name_tomp = move_uploaded_file($_FILES['file']["tmp_name"], $cheman);
                    if ($name_tomp) {
                        $stm = $db->prepare('update client set nom_clinet=:nom,
                                                        profil_client=:profile,
                                                        sexe=:sexe,
                                                        email=:email,
                                                        Adress_client=:adress,
                                                        tel_client=:tel,
                                                        sexe=:sexe where id_client=:id');
                        $flag = $stm->execute(
                            [
                                ':nom' => $_POST['fullName'],
                                ':profile' => $cheman,
                                ':tel'=>$_POST['phone'],
                                ':email' => $_POST['email'],
                                ':adress' => $_POST['address'],
                                'sexe'=>$_POST['sexe'],
                                ':id' => $_SESSION['id_client']
                            ]);
                        if ($flag) {
                            $_SESSION['profil_client'] = $cheman;
                            $_SESSION['nom_client'] = $_POST['fullName'];
                            $_SESSION['adress'] = $_POST['address'];
                            $_SESSION['tel'] = $_POST['phone'];
                            $_SESSION['Email'] = $_POST['email'];
                            $_SESSION['sexe']=$_POST['sexe'];
                        } else {
                            $_SESSION['error'] = '<script>alert("some thing in corect")</script>';
                        }

                    }
                }
                
            } else {
                $stm1 = $db->prepare('update personel set nom=:nom,
                    about=:about,role=:role,adress=:adress,
                    tel=:tel,email=:email where id_personel=:id');
                $flag1 = $stm1->execute([
                    ':nom' => $_POST['fullName'],
                    ':about' => $_POST['about'],
                    ':role' => $_POST['job'],
                    ':adress' => $_POST['address'],
                    ':tel' => $_POST['phone'],
                    ':email' => $_POST['email'],
                    ':id' => $_SESSION['idPersone']]);
                if ($flag1) {
                    $_SESSION['nom_personnel'] = $_POST['fullName'];
                    $_SESSION['role'] = $_POST['job'];
                    $_SESSION['adress'] = $_POST['address'];
                    $_SESSION['tel'] = $_POST['phone'];
                    $_SESSION['Email'] = $_POST['email'];
                    $_SESSION['about'] = $_POST['about'];
                } else {
                    $_SESSION['error'] = '<script>alert("some thing in corect")</script>';
                }
            }
        } else {
            $_SESSION['error'] = '<script>alert("tout les champ doit etre remplir")</script>';
        }
    }
    if (isset($_POST['change'])) {
        if (!empty(trim($_POST['password']))) {
            $stm = $db->prepare('select id_client from client where id_client=? and password=?');
            $pass = $stm->execute([$_SESSION['id_client'], $_POST['password']]);
            if ($persone = $stm->fetch(PDO::FETCH_OBJ)) {
                if (!empty(trim($_POST['newpassword'])) &&
                    !empty(trim($_POST['renewpassword'])) &&
                    $_POST['newpassword'] === $_POST['renewpassword']) {
                    $stm = $db->prepare('update client set password=? where id_client=?');
                    $pass = $stm->execute([$_POST['newpassword'], $persone->id_client]);
                    $_SESSION['error'] = '<script>alert("successfully")</script>';
                } else {
                    $_SESSION['error'] = '<script>alert("new password not confirm")</script>';
                }
            } else {
                $_SESSION['error'] = '<script>alert("password incorrect")</script>';
            }
        } else {
            $_SESSION['error'] = '<script>alert("password incorrect")</script>';
        }
    }
    header("Location:User-Profile.php");
} else {
    header("Location:../login-logout-signUp/login_one.php");
}
