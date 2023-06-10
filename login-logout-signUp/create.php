<?php
try {
    if (isset($_POST["btn"])) {
        require_once("../database/conexion.php");
        $Nom=$_POST["Nom"];
        $Adresse = $_POST["Adrr"];
        $Tel = $_POST["tel"];
        $sexe = $_POST["sexe"];
        $Email = $_POST["email"];
        $Pass = $_POST["password"];
        if (
            !empty($Nom) &&
            !empty($Adresse) &&
            !empty($Tel) &&
            !empty($sexe) &&
            !empty($Email) &&
            !empty($Pass)
        ) {
            $stm = $db->prepare("insert into client (nom_clinet, Adress_client, tel_client,sexe, password, email)
                                       values(:Nom, :Adrr, :Tel,:sexe, :Pass,:Email)");
            $flag = $stm->execute(
                [
                    ":Nom" => $Nom,
                    ":Adrr" => $Adresse,
                    ":Tel" => $Tel,
                    ":sexe" => $sexe,
                    ":Email" => $Email,
                    ":Pass" => $Pass
                ]);
            if ($flag) {
                header("Location:login_one.php");
            } else {
                $_SESSION['error_login']='<span>Echec d\'insertion!</span>';
                header("Location:sign-up.php");
            }
        } else {
            $_SESSION['error_login']='<span>Tous les champs sont obligatoires!</span>';
            header("Location:sign-up.php");
        }
    }
} catch (Exception | Error $e) {
    $_SESSION['error_login']='<span>Erreur :'. $e->getMessage().'</span>';
    header("Location:sign-up.php");
}

