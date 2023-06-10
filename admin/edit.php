<?php
session_start();
if (isset($_SESSION['idPersone'])) {
if (isset($_GET['id'])) {
    require_once('../database/conexion.php');
    if (isset($_FILES['file'])) {
        if (isset($_FILES['file']['name'][0]) && isset($_FILES['file']['name'][1])) {
            $name_image1 = "click_shop_" . date("YmdHis") . $_FILES['file']['name'][0];
            $name_image2 = "click_shop_" . date("YmdHis") . $_FILES['file']['name'][1];
            if (!empty($_POST['categorie'])) {
                $cheman1 = "../assets/images/products/".$_POST['categorie']."/$name_image1";
                $cheman2 = "../assets/images/products/".$_POST['categorie']."/$name_image2";
            if ($_FILES['file']['size'][0] != 0 && $_FILES['file']['size'][1] != 0) {
                $name_tomp1 = move_uploaded_file($_FILES['file']["tmp_name"][0], $cheman1);
                $name_tomp2 = move_uploaded_file($_FILES['file']["tmp_name"][1], $cheman2);
                if (!empty(trim($_POST['titre'])) && !empty(trim($_POST['des'])) && !empty($_POST['prix'])
                    && !empty($_POST['stock'])) {
                    if ($name_tomp1 && $name_tomp2) {
                        $produit = $db->prepare('update click_shop.produit 
        set nom_produit=:nomP,prix_produit=:prix,
                              description_produit=:des,details_produit=:det,categorie=:cat,qte_stock=:qnt
                          where id_personel=:idA and id_produit=:idP');
                        $produit->execute([":idP" => $_GET['id'], ":idA" => $_SESSION['idPersone'],
                            ":nomP" => $_POST['titre'], ":prix" => $_POST['prix'], ":des" => $_POST['des'],
                            ":det" => $_POST['det'],':cat'=>$_POST['categorie'], ":qnt" => $_POST['stock']]);
                        $updateimg = $db->prepare('select * from click_shop.images where id_image=?');
                        $updateimg->execute([$_GET['id']]);
                        if ($update = $updateimg->fetch(PDO::FETCH_OBJ)) {
                            if (file_exists($update->src_image1)):unlink($update->src_image1);endif;
                            if (file_exists($update->src_image2)):unlink($update->src_image2);endif;
                        }
                        $stmUpImg = $db->prepare('update click_shop.images set
                             src_image1=:src1,src_image2=:src2 where id_image=:iM');
                        $flagimg1 = $stmUpImg->execute([':src1' => $cheman1, ':src2' => $cheman2,
                            ':iM' => $_GET['id']]);
                        if ($flagimg1) {
                            header("Location:index.php?page=index");
                        }
                    } else {
                        $_SESSION['error']='<script>alert("impoter une image")</script>';
                        if ($_GET['page'] === 'index') {
                            header("Location:editProduit.php?id=".$_GET['id']."&page=index");
                        }
                        if ($_GET['page'] === 'tableAllProduit') {
                            header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
                        }
                    }
                } else {
                    $_SESSION['error']='<script>alert("merci de remplir tout les champs !!!!")</script>';
                    if ($_GET['page'] === 'index') {
                        header("Location:editProduit.php?id=".$_GET['id']."&page=index");
                    }
                    if ($_GET['page'] === 'tableAllProduit') {
                        header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
                    }
                }
            }
            else {
                $_SESSION['error']="<script>alert('la taille d\'image doit etre moins de 100k')</script>";
                if ($_GET['page'] === 'index') {
                    header("Location:editProduit.php?id=".$_GET['id']."&page=index");
                }
                if ($_GET['page'] === 'tableAllProduit') {
                    header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
                }
            }}
        } else {
        if (!empty(trim($_POST['titre'])) && !empty(trim($_POST['des'])) && !empty($_POST['prix']) &&
            !empty($_POST['stock'])) {
            $produit = $db->prepare('update click_shop.produit set nom_produit=:nomP,prix_produit=:prix,
            description_produit=:des,categorie=:cat,qte_stock=:qnt where id_personel=:idA and id_produit=:idP');
            $flag = $produit->execute([":idP" => $_GET['id'], ":idA" => $_SESSION['idPersone'],
                ":nomP" => $_POST['titre'], ":prix" => $_POST['prix'], ":des" => $_POST['des'],
                ':cat'=>$_POST['categorie'],":qnt" => $_POST['stock']]);
            ($flag)?header('Location:index.php?page=index'):header(
                "Location:editProduit.php?id=".$_GET['id']."&page=index");
        } else {
            $_SESSION['error']='<script>alert("merci de remplir tout les champs !!!!")</script>';
            if ($_GET['page'] === 'index') {
                header("Location:editProduit.php?id=".$_GET['id']."&page=index");
            }
            if ($_GET['page'] === 'tableAllProduit') {
                header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
            }
        }
    }
    } else {
            $_SESSION['error']='<script>alert("saisis incorrecte")</script>';
            if ($_GET['page'] === 'index') {
                header("Location:editProduit.php?id=".$_GET['id']."&page=index");
            }
            if ($_GET['page'] === 'tableAllProduit') {
                header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
            }
        }
} else {
    $_SESSION['error']='<script>alert(" incorecte id")</script>';
    if ($_GET['page'] === 'index') {
        header("Location:editProduit.php?id=".$_GET['id']."&page=index");
    }
    if ($_GET['page'] === 'tableAllProduit') {
        header("Location:editProduit.php?id=".$_GET['id']."&page=tableAllProduit");
    }
}
}else {
    header('location:../login-logout-signUp/login_one.php');}




