<?php
session_start();
if (isset($_SESSION['idPersone'])) {
    require_once('../database/conexion.php');
    $stmdel=$db->prepare('select profil_personel from personel where id_personel=?');
    $stmdel->execute([$_SESSION['idPersone']]);$ligne=$stmdel->fetch(PDO::FETCH_OBJ);
    if (isset($_GET['image'])) {
        $stmg = $db->prepare('update personel set profil_personel=:img where id_personel=:id');
        $flagimg = $stmg->execute([':id' => $_SESSION['idPersone'], ':img' => '../assets/images/dashboard/1.png']);
        if ($flagimg) {
            $_SESSION['profil'] = '../assets/images/dashboard/1.png';
            if (file_exists($ligne->profil_personel) && $ligne->profil_personel !== '../assets/images/dashboard/1.png'):unlink($ligne->profil_personel);endif;
        }
    }
    if (isset($_FILES['file'])) {
        if (!empty(trim($_POST['fullName'])) && !empty(trim($_POST['about'])) && !empty(trim($_POST['job'])) && !empty(trim($_POST['address'])) && !empty(trim($_POST['phone']))&& !empty(trim($_POST['email']))) {
            if (!empty($_FILES['file']['name'])) {
                $name_image = "click_shop_" . date("YmdHis") . $_FILES['file']['name'];
                $cheman = "../assets/images/user/$name_image";
                if ($_FILES['file']['size']!==0) {
                    $name_tomp = move_uploaded_file($_FILES['file']["tmp_name"], $cheman);
                    if ($name_tomp) {
                        $stm=$db->prepare('update personel set nom=:nom,about=:about,role=:role,adress=:adress,tel=:tel,email=:email,profil_personel=:profil where id_personel=:id');
                        $flag=$stm->execute([':nom'=>$_POST['fullName'],':about'=>$_POST['about'],':role'=>$_POST['job'],':adress'=>$_POST['address'],':tel'=>$_POST['phone'],':email'=>$_POST['email'],':profil'=>$cheman,':id'=>$_SESSION['idPersone']]);
                        if ($flag) {
                            $_SESSION['profil']=$cheman;
                            $_SESSION['nom_personnel']=$_POST['fullName'];
                            $_SESSION['role']=$_POST['job'];
                            $_SESSION['adress']=$_POST['address'];
                            $_SESSION['tel']=$_POST['phone'];
                            $_SESSION['Email']=$_POST['email'];
                            $_SESSION['about']=$_POST['about'];
                        } else {
                            $_SESSION['error']='<script>alert("saisis incorrecte")</script>';
                        }
                    }
                }
                } else {
                    $stm1=$db->prepare('update personel set nom=:nom,about=:about,role=:role,adress=:adress,tel=:tel,email=:email where id_personel=:id');
                    $flag1=$stm1->execute([':nom'=>$_POST['fullName'],':about'=>$_POST['about'],':role'=>$_POST['job'],':adress'=>$_POST['address'],':tel'=>$_POST['phone'],':email'=>$_POST['email'],':id'=>$_SESSION['idPersone']]);
                    if ($flag1) {
                        $_SESSION['nom_personnel']=$_POST['fullName'];
                        $_SESSION['role']=$_POST['job'];
                        $_SESSION['adress']=$_POST['address'];
                        $_SESSION['tel']=$_POST['phone'];
                        $_SESSION['Email']=$_POST['email'];
                        $_SESSION['about']=$_POST['about'];
                    } else {
                        $_SESSION['error']='<script>alert("saisis incorrecte")</script>';
                    }
            }
        } else {
            $_SESSION['error']='<script>alert("tout les champs doivent etre remplis")</script>';
        }
        }
    if (isset($_POST['change'])) {
        if (!empty(trim($_POST['password']))) {
        $stm=$db->prepare('select id_personel from personel where id_personel=? and password=?');
        $pass=$stm->execute([$_SESSION['idPersone'],$_POST['password']]);
        if ($persone=$stm->fetch(PDO::FETCH_OBJ)) {
        if (!empty(trim($_POST['newpassword']))&&!empty(trim($_POST['renewpassword']))
            && $_POST['newpassword']===$_POST['renewpassword']) {
                $stm=$db->prepare('update personel set password=? where id_personel=?');
                $pass=$stm->execute([$_POST['newpassword'],$persone->id_personel]);
            $_SESSION['error']='<script>alert("Validé")</script>';
            } else {
            $_SESSION['error']='<script>alert("Le nouveau mot de passe est incorrecte")</script>';
        }
        } else {
            $_SESSION['error']='<script>alert("mot de passe incorrect")</script>';
        }
        } else {
            $_SESSION['error']='<script>alert("mot de passe incorrect")</script>';
        }
    }
    header("Location:users-profile.php");
} else {header("Location:../login-logout-signUp/login_one.php");}
