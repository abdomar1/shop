<?php
require_once('../database/conexion.php');
if (isset($_GET['id'])&&isset($_GET['ref'])):
    $stmrep= $db->prepare('delete from shop where id_Pannier=? and id_produit=?');
    $stmrep->execute([$_GET['id'],$_GET['ref']]);
    header("location:Pannier.php");
endif;
if (isset($_GET['id'])&&isset($_GET['valid'])):
$stmrep= $db->prepare('insert into command (id_command) values (?)');
$stmrep->execute([$_GET['id']]);
    header("location:Pannier.php");
endif;
if (isset($_GET['id'])&&isset($_GET['update'])):
$stmrep= $db->prepare('update command set valid=0 where id_command=?');
$stmrep->execute([$_GET['id']]);
    header("location:Pannier.php");
endif;
if (isset($_GET['id'])&&isset($_GET['cancel'])):
$stmrep= $db->prepare('delete from shop where id_Pannier=?');
$stmrep->execute([$_GET['id']]);
    header("location:Pannier.php");
endif;
if (isset($_GET['id'])&&isset($_GET['commante'])):
$stmrep= $db->prepare('insert into commantaire (desctreption,id_command) values (?,?)');
$stmrep->execute([$_POST['commantaire'],$_GET['id']]);
header("location:Pannier.php#Command".$_GET['id']);
endif;

