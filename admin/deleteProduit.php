<?php
session_start();
if (isset($_SESSION['idPersone'])) {
if(isset($_GET['id'])) {
    require_once('../database/conexion.php');
    $delimg=$db->prepare('select src_image1,src_image2 from click_shop.images where id_image=?');
    $delimg->execute([$_GET['id']]);$imgDelete=$delimg->fetch(PDO::FETCH_OBJ);
    $stm=$db->prepare('delete from click_shop.produit where id_produit=?');
    $stm->execute([$_GET['id']]);
    if (file_exists($imgDelete->src_image1)):
        unlink($imgDelete->src_image1);
    endif;
    if (file_exists($imgDelete->src_image2)):
        unlink($imgDelete->src_image2);
    endif;
    }
if ($_GET['page']==='tableAllProduit') {
    header("Location:index.php?page=tableAllProduit");
}
if ($_GET['page']==='index') {
    header("Location:index.php?page=index");
}
} else {
    header('location:../login-logout-signUp/login_one.php');
}
?>

