<?php
session_start();
ob_start();if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;
if (isset($_SESSION['idPersone'])):
if (isset($_GET['id'])):
require_once('../database/conexion.php');
$stm = $db->prepare('SELECT * FROM click_shop.produit where  id_produit=?');
$stm->execute([$_GET['id']]);
if ($produit=$stm->fetch(PDO::FETCH_OBJ)):
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
    <div class="row py-5"  >
        <div class="col-3" ></div>
        <form method="post" action="edit.php?id=<?=$_GET['id']?>&page=<?=$_GET['page']?>"
              class="col-7 mx-auto p-5" enctype="multipart/form-data" id="container" >
            <div class="row">
                <div>
                    <div class="content-header">
                        <h2 class="content-title">Modifier le produit</h2>
                    </div>
                </div>
                <div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Titre produit</label>
                                <input type="text" placeholder="Type here"
                                       value="<?=isset($produit->nom_produit)?$produit->nom_produit:''?>"
                                       name="titre" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">description</label>
                                <textarea placeholder="Type here" name="des"
                                          class="form-control" rows="4">
                                    <?=isset($produit->description_produit)?$produit->description_produit:''?>
                                </textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">details du produit</label>
                                <textarea placeholder="Type here" name="det" class="form-control"
                                          rows="4"><?=isset($produit->details_produit)?$produit->details_produit:''?>
                                </textarea>
                            </div>
                            <div class="row p-3">
                            <div class="row col-4 gx-3">
                                <label for="product_Stock" class="form-label">Prix</label>
                                <input type="text" placeholder="Prix" name="prix"
                                       value="<?=isset($produit->prix_produit)?$produit->prix_produit:''?>"
                                       class="form-control">
                            </div>
                            <div class="row col-4 gx-3">
                                <label for="product_Stock" class="form-label">Stock</label>
                                <input type="text" placeholder="Stock"
                                       value="<?=isset($produit->qte_stock)?$produit->qte_stock:''?>"
                                       name="stock" class="form-control">
                            </div>
                                <div class="row col-4 gx-3">
                                    <label for="categorie" class="form-label">Categorie</label>
                                    <select name="categorie" class="form-select form-select-lg"
                                            aria-label=".form-select-lg example" id="categorie">
                                        <option selected disabled>Selectionne une categorie</option>
                                        <option <?=($produit->categorie==='phone')?'selected':''?>
                                                value="phone">Telephone</option>
                                        <option <?=($produit->categorie==='pc')?'selected':''?>
                                                value="pc">Ordinateur</option>
                                        <option <?=($produit->categorie==='accesoir')?'selected':''?>
                                                value="accesoir">accesoire</option>
                                    </select>
                            </div>
                        </div>
                            <div class="input-upload" >
                                <input  name="MAX_FILE_SIZE" value="102400" type="hidden">
                                <input class="form-control" name="file[]" multiple="multiple"
                                       accept="image/*" type="file">
                            </div>
                        </div>
                        <div class="p-3">
                            <input type="submit" name="submit"
                                   class="btn btn-primary rounded text-white font-sm hover-up" value="Enregister">
                            <input  type="reset"  class="btn btn-danger rounded font-sm mr-5 text-white hover-up"
                                    value="Vider">
                        </div>
                    </div> <!-- card end// -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- footer start-->
<?php require_once('footer.php')?>
</body>
</html>
<?php
else:
    if ($_GET['page'] === 'index') {
        header("Location:index.php?page=index");
    }
    if ($_GET['page'] === 'tableAllProduit') {
        header("Location:index.php?page=tableAllProduit");
    }
endif;
endif;
else:
    header('location:../login-logout-signUp/login_one.php');
endif;
ob_end_flush();?>
