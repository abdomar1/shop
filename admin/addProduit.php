<?php
session_start();
if (isset($_SESSION['idPersone'])) {
    if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>click_shop</title>
</head>

<body>
<div class="page-wrapper compact-wrapper" id="pageWrapper" >
    <?php require_once('header.php') ?>
    <div class="row py-5" style="display: flex;justify-content: flex-end;margin-top: 60px">
        <div class="col-3"></div>
        <form method="post" action="Add.php" class="col-7 mx-auto"
              enctype="multipart/form-data">
            <div class="row">
                <div>
                    <div class="content-header">
                        <h2 class="content-title">Ajouter un nouveau produit</h2>
                    </div>
                </div>
                <div>
                    <div class="card mb-4" id="container">
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Titre de produit</label>
                                <input type="text" placeholder="Type here"
                                       name="titre" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Description du produit</label>
                                <textarea placeholder="Type here"
                                          name="des" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Details du produit</label>
                                <textarea placeholder="Type here" name="det"
                                          class="form-control" rows="4"></textarea>
                            </div>
                            <div class="row p-3">
                                <div class="row col-4 gx-3">
                                    <label for="product_Stock" class="form-label">Prix</label>
                                    <input type="text" placeholder="Prix" name="prix" class="form-control">
                                </div>
                                <div class="row col-4 gx-3">
                                    <label for="product_Stock" class="form-label">Stock</label>
                                    <input type="text" placeholder="Stock" name="stock" class="form-control">
                                </div>
                                <div class="row col-4 gx-3">
                                    <label for="categorie" class="form-label">Categorie</label>
                                    <select name="categorie" class="form-select form-select-lg"
                                            aria-label=".form-select-lg example" id="categorie">
                                        <option selected disabled>Selectionner une categorie</option>
                                        <option value="phone">telephone</option>
                                        <option value="pc">Ordinateur</option>
                                        <option value="accesoir">accesoire</option>
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
                                   class="btn btn-primary rounded text-white font-sm hover-up"
                                   value="Enregistrer">
                            <input  type="reset"
                                    class="btn btn-danger rounded font-sm mr-5 text-white hover-up"
                                    value="Vider">
                        </div>
                    </div> <!-- card end// -->
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once('footer.php')?>
</body>
</html>
<?php
} else {
    header('Location:../login-logout-signUp/login_one.php');
}
