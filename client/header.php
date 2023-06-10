<?php
if (!isset($_SESSION['id_client'])):?>
    <div style="background-color: rgba(12,84,96,0.29)">
    <ul class="nav justify-content-evenly p-1 ">
    <li class="nav-item">
        <a class="nav-link"><em class="ico fa-regular fa-envelope"></em> Service.client@click.shop.ma</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active " aria-current="page" href="#">
            <em class="ico fa-solid fa-phone"></em>+21268048222</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="#"> Comparer </a>
    </li>
</ul>
    </div>
<?php endif;?>
<div class="page-main-header" style="position: sticky;top: 0;z-index: 1000;background-color:white">
        <div class="main-header-right row m-0">
            <div class="main-header-left">
                <div class="logo-wrapper">
                    <a href="indexClient.php?page=index" style="font-weight:bold;display: flex;align-items: center;font-size: 18px">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"  fill="currentColor" class="bi bi-cart4"
                     viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0
                0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3
                0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0
                5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2
                1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>Click_shop</a></div>
            </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <form class="form-inline search-form">
                        <div class="search-bg"><em class="fa fa-search"></em>
                            <input class="form-control-plaintext" placeholder="Search here.....">
                        </div>
                    </form><span class="d-sm-none mobile-search search-bg"><em class="fa fa-search"></em></span>
                </li>
            </ul>
        </div>
        
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <em data-feather="maximize"></em></a></li>
                <li class="onhover-dropdown">
                    <div class="notification-box"><em data-feather="bell"></em><span class="dot-animated"></span></div>
                    <?php if (isset($_SESSION['id_client'])):?>
                    <ul class="notification-dropdown onhover-show-div">
                        <?php
                        $comante=$db->prepare('select desctreption,date_comante from commantaire
                                 where reponse=1 and id_command in (select id_Pannier from pannier where id_client=?)');
                        $comante->execute([$_SESSION['id_client']]);$comantaire=$comante->fetchAll(PDO::FETCH_OBJ);
                        foreach ($comantaire as $item):
                        ?>
                        <li>
                        <a href="Pannier.php?id=<?=$_SESSION['id_client']?>" class="noti-secondary">
                            <div class="media"><span class="notification-bg bg-light-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="32" height="32"  fill="currentColor"
                                         class="bi bi-cart4" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1
                .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0
                1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11
                3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0
                0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1
                1 4 0 2 2 0 0 1-4 0z"/>
                </svg></span>
                                <div class="media-body">
                                    <p>click_shop</p><span><?= $item->date_comante?></span>
                                </div>
                            </div></a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>
                </li>
                <!-- sall -->
                <?php if (isset($_SESSION['id_client'])):?>
                <li class="onhover-dropdown">
                    <span class="d-flex justify-content-center align-items-center gap-1 ">
                    <em class="bi bi-cart-check-fill fs-5"></em>
                        <?php
                            $panner=$db->prepare("select count(s.id_produit) count from shop s join pannier Pn 
                on s.id_Pannier=Pn.id_Pannier where id_client=? && s.id_Pannier not in(select id_command from command)");
                            $panner->execute([$_SESSION['id_client']]);
                            $cont=$panner->fetch(PDO::FETCH_OBJ);
                        ?>
                    <span class="fs-8 bg-primary d-flex" style="padding:0 5px;border-radius: 20px"><?=$cont->count?></span>
                    <ul class="chat-dropdown onhover-show-div">
                    <?php
                    if(isset($_SESSION['id_client'])){
                              $panrChoix=$db->prepare("select * from pannier P inner join shop S 
                                on P.id_Pannier=S.id_Pannier inner join produit Pr on S.id_produit=Pr.id_produit
                              inner join images I on Pr.id_produit=I.id_image and P.id_client=? 
                                                         and P.id_Pannier not in(select id_command from command)");
                              $panrChoix->execute([$_SESSION['id_client']]);
                              $afchpanrChoix = $panrChoix->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(isset($afchpanrChoix[0]["src_image2"] )&& isset($afchpanrChoix[0]["nom_produit"])
                            && isset($afchpanrChoix[0]["prix_produit"]) ){ ?>
                        <li>
                            <div class="media"><img class="img-fluid rounded-circle me-3"
                                                    src="<?=$afchpanrChoix[0]["src_image2"]?>" alt="">
                                <div class="media-body"><span><?php echo $afchpanrChoix[0]["nom_produit"]?></span>
                                    <p class="f-12 light-font">Prix <?php echo $afchpanrChoix[0]["prix_produit"]?>DHs</p>
                                </div>
                                <p class="f-12"><?= date("d/m/Y")?></p>
                            </div>
                        </li>
                        <?php }
                        if(isset($afchpanrChoix[1]["src_image2"] )&& isset($afchpanrChoix[1]["nom_produit"]) && isset($afchpanrChoix[1]["prix_produit"]) ){
                        ?>
                        <li>
                            <div class="media"><img class="img-fluid rounded-circle me-3"
                                                    src="<?=$afchpanrChoix[1]["src_image2"]?>" alt="">
                                <div class="media-body"><span><?php echo $afchpanrChoix[1]["nom_produit"]?></span>
                                <p class="f-12 light-font">Prix <?php echo $afchpanrChoix[1]["prix_produit"]?>DHs</p>
                                </div>
                                <p class="f-12"><?= date("d/m/Y")?></p>
                            </div>
                           
                        </li>
                        <?php } 
                          if(isset($afchpanrChoix[2]["src_image2"] )&& isset($afchpanrChoix[2]["nom_produit"]) &&
                              isset($afchpanrChoix[2]["prix_produit"]) ){
                        ?>
                        <li>
                            <div class="media"><img class="img-fluid rounded-circle me-3"
                                                    src="<?=$afchpanrChoix[2]["src_image2"]?>" alt="">
                                <div class="media-body"><span><?php echo $afchpanrChoix[2]["nom_produit"]?></span>
                                    <p class="f-12 light-font">Prix <?php echo $afchpanrChoix[2]["prix_produit"]?>DHs</p>
                                </div>
                                <p class="f-12"><?= date("d/m/Y")?></p>
                            </div>
                        </li>
                        <?php }}?>
                       
                        <!-- <?php //}?> -->
                        <li class="text-center"> <a class="f-w-700" href="Pannier.php">See All</a></li>
                    </ul>
                </li>
                <?php
                endif;
                if (isset($_SESSION['id_client'])):?>
                <li>
                    <a href="User-Profile.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi
                    bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242
                        11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg></a>
                </li>
                <?php endif;?>
                <li class="onhover-dropdown p-0">
                    <button class="btn btn-primary-light" type="button"><?php if(isset($_SESSION['id_client'])):?>
                            <a href="../login-logout-signUp/lougout.php?client=logout">
                                <em data-feather="log-out"></em>Log out</a><?php else:?>
                            <a href="../login-logout-signUp/lougout.php"><em data-feather="log-in">
                                </em>Log in</a><?php endif; ?></button>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><em data-feather="more-horizontal"></em></div>
    </div>
</div>
<form  method="post">
    <nav id="nav" class="nav nav-pills flex-column flex-sm-row bg-success p-2 rela ">
           <div class="flex-sm-fill colum hover" id="sous-nav1">
            <a class="text-sm-center nav-link text-white" aria-current="page" href="indexClient.php" style="display: flex;align-items: center;margin: 0 auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house-door"
                 viewBox="0 0 16 16">
  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0
  0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354
  1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
</svg> HOME</a>
            </div>
        <div class="flex-sm-fill colum hover" id="sous-nav1">
            <a class="text-sm-center nav-link text-white" aria-current="page" href="ProduitAfficher.php?name=phone"
               style="display: flex;align-items: center;margin: 0 auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-phone"
                     viewBox="0 0 16 16">
                    <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2
                    2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                    <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                </svg>Téléphones portables</a>
        </div>
        <div class="flex-sm-fill colum hover" id="sous-nav2">
            <a class="text-sm-center nav-link text-white" href="ProduitAfficher.php?name=pc" style="display: flex;align-items: center;margin: 0 auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-pc-display-horizontal" viewBox="0 0 16 16">
                    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v7A1.5 1.5 0 0 0 1.5 10H6v1H1a1 1 0 0 0-1
                    1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5v-1h4.5A1.5 1.5 0 0 0 16 8.5v-7A1.5 1.5 0 0 0
                    14.5 0h-13Zm0 1h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .5-.5ZM12
                    12.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0Zm2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0ZM1.5 12h5a.5.5 0 0 1 0
                    1h-5a.5.5 0 0 1 0-1ZM1 14.25a.25.25 0 0 1 .25-.25h5.5a.25.25 0 1 1 0 .5h-5.5a.25.25 0 0
                    1-.25-.25Z"/>
                </svg> Ordinateur</a>
        </div>
        <div class="flex-sm-fill colum hover" id="sous-nav3">
            <a class="text-sm-center nav-link text-white" href="ProduitAfficher.php?name=accesoir" style="display: flex;align-items: center;margin: 0 auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-earbuds" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.825 4.138c.596 2.141-.36 3.593-2.389 4.117a4.432 4.432 0 0
                    1-2.018.054c-.048-.01.9 2.778 1.522 4.61l.41 1.205a.52.52 0 0 1-.346.659l-.593.19a.548.548 0 0
                    1-.69-.34L.184 6.99c-.696-2.137.662-4.309 2.564-4.8 2.029-.523 3.402 0 4.076 1.948zm-.868
                    2.221c.43-.112.561-.993.292-1.969-.269-.975-.836-1.675-1.266-1.563-.43.112-.561.994-.292
                    1.969.269.975.836 1.675 1.266 1.563zm3.218-2.221c-.596 2.141.36 3.593 2.389 4.117a4.434 4.434 0
                    0 0 2.018.054c.048-.01-.9 2.778-1.522 4.61l-.41 1.205a.52.52 0 0
                    0 .346.659l.593.19c.289.092.6-.06.69-.34l2.536-7.643c.696-2.137-.662-4.309-2.564-4.8-2.029-.523-3.402 0-4.076
                     1.948zm.868 2.221c-.43-.112-.561-.993-.292-1.969.269-.975.836-1.675 1.266-1.563.43.112.561.994.292
                     1.969-.269.975-.836 1.675-1.266 1.563z"/>
                </svg>Accessoires</a>
        </div>
    </nav>
</form>