<?php
require_once("../database/conexion.php");
        if (isset($_POST['submit'])) {
            $stmtAdmin=$db->prepare("SELECT * from personel where email=:email and password=:pass");
            $stmtAdmin->execute(array(":email" =>$_POST['email'],":pass" => $_POST["password"]));
            $stmtClient=$db->prepare("SELECT * from client where email=:email and password=:pass");
            $stmtClient->execute(array(":email" =>$_POST['email'],":pass" => $_POST["password"]));
        if ($ligneAdmin=$stmtAdmin->fetch(PDO::FETCH_OBJ)) {
            session_start();
            $_SESSION['idPersone']=$ligneAdmin->id_personel;
            $_SESSION['nom_personnel']=$ligneAdmin->nom;
            $_SESSION['role']=$ligneAdmin->role;
            $_SESSION['profil']=$ligneAdmin->profil_personel;
            $_SESSION['adress']=$ligneAdmin->adress;
            $_SESSION['tel']=$ligneAdmin->tel;
            $_SESSION['Email']=$ligneAdmin->email;
            $_SESSION['about']=$ligneAdmin->about;

        if (isset($_SESSION['idPersone'])) {
            header("Location:../admin/index.php?page=index");
        }
        } elseif ($ligneClient=$stmtClient->fetch(PDO::FETCH_OBJ)){
            session_start();
            $_SESSION['id_client']=$ligneClient->id_client;
            $_SESSION['nom_client']=$ligneClient->nom_clinet;
            $_SESSION['profil_client']=$ligneClient->profil_client;
            $_SESSION['adress']=$ligneClient->Adress_client;
            $_SESSION['tel']=$ligneClient->tel_client;
            $_SESSION['Email']=$ligneClient->email;
            $_SESSION['sexe']=$ligneClient->sexe;
            if (isset($_SESSION['id_client'])){
                header("Location:../client/indexClient.php");
            }
        } else {
            session_start();
            $_SESSION['error_login']='<span>votre email or password incorrect</span>';
            header("Location:login_one.php");
        }
} else {header("Location:login_one.php");}
?>