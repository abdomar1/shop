<?php
ob_start();
session_start();
require_once("../database/conexion.php");
?>
<style>
#price_produit{
    color: #298877;
    font-size: 22px;
    font-weight: 600;
}
#btn_ajouter_pannier{
    background-color: #298877;
}
#btn_ajouter_pannier:hover{
    background-color: #1a4039;
}
#btn_annuler_pannier{
    background-color: #b50808;
}
#btn_annuler_pannier:hover{
    background-color:#851111;
}
#imgBanner .img{
    transition: .4s;
}
#imgBanner .img:hover{
    transform: scale(1.1);
}
/* ----------class defini------*/
.color-green{
    color: #298877;
}
.border-radio{
    border: 1px solid #298877;
    padding: 6px;
}
/* -------------------------*/


</style>
<?php

if(isset($_GET['ref'])){
    $id_produit=$_GET['ref'];
    $produit = $db->prepare("select * from produit P inner join images I on I.id_image=P.id_produit where id_produit=:idProd");
    $produit->execute([':idProd'=>$id_produit]);
    $affcher = $produit->fetch(PDO::FETCH_OBJ);
    }
//-------

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>Click_shop</title>
</head>
<!-- premire nav bare-->
<body>
<?php require_once('header.php') ;
?>
<section id="produit">
    <div class="container card shadow-lg mt-4">
        <form  method="POST" >
        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex justify-content-center  position-relative overflow-hidden" id="imgBanner"> 
                     <img src="<?= $affcher->src_image2 ?>" class="img" alt=""/>
                </div>
                <div class="form-row pt-4 font-size-16 font-baloo d-flex gap-3">
                <div class="col-6">
                        <a href="indexClient.php" style="text-decoration: none" class="btn p-2 text-light form-control p-3 fs-5" id="btn_annuler_pannier">Anuler</a>
                </div>
                    <div class="col-6">
                        <input type="submit" name="ajo" class="btn text-light form-control p-3 fs-5" id="btn_ajouter_pannier" value="Ajouter au panier">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-5">
            <h5 class="font-baloo font-size-20"><?php echo $affcher->description_produit?></h5>
            <small>by Samsung</small>
            <div class="d-flex gap-3 mt-3">
            <div class="rating text-warning font-size-12 ">
                        <span><em class="fas fa-star"></em></span>
                        <span><em class="fas fa-star"></em></span>
                        <span><em class="fas fa-star"></em></span>
                        <span><em class="fas fa-star"></em></span>
                        <span><em class="far fa-star"></em></span>
            </div>
            </div>
            <hr class="m-3">

             <!---    product price       -->
             
             <div id="price_produit">
             <?php echo $affcher->prix_produit?> MAD
             </div>

                <!-- service -->
                <div class="d-flex justify-content-center align-items-center mt-3 gap-2">
                <div class="col-4 d-flex justify-content-center align-items-center gap-1">
                <em class="bi bi-currency-dollar border p-3 rounded-pill"></em>
                <div>Paiement à la livraision</div>
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center gap-1">
                <span class="fas fa-truck  border p-3 rounded-pill"></span>
                <div>Livraison gratuite</div>
                </div>
                <div class=" col-4 d-flex justify-content-center align-items-center gap-1">
                <span class="fas fa-check-double border p-3 rounded-pill"></span>
                <div>Garantie sans tracas</div>
                </div>
                </div>
                    <hr class="mt-4">

                      <!-- order-details -->
                <div id="order-details" class="font-rale d-flex flex-column text-dark">
                    <small>Delivery by : <?=date("d.m.Y H:i:s") ?></small>
                    <small>Sold by <a href="#">mohamed said </a>(4.5 out of 5 | 18,198 ratings)</small>
                    <small><em class="fas fa-map-marker-alt color-primary"></em>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                </div>
                 <!-- !order-details -->

                 <div class="row d-flex justify-content-end mt-2">
                    <div class="col-6">
                        <!-- product qty section -->
                        <div class="qty d-flex">
                            <h6 class="font-baloo color-green">Qty</h6>
                            <div class="px-4 d-flex font-rale">
                                <button type="button" class="qty-up border" data-id="pro1" id="btnUp" onclick="toggleQuantet(1)"><em class="fas fa-angle-up"></em></button>
                                <input type="text" data-id="pro1" name="quantit" class="border px-2 w-50 " id="valQuantit"  value="1" placeholder="1">
                                <button type="button" data-id="pro1" class="qty-down border " id="btnDown" onclick="toggleQuantet(-1)"><em class="fas fa-angle-down"></em></button>
                            </div>
                        </div>
                        <!-- !product qty section -->
                    </div>
                </div>

            <!-- Product Description -->

        </div>
        <div class="col-12 mt-5">
                <h6 class="font-rubik color-green fs-3 ">Product Description</h6>
                <hr>
              <p class="font-rale font-size-14"><?php echo $affcher->details_produit?></p>
         </div>
    </div>
   </form>
  </div>
</section>
<?php
if (isset($_POST['ajo'])) {
    if (isset($_SESSION['id_client'])) {
        $idC=$_SESSION['id_client'];
        $quantit=$_POST['quantit'];
        $prep=$db->prepare("SELECT * FROM pannier where id_client=? and id_Pannier not in(select id_command from command)");
        $prep->execute([$idC]);
        $client=$prep->fetch(PDO::FETCH_OBJ);
        if (!$client) {
            $rmplitShop = $db->prepare('insert into pannier values(default,?)');
            $rmplitShop->execute([$idC]);
            $prep=$db->prepare("SELECT * FROM pannier where id_client=? and id_Pannier not in(select id_command from command)");
            $prep->execute([$idC]);
            $client=$prep->fetch(PDO::FETCH_OBJ);
        }
        $exist=$db->prepare("select * from shop where id_Pannier=? and id_produit=?");
        $exist->execute([$client->id_Pannier,$id_produit]);$exists=$exist->fetch(PDO::FETCH_OBJ);
        if (!$exists) {
            $rmplitShop = $db->prepare('insert into shop values(?,?,?)');
            $rmplitShop->execute([$client->id_Pannier,$id_produit,$quantit]);
            header('Location:indexClient.php');
        } else {
            header('Location:Pannier.php');
        }

    } else {
        header('Location:../login-logout-signUp/login_one.php');
        ob_end_flush();
    }

}
?>
<div class="w-100"> <?php require_once('footer.php')?></div>
</body>
</html>