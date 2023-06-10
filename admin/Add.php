<?php
session_start();
if (isset($_SESSION['idPersone'])) {
if (isset($_FILES['file'])) {
    require_once('../database/conexion.php');
        if (isset($_FILES['file']['name'][0])
            &&isset($_FILES['file']['name'][1])) {
            $name_image1 = "click_shop_" .
                date("YmdHis") .
                $_FILES['file']['name'][0];
            $name_image2 = "click_shop_" .
                date("YmdHis") .
                $_FILES['file']['name'][1];
            if (!empty($_POST['categorie'])) {
            $cheman1 = "../assets/images/products/".
                $_POST['categorie']."/$name_image1";
            $cheman2 = "../assets/images/products/".
                $_POST['categorie']."/$name_image2";
            if ($_FILES['file']['size'][0]!= 0
                &&$_FILES['file']['size'][1]!= 0) {
                $name_tomp1 = move_uploaded_file($_FILES['file']["tmp_name"][0], $cheman1);
                $name_tomp2 = move_uploaded_file($_FILES['file']["tmp_name"][1], $cheman2);
                if (!empty(trim($_POST['titre'])) &&
                    !empty(trim($_POST['des']))&&
                    !empty(trim($_POST['det'])) &&
                    !empty($_POST['prix']) &&
                    !empty($_POST['stock'])) {
                    if ($name_tomp1 && $name_tomp2) {
                        $produit = $db->prepare('insert into click_shop.produit
                                                       values(default,:idA,:nomP,:prix,:des,:det,:cat,:qnt)');
                        $flag = $produit->execute(
                            [
                                ":idA" => $_SESSION['idPersone'],
                                ":nomP" => $_POST['titre'],
                                ":prix" => $_POST['prix'],
                                ":des" => $_POST['des'],
                                ":det" => $_POST['det'],
                                ':cat'=>$_POST['categorie'],
                                ":qnt" => $_POST['stock']
                            ]);
                        if ($flag) {
                            $stimage = $db->prepare('SELECT id_produit FROM click_shop.produit
                                                           where id_personel=? order by id_produit desc limit 1');
                            $stimage->execute([$_SESSION['idPersone']]);
                            $idP = $stimage->fetch(PDO::FETCH_OBJ);
                            $image = $db->prepare('insert into click_shop.images values(:idP,:src1,:src2)');
                            $flagimg = $image->execute([
                                ':idP' => $idP->id_produit,
                                ':src1' => $cheman1,
                                ":src2" => $cheman2
                            ]);
                            if (!$flagimg) {
                                $_SESSION['error']='<script>alert("Erreur d`\'insertion")</script>';
                            }
                        }
                    } else {
                    $_SESSION['error']='<script>alert("Merci de choisir une photo")</script>';
                }
                } else {
                $_SESSION['error']='<script>alert("Veuillez remplir tout les champs!!")</script>';
            }
            } else {
                $_SESSION['error']='<script>alert("veuillez inserer deux photos avec un size de moins de 100kB")</script>';
            }
            } else {
                $_SESSION['error']='<script>alert("veuillez choisir un categorie")</script>';
            }
        } else {
        $_SESSION['error']='<script>alert("Veuillez choisir deux images")</script>';
        }
    } else {
    $_SESSION['error']='<script>alert("Veuillez remplir tout les champs")</script>';
}
        if (isset($_SESSION['error'])) {
            header("Location:addProduit.php?id=".
                $_GET['id']."&page=index");
        }
        header("Location:index.php?page=index");
} else {
    header('location:../login-logout-signUp/login_one.php');
}

