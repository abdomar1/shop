<?php
session_start();
if (isset($_SESSION['idPersone'])):
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
    <title>click_shop</title>
</head>
  <body>
    <div class="page-wrapper compact-wrapper" id="pageWrapper" >
        <?php require_once('header.php'); ?>
        <main id="main" class="main" >
            <?php if (isset($_GET['search'])):?>

                <div class="row p-4" id="container">
                    <?php
                    $stm=$db->prepare('SELECT * FROM click_shop.produit where categorie like ?');
                    $stm->execute(['%'.$_GET['search'].'%']);
                    $Produit=$stm->fetchAll(PDO::FETCH_OBJ);
                    foreach ($Produit as $item):
                        $stimage=$db->prepare('SELECT * FROM click_shop.images where id_image=?');
                        $stimage->execute([$item->id_produit]);
                        $img=$stimage->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="card col-3 rounded rounded-2">
                            <img src="<?= $img->src_image1?>" onmouseover="this.src='<?=isset($img->src_image2)?$img->src_image2:$img->src_image1?>'" onmouseleave="this.src='<?= $img->src_image1?>'" class="card-img-top h-50" alt="...">
                            <div class="card-body py-0 my-0 ">
                                <h5 class="card-title py-0 my-0"><?=$item->nom_produit?></h5>
                                <p class="card-text py-0 my-0"><?= $item->description_produit?></p>
                                <div class="row">
                                    <a onclick="return confirm('are you sure')"
                                       href="deleteProduit.php?id=<?=$item->id_produit?>&page=index"
                                       class="btn btn-danger p-2 m-1 col-5"><em class="bi bi-trash3"></em></a>
                                    <a href="editProduit.php?id=<?=$item->id_produit?>&page=index"
                                       class="btn btn-primary p-2 m-1 col-5"><em class="bi bi-pencil-fill"></em></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <?php unset($_GET['search']); endif;?>
            <?php if (isset($_GET['page'])&&$_GET['page']==='index'):?>
                    <div class="row p-4" id="container">
                        <?php foreach ($Produit as $item):
                            $stimage=$db->prepare('SELECT * FROM click_shop.images where id_image=?');
                            $stimage->execute([$item->id_produit]);
                            $img=$stimage->fetch(PDO::FETCH_OBJ);
                            ?>
                            <div class="card col-3 rounded rounded-2">
                                <img src="<?= $img->src_image1?>"
                                onmouseover="this.src='<?=isset($img->src_image2)?$img->src_image2:$img->src_image1?>'"
                                onmouseleave="this.src='<?= $img->src_image1?>'" class="card-img-top h-50" alt="...">
                                <div class="card-body py-0 my-0 ">
                                    <h5 class="card-title py-0 my-0"><?=$item->nom_produit?></h5>
                                    <p class="card-text py-0 my-0"><?= $item->description_produit?></p>
                                    <div class="row">
                                        <a onclick="return confirm('are you sure')"
                                           href="deleteProduit.php?id=<?=$item->id_produit?>&page=index"
                                           class="btn btn-danger p-2 m-1 col-5"><em class="bi bi-trash3"></em></a>
                                        <a href="editProduit.php?id=<?=$item->id_produit?>&page=index"
                                           class="btn btn-primary p-2 m-1 col-5"><em class="bi bi-pencil-fill"></em></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
            <?php endif;?>
            <?php if (isset($_GET['page'])&&$_GET['page']==='tableAllProduit'):?>

                    <div class="row p-4" id="container" >
                        <table summary="New York City Marathon Results 2013">
                            <thead>
                            <tr><th>id</th>
                                <th>image</th>
                                <th>titre</th>
                                <th>description</th>
                                <th>prix</th>
                                <th>quantite</th>
                                <th>action</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Produit as $item):
                                $stimage=$db->prepare('SELECT * FROM click_shop.images where id_image=?');
                                $stimage->execute([$item->id_produit]);
                                $img=$stimage->fetch(PDO::FETCH_OBJ);
                                ?>
                                <tr>
                                    <td><?= $item->id_produit?></td>
                                    <td><img src="<?=$img->src_image1?>"
                                    onmouseover="this.src='<?=isset($img->src_image2)?$img->src_image2:$img->src_image1?>'"
                                    onmouseleave="this.src='<?= $img->src_image1?>'" class="card-img-top"
                                             style="width: 50px;max-width: 100%" alt="..."></td>
                                    <td><?=$item->nom_produit?></td>
                                    <td><?= $item->description_produit?></td>
                                    <td><?= $item->prix_produit?></td>
                                    <td><?= $item->qte_stock?></td>
                                    <td style="display: flex;flex-wrap: nowrap">
                                        <div class="mx-auto">
                                            <a onclick="return confirm('are you sure')"
                                               href="deleteProduit.php?id=<?=$item->id_produit?>&page=tableAllProduit"
                                               class="btn btn-danger p-2"><em class="bi bi-trash3">delete</em></a>
                                            <a href="editProduit.php?id=<?=$item->id_produit?>&page=tableAllProduit"
                                               class="btn btn-primary p-2"><em class="bi bi-pencil-fill">edit</em></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
            <?php endif;?>
        </main>

    </div>
    <!-- footer start-->
    <?php require_once('footer.php')?>
  </body>
</html>
<?php
else :
    header('location:../login-logout-signUp/login_one.php');
endif;
ob_end_flush();?>