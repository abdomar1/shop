<?php session_start();
if (isset($_SESSION['error'])):echo $_SESSION['error'];unset($_SESSION['error']);endif;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('head.php')?>
    <title>click_shop</title>
</head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <?php require_once('header.php')?>
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
 <div class="container-fluid">
     <div class="email-wrap bookmark-wrap">
     <div class="row">
     <div class="col-md-12 box-col-8 xl-70">
     <div class="email-right-aside bookmark-tabcontent contacts-tabs">
     <div class="card email-body radius-left">
     <div class="ps-0">
         <div class="tab-content">
             <div class="tab-pane fade active show" id="pills-personal"
                  role="tabpanel" aria-labelledby="pills-personal-tab">
                 <div class="card mb-0">
                     <div class="card-header d-flex">
                         <h5>Command</h5>
                     </div>
                     <div class="card-body p-0">
                         <div class="row list-persons" id="addcon">
                             <div class="col-xl-4 xl-50 col-md-5 box-col-6">
                                 <div class="nav flex-column flex-nowrap nav-pills" id="v-pills-tab"
                                      role="tablist" aria-orientation="vertical"
     <?php require_once('../database/conexion.php');
     $stmtClient=$db->prepare("SELECT id_client, 
       nom_clinet, Adress_client, tel_client,
       type_client,sexe,profil_client,email 
        from client where id_client in
        (select id_client from pannier p 
            cross join command c 
                on p.id_Pannier = c.id_command 
                       and valid=false)");
     $stmtClient->execute();$client=$stmtClient->fetchAll(PDO::FETCH_OBJ);
                                                       foreach ($client as $item):
                                                                    ?>
     <a class="contact-tab-1 nav-link"
        id="v-pills-profile-tab" data-bs-toggle="pill"
        href="#v-pills-profile<?=$item->id_client?>"
        role="tab" aria-controls="v-pills-profile"
        aria-selected="false"><div class="media">
             <img class="img-50 img-fluid m-r-20 rounded-circle update_img_1"
                  src="<?=$item->profil_client?>" alt="">
             <div class="media-body">
                 <h6> <span class="first_name_1"><?=$item->nom_clinet?></span></h6>
                 <p class="email_add_1"><?=$item->email?>
                 </p>
             </div>
         </div>
        </a><?php endforeach;?>
        </div></div>
                         <div class="col-xl-8 xl-50 col-md-7 box-col-6">
                             <div class="tab-content" id="v-pills-tabContent">
                                 <?php foreach ($client as $itemCl):?>
                                     <div class="tab-pane contact-tab-1 tab-content-child fade"
                                          id="v-pills-profile<?=$itemCl->id_client?>"
                                          role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                         <div class="profile-mail">
                                             <div class="media">
                                                 <img class="img-100 img-fluid m-r-20 rounded-circle update_img_1"
                                                      src="<?=$itemCl->profil_client?>" alt="">
                                                 <input class="updateimg" type="file" name="img">
                                                 <div class="media-body mt-0">
                                                     <h5><span class="first_name_1">
                                                             <?=$itemCl->nom_clinet?></span></h5>
                                                     <p class="email_add_1"><?=$itemCl->email?></p>
                                                 </div>
                                             </div>
                                             <div class="email-general">
                                                 <h6 class="mb-3">General</h6>
                                                 <ul>
                                                     <li>Nom complet
                                                         <span class="font-primary first_name_1">
                                                             <?=$itemCl->nom_clinet?></span></li>
                                                     <li>Genre
                                                         <span class="font-primary">
                                                             <?=$itemCl->sexe?></span>
                                                     </li>
                                                     <li>Adresse
                                                         <span class="font-primary city_1">
                                                             <?=$itemCl->Adress_client?></span>
                                                     </li>
                                                     <li>Tel
                                                         <span class="font-primary mobile_num_1">
                                                             <?=$itemCl->tel_client?></span>
                                                     </li>
                                                     <li>Email
                                                         <span class="font-primary email_add_1">
                                                             <?=$itemCl->email?></span>
                                                     </li>
                                                     <li>type
                                                         <span class="font-primary interest_1">
                                                             <?=$itemCl->type_client?></span>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div>
 <?php $stmPN=$db->prepare('select id_Pannier
from pannier where id_client=:idCl and
id_Pannier in(select id_command from command where valid=false)');
 $stmPN->execute([':idCl'=>$itemCl->id_client]);
 $Panier=$stmPN->fetchAll(PDO::FETCH_OBJ);$i=1;
 foreach ($Panier as $itemPN):
     $stmCmante=$db->prepare('select pannier.id_client,commantaire.desctreption,commantaire.reponse
    from pannier,command,commantaire where pannier.id_Pannier=command.id_command
    and command.id_command=commantaire.id_command and id_Pannier=?');
 $stmCmante->execute([$itemPN->id_Pannier]);
 $PanierComante=$stmCmante->fetchAll(PDO::FETCH_OBJ);
 ?>
     <div class="modal-body">
         <div class="card-header d-flex">
             <h5>pannier <?=$i++?></h5>
         </div>
         <table class="col-12" summary="New York City Marathon Results 2013">
             <thead>
             <tr>
                 <th>id</th>
                 <th>image</th>
                 <th>titre</th>
                 <th>description</th>
                 <th>prix</th>
                 <th>quantité</th>
                 <th>action</th>
             </tr>
             </thead>
             <tbody>
             <?php
             $stm=$db->prepare('select * from produit p join shop s 
                on p.id_produit = s.id_produit where s.id_Pannier=:id ');
             $stm->execute([':id'=>$itemPN->id_Pannier]);
             $Produit=$stm->fetchAll(PDO::FETCH_OBJ);
             foreach ($Produit as $itemPr):
                 $stimage=$db->prepare('SELECT * FROM click_shop.images where id_image=?');
             $stimage->execute([$itemPr->id_produit]);$img=$stimage->fetch(PDO::FETCH_OBJ); ?>
                 <tr>
                     <td><?= $itemPr->id_produit?></td>
                     <td><img src="<?=$img->src_image1?>"
                              onmouseover="this.src='<?=isset($img->src_image2)?$img->src_image2:$img->src_image1?>'"
                              onmouseleave="this.src='<?= $img->src_image1?>'" class="card-img-top"
                              style="width: 50px;max-width: 100%" alt="..."></td>
                     <td><?=$itemPr->nom_produit?></td>
                     <td><?= $itemPr->description_produit?></td>
                     <td><?= $itemPr->prix_produit?></td>
                     <td><?= $itemPr->qte_produit?></td>
                     <td style="display: flex;flex-wrap: nowrap">
                         <div class="mx-auto">
                             <a onclick="return confirm('are you sure')"
                                href="#" class="btn btn-danger p-2">
                                 <em class="bi bi-trash3">delete</em></a>
                             <a href="#" class="btn btn-primary p-2">
                                 <em class="bi bi-pencil-fill">edit</em></a>
                         </div>
                     </td>
                 </tr>
             <?php endforeach;?>
             </tbody>
         </table>
         <div class="col-md-8 col-lg-9">
             <div class="pt-2">
                 <a onclick="return confirm('do you want to valid this pannier')"
                    href="notification.php?id=<?=$itemPN->id_Pannier?>&valid=cammand"
                    class="btn btn-primary btn-sm" title="Upload new profile image">
                     <em class="bi bi-check2-circle"></em></a>
                 <a onclick="return confirm('do you want to delete this pannier')"
                    href="notification.php?id=<?=$itemPN->id_Pannier?>&valid=cancel"
                    class="btn btn-danger btn-sm" title="Remove my profile image">
                     <em class="bi bi-trash"></em></a>
             </div>
         </div>
     </div>
 <?php endforeach;?>
                                         <div class="modal-body p-3 " style="background-color: rgba(12,84,96,0.46);border-radius: 20px">
                                             <?php foreach ($PanierComante as $itemComante):?>
                                                 <?php if ($itemComante->reponse===0):?>
                                                     <div style="display:flex;justify-content:start">
                                                         <img class="img-50 img-fluid m-r-10  rounded-circle " src="<?=$itemCl->profil_client?>" alt="">
                                                         <div style="background-color: #1a4b41;border-radius: 10px 10px 10px 0px;padding: 10px;margin:10px;color: white"><?= $itemComante->desctreption ?></div>
                                                     </div>
                                                 <?php else:?>
                                                     <div style="display:flex;justify-content:end">
                                                         <div style="background-color: rgba(12,84,96,0.53);border-radius:10px 10px 0 10px;padding: 10px;margin:2px 0;color: white"><?= $itemComante->desctreption ?></div>
                                                     </div>
                                                 <?php endif;?>
                                             <?php endforeach;?>
                                             <form class="row py-3" method="post"
                                                   action="notification.php?notification=see&id=<?=$itemPN->id_Pannier?>"
                                                   id="C<?=$itemPN->id_Pannier?>">
                                                 <div class="col-9 mx-auto">
                                                     <label for="inputPassword2"
                                                            class="visually-hidden">commantaire</label>
                                                     <input type="text" class="form-control"
                                                            name="commantaire" placeholder="commantaire">
                                                 </div>
                                                 <div class="col-3 mx-auto">
                                                     <button type="btncommantaire" class="btn btn-primary mb-3">
                                                         <svg xmlns="http://www.w3.org/2000/svg"
                                                              width="16" height="16" fill="currentColor"
                                                              class="bi bi-send-fill" viewBox="0 0 16 16">
                                                             <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767
                                                                     5.855H.766l-.452.18a.5.5 0 0
                                                                     0-.082.887l.41.26.001.002
                                                                     4.995 3.178 3.178 4.995.002.002.26.41a.5.5
                                                                     0 0 0 .886-.083l6-15Zm-1.833
                                                                     1.89L6.637 10.07l-.215-.338a.5.5 0
                                                                      0 0-.154-.154l-.338-.215 7.494-7.494
                                                                      1.178-.471-.47 1.178Z"/>
                                                         </svg>
                                                     </button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 <?php endforeach;?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     </div>
     </div>
     </div>
     </div>
     </div>
 </div></div><!-- Container-fluid Ends--></div><!-- footer start-->
        <?php require_once('footer.php')?>
  </body>
</html>