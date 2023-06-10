<?php session_start();require_once('../database/conexion.php');
if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;
if (!isset($_SESSION['id_client'])){
    header('location:../login-logout-signUp/login_one.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>Click_shop</title>
</head>
<body>
<div class="page-wrapper compact-wrapper" id="pageWrapper" >
    <?php  require_once('header.php'); ?>
    <main class="row mt-4">
        <?php $stm=$db->prepare('select id_Pannier,sum(qte_produit*prix_produit) sum from shop straight_join produit p on p.id_produit = shop.id_produit where id_Pannier in(select id_Pannier from pannier where id_client=?) and id_Pannier not in(select id_command from command)');
              $stm->execute([$_SESSION['id_client']]);
        $pannier=$stm->fetch(PDO::FETCH_OBJ);
              if($pannier):
                  $stms=$db->prepare('select s.id_Pannier, s.id_produit, s.qte_produit, p.nom_produit, p.prix_produit, p.description_produit,p.categorie, i.src_image1 from shop s join produit p on p.id_produit = s.id_produit  join images i on p.id_produit = i.id_image where id_Pannier=?');
                  $stms->execute([$pannier->id_Pannier]);$shop=$stms->fetchAll(PDO::FETCH_OBJ);
        ?>
              <div class="col-7 mx-auto">
                  <h4>votre Pannier </h4>
                    <table class="col-12" summary="New York City Marathon Results 2023">
            <thead>
            <tr><th>N°</th><th>image</th><th>titre</th><th>description</th><th>prix</th><th>quantite</th><th>action</th></tr>
            </thead>
            <tbody>
            <?php $i=1;
            foreach ($shop as $items):?>
            <tr><td><?=$i++?></td><td><img style="height: 50px;" src="<?=$items->src_image1?>" alt=''></td><td><?=$items->nom_produit?></td><td><?=$items->description_produit?></td><td><?= $items->prix_produit?></td><td><?=$items->qte_produit?></td> <td style="display: flex;flex-wrap: nowrap">
                    <div class="mx-auto">
                        <a onclick="return confirm('are you sure')" href="commantaire.php?id=<?=$pannier->id_Pannier.'&ref='.$items->id_produit?>" class="btn btn-danger p-2"><em class="bi bi-trash3">delete</em></a>
                    </div>
                </td></tr>
            <?php endforeach;?>
            </tbody>
        </table>
                  <?php if ($shop):?>
                  <div class="d-flex justify-content-between">
                      <div class="pt-2">
                          <a onclick="return confirm('do you want to valid this pannier')" href="commantaire.php?id=<?=$pannier->id_Pannier?>&valid=valid" class="btn btn-primary btn-sm" title="Upload new profile image"><em class="bi bi-check2-circle"></em></a>
                          <a onclick="return confirm('do you want to delete this pannier')" href="commantaire.php?id=<?=$pannier->id_Pannier?>&cancel=cancel" class="btn btn-danger btn-sm" title="Remove my profile image"><em class="bi bi-trash"></em></a>
                      </div>
                      <h4>total :<span class="text-danger"> <?=($pannier->sum)?$pannier->sum:0?>DH</span></h4>
                  </div>
                  <?php endif;?>

                  <?php
                  $stmsv=$db->prepare('select s.id_pannier,sum(s.qte_produit*p2.prix_produit) sum from shop s join pannier p on p.id_Pannier = s.id_Pannier join produit p2 on p2.id_produit = s.id_produit where p.id_client=? and s.id_Pannier in(select id_command from command where valid=0) group by s.id_Pannier');
                  $stmsv->execute([$_SESSION['id_client']]);$command=$stmsv->fetchAll(PDO::FETCH_OBJ);$i=1;
                  foreach ($command as $itemC):
                      $stmsv=$db->prepare('select * from shop s join produit p on p.id_produit = s.id_produit  join images i on p.id_produit = i.id_image where id_Pannier=?');
                      $stmsv->execute([$itemC->id_pannier]);$onecommand=$stmsv->fetchAll(PDO::FETCH_OBJ);
                      ?>
                      <div class="col-12 mt-5 mx-auto">
                          <h4 class="mt-5">Command <?=$i++?></h4>
                          <table class="col-12" style="background-color: rgba(46,202,106,0.47)"  summary="New York City Marathon Results 2013">
                              <thead>
                              <tr><th>N°</th><th>image</th><th>titre</th><th>description</th><th>prix</th><th>quantite</th></tr>
                              </thead>
                              <tbody>
                              <?php $i=1;
                              foreach ($onecommand as $OneItems):?>
                                  <tr><td><?=$i++?></td><td><img style="height: 50px;" src="<?=$OneItems->src_image1?>" alt=""></td><td><?=$OneItems->nom_produit?></td><td><?=$OneItems->description_produit?></td><td><?= $OneItems->prix_produit?></td><td><?=$OneItems->qte_produit?></td></tr>
                              <?php endforeach;?>
                              </tbody>
                          </table>
                              <h4>total :<span class="text-danger"><?= $itemC->sum?> DH</span></h4>
                          <div class="modal-body p-3 " style="background-color: rgba(12,84,96,0.46);border-radius: 20px">
                              <?php
                              $stmC=$db->prepare('select desctreption,reponse from commantaire where id_command=?');
                              $stmC->execute([$itemC->id_pannier]);$PanierComante=$stmC->fetchAll(PDO::FETCH_OBJ);
                              foreach ($PanierComante as $itemComante):?>
                                  <?php if ($itemComante->reponse===1):?>
                                      <div style="display:flex;justify-content:start">
                                          <img class="img-50 img-fluid m-r-10  rounded-circle " src="../assets/images/logo/logoClickShop.jpg" alt="">
                                          <div style="background-color: #1a4b41;border-radius: 10px 10px 10px 0px;padding: 10px;margin:10px;color: white"><?= $itemComante->desctreption ?></div>
                                      </div>
                                  <?php else:?>
                                      <div style="display:flex;justify-content:end">
                                          <div style="background-color: rgba(12,84,96,0.53);border-radius:10px 10px 0 10px;padding: 10px;margin:2px 0;color: white"><?= $itemComante->desctreption ?></div>
                                      </div>
                                  <?php endif;?>
                              <?php endforeach;?>
                              <form class="row py-3" method="post" action="commantaire.php?commante=true&id=<?=$itemC->id_pannier?>" id="Command<?=$itemC->id_Pannier?>">
                                  <div class="col-9 mx-auto">
                                      <label for="inputPassword2" class="visually-hidden">commantaire</label>
                                      <input type="text" class="form-control" name="commantaire" placeholder="commantaire">
                                  </div>
                                  <div class="col-3 mx-auto">
                                      <button type="submit" class="btn btn-primary mb-3">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                              <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                          </svg>
                                      </button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  <?php endforeach;?>
                  <?php
                  $stmsv=$db->prepare('select s.id_pannier,sum(s.qte_produit*p2.prix_produit) sum from shop s join pannier p on p.id_Pannier = s.id_Pannier join produit p2 on p2.id_produit = s.id_produit where p.id_client=? and s.id_Pannier in(select id_command from command where valid=1) group by s.id_Pannier');
                  $stmsv->execute([$_SESSION['id_client']]);$command=$stmsv->fetchAll(PDO::FETCH_OBJ);$i=1;
                  foreach ($command as $itemC):
                      $stmsv=$db->prepare('select * from shop s join produit p 
                        on p.id_produit = s.id_produit  join images i on p.id_produit = i.id_image 
                        where id_Pannier=?');
                      $stmsv->execute([$itemC->id_pannier]);$onecommand=$stmsv->fetchAll(PDO::FETCH_OBJ);
                      ?>
                      <div class="col-12 mt-5 mx-auto">
                          <h4 class="mt-5">Archif <?=$i++?></h4>
                          <table class="col-12"  summary="New York City Marathon Results 2013">
                              <thead>
                              <tr><th>N°</th>
                                  <th>image</th>
                                  <th>titre</th>
                                  <th>description</th>
                                  <th>prix</th>
                                  <th>quantite</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $i=1;
                              foreach ($onecommand as $OneItems):?>
                                  <tr><td><?=$i++?></td><td>
                                          <img style="height: 50px;" src="<?=$OneItems->src_image1?>" alt="">
                                      </td>
                                      <td><?=$OneItems->nom_produit?></td>
                                      <td><?=$OneItems->description_produit?></td>
                                      <td><?= $OneItems->prix_produit?></td>
                                      <td><?=$OneItems->qte_produit?></td>
                                  </tr>
                              <?php endforeach;?>
                              </tbody>
                          </table>
                          <div class="col-md-8 col-lg-9">
                              <div class="pt-2">
                                  <div class="pt-2">
                                      <a onclick="return confirm('voulliez vous re commander cette commande')" href="commantaire.php?id=<?=$itemC->id_pannier?>&update=update" class="btn btn-primary btn-sm" title="Upload new profile image"><em class="bi bi-check2-circle"></em></a>
                                      <a onclick="return confirm('vouhhiez vous supprimer cette commande dans l\'archif)" href="commantaire.php?id=<?=$itemC->id_pannier?>&cancel=cancel" class="btn btn-danger btn-sm" title="Remove my profile image"><em class="bi bi-trash"></em></a>
                                  </div>
                              </div>
                          </div>
                          <h4>total :<span class="text-danger"><?= $itemC->sum?> DH</span></h4>
                      </div>
                  <?php endforeach;?>
                  <?php
                  $total=$db->prepare('select sum(qte_produit*prix_produit) 
                    sum from shop straight_join produit p on p.id_produit = shop.id_produit 
                        where id_Pannier in(select id_Pannier from pannier where id_client=?)
                          and id_Pannier in(select id_command from command where valid=1)');
                  $total->execute([$_SESSION['id_client']]);$Total=$total->fetch(PDO::FETCH_OBJ);
                  if(isset($Total->sum)):?>
              </div>
                  <?php endif;?>
        <?php endif;?>
    </main><!-- End #main -->
</div>
<!-- footer start-->
<?php require_once('footer.php')?>
</body>
</html>