<?php
require_once("../database/conexion.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>Click_shop</title>
</head>

<body>
<?php require_once('header.php')?>
<div class="row bb">
            <div class="col-md-3 bbb">
                <a href="#"> <img src="../assets/images/products/3/bup.png" style="height: 350px;width:300px" alt="..." />
                    <h2 style="color: red;font-size:40px;font-weight:bold">Meilleures offres</h2>
                </a>
            </div>
            <div id="carouselExampleDark" class="container pub mt-1 carousel col-md-7 carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <div class=" carousel-inner bup ">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="../assets/images/products/3/phoneeee.webp" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Télephone</h1>
                 <h3>Pour plus d'informations, <a href="#" style="color: orangered;"> cliquez ici</a></h3></form>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="../assets/images/products/3/ordinateur.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Ordinateur</h1>
                            <h3>Pour plus d'informations, <a style="color: orangered;" href="#"> cliquez ici</a></h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/images/products/3/acci.jpeg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Accessoires</h1>
                            <h3>Pour plus d'informations, <a style="color: orangered;" href="#"> cliquez ici</a></h3>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" id="BU" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" id="BU" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
</div>
<!-- ===================== les produit mn labase de donnée ============== -->
<?php
$nom_bar="Produit";
$req="select id_produit,src_image1,src_image2 ,prix_produit,description_produit,nom_produit from produit P inner join images I on I.id_image=P.id_produit ";


//navbare de name de produit phone-->
?>
  <div class="bg-success navpro m-1 p-3 " id="Samsung">
    <em class="navpro"> <?=$nom_bar?> </em>
</div>

<?php
$produit = $db->prepare($req);
$produit->execute();
$bocl = $produit->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row row-cols-1 row-cols-md-3 g-4 produit p-4 m-3" >
    <?php foreach ($bocl as $pro) {?>
        <a id="lientGoToPanier" href="ProduitChoisi.php?ref=<?= $pro->id_produit?>" class=" col-lg-3 col-md-6 col-sm-12">
            <div class="card mx-auto rounded p-2">
                <img src="<?= $pro->src_image2 ?>" alt="..." onmouseover="this.src='<?=$pro->src_image1?>'" onmouseleave="this.src='<?= $pro->src_image2 ?>'"  class="card-img-top mx-auto" id="pro" >
                <div class="card-body mx-auto p-0">
                    <h4 class="card-title"><?= $pro->nom_produit ?></h4>
                    <h5 class="card-title">Prix :<strong class="text-danger"> <?= $pro->prix_produit ?></strong></h5>
                    <h5 class="card-text fs-6"><?= $pro->description_produit ?></h5>
                    <div class="block ">
                    <div class="card-title m-2 shop" >
                    <button class="py-2 d-flex gap-2 align-items-center btn btn-Ajouter ">
                    <em class="fa-solid fa-cart-plus"></em><span class="Ajouter">Ajotuer</span>
                    </button>
                    </div>
                    </div>
                </div>
            </div>
        </a>
    <?php }; ?>
</div><br>   


<?php require_once('footer.php') ?>
</body>

</html>