<?php
session_start();
if (isset($_SESSION['idPersone'])) { require_once('../database/conexion.php');
    if (isset($_GET['id'])&&isset($_GET['notification'])&&$_GET['notification']==='valider'){
    $stm= $db->prepare('update command set valid=1 where id_command=?');
    $stm->execute([$_GET['id']]);
    header('location:index.php?page=index');
    }
    if (isset($_GET['id'])&&isset($_GET['update'])):
        $stmrep= $db->prepare('update command set valid=0 where id_command=?');
        $stmrep->execute([$_GET['id']]);
        header('location:index.php?page=index');
    endif;
    if (isset($_GET['id'])&&isset($_GET['cancel'])){
    $stm= $db->prepare('delete from shop where id_Pannier=?');
    $stm->execute([$_GET['id']]);
    header('location:index.php?page=index');
    }
    if (isset($_GET['id'])&&isset($_GET['valid'])) {
    $stm= $db->prepare('update command set valid=1 where id_command=?');
    $stm->execute([$_GET['id']]);
    header('location:command.php');
    }
    if (isset($_GET['id'])&&$_GET['notification']==='see') {
    $stmCl= $db->prepare('select id_client from pannier where id_Pannier=?');
    if (!empty($_POST['commantaire'])) {
    $stmCl->execute([$_GET['id']]);$cl=$stmCl->fetch(PDO::FETCH_OBJ);
    $stmCom= $db->prepare('update commantaire set vu=1 where id_command=?');
    $stmCom->execute([$_GET['id']]);
    $stmrep= $db->prepare('insert into 
    commantaire (desctreption,id_command,reponse, vu) values (?,?,1,1)');
    $stmrep->execute([$_POST['commantaire'],$_GET['id']]);}
    header("location:command-one.php?id=".$cl->id_client.'#C'.$_GET['id']);
    }
} else {
    header('location:../login-logout-signUp/login_one.php');
}