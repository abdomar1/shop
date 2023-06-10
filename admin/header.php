<?php
session_start();ob_start();

if (isset($_SESSION['idPersone'])):require_once('../database/conexion.php');
    $stm=$db->prepare('select count(id_command) as allvalide from command where valid=false');
    $stm->execute();$not_valide=$stm->fetch(PDO::FETCH_OBJ);
    $stmC=$db->prepare('select count(id_comantaire) as allvu from commantaire where vu=false');
    $stmC->execute();$not_see=$stmC->fetch(PDO::FETCH_OBJ);
    ?>
<!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row m-0">
            <div class="main-header-left">
                <div class="logo-wrapper"><a href="index.php?page=index"
                                             style="font-family:Arial;font-weight:bold;display: flex;align-items: center;font-size: 18px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                             fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1
                            .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0
                            1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11
                            3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0
                            0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0
                            2 2 0 0 1-4 0z"/>
                        </svg>Click_shop</a></div>
            </div>
            <div class="left-menu-header col">
                <ul>
                    <li>
                            <div class="search-bg"><em class="fa fa-search"></em>
                                <input type="text" name="cherche" onkeyup="checher(event)"
                                       id="chercher" class="form-control-plaintext" placeholder="Search here.....">
                            </div>
                        <span class="d-sm-none mobile-search search-bg">
                            <em class="fa fa-search"></em></span>
                    </li>
                </ul>
            </div>
            <div class="nav-right col pull-right right-menu p-0">
                <ul class="nav-menus">
                    <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                            <em data-feather="maximize"></em></a></li>
                    <li class="onhover-dropdown">
                        <div class="notification-box">
                            <em data-feather="bell">
                            </em><?=($not_valide->allvalide)?'<span class="dot-animated"></span>':"" ?>
                        </div>
                        <ul class="notification-dropdown onhover-show-div">
                            <li>
                                <p class="f-w-700 mb-0">You have
                                    <span class="pull-right badge badge-primary badge-pill">
                                        <?= isset($not_valide)?$not_valide->allvalide:0 ?></span>New Commande</p>
                            </li>
                            <?php
                            $stmCm=$db->prepare('select distinct c2.id_client,c.id_command,c.date_command,
                c.valid,c2.nom_clinet,p.id_Pannier from command c join pannier p on p.id_Pannier = c.id_command
                join client c2 on c2.id_client = p.id_client order by c.valid asc,c.date_command desc limit 5');
                            $stmCm->execute();
                            $AllCommand=$stmCm->fetchAll(PDO::FETCH_OBJ);
                            foreach ($AllCommand as $item):?>
                                <li class="noti-primary" style="background-color: <?=(!$item->valid)?'rgba(207,239,197,0.63)':''?>;border-bottom: 2px solid rgba(12,84,96,0.37)">
                                    <a href="command-one.php?id=<?=$item->id_client.'#P'.$item->id_Pannier?>">
                                        <div class="media">
                                            <span class="notification-bg bg-light-primary">
                                                <em class="bi bi-cart-check"></em></span>
                                            <div class="media-body">
                                                <p><?= $item->nom_clinet?></p>
                                                <span><?= $item->date_command?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach;?>
                            <li class="text-center"> <a class="f-w-700" href="command.php">See All  </a></li>
                        </ul>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="notification-box">
                            <em data-feather="message-square"></em><?=($not_see->allvu)?'
                                <span class="dot-animated"></span>':"" ?>
                        </div>
                        <ul class="chat-dropdown notification-dropdown onhover-show-div">
                            <li>
                                <p class="f-w-700 mb-0">You have
                                    <span class="pull-right badge badge-primary badge-pill">
                                        <?=isset($not_valide)?$not_valide->allvalide:0 ?></span>New Comantaire</p>
                            </li>
                            <?php
                            $stm=$db->prepare('select distinct p.id_Pannier,c.*,c3.nom_clinet,c3.profil_client,
                c3.id_client,valid from commantaire c join command c2 on c2.id_command = c.id_command
                    join pannier p on p.id_Pannier = c2.id_command join client c3 on c3.id_client=p.id_client
                                   where valid=false order by c.vu asc,c.date_comante desc limit 5;');
                            $stm->execute([]);
                            $AllCommantaire=$stm->fetchAll(PDO::FETCH_OBJ);
                            foreach ($AllCommantaire as $item):?>
                                <li style="background-color:<?=(!$item->vu)?'rgba(207,239,197,0.63)':''?>;border-bottom: 2px solid rgba(12,84,96,0.37)">
                                    <a href="command-one.php?id=<?=$item->id_client?>#C<?=$item->id_Pannier?>">
                                        <div class="media"><img class="img-fluid rounded-circle me-3"
                                                                src="../<?=$item->profil_client?>" alt="">
                                            <div class="media-body"><span><?=$item->nom_clinet?></span>
                                                <p class="f-12 light-font"><?=$item->desctreption?>...</p>
                                            </div>
                                            <p class="f-12"><?= $item->date_comante?></p>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <li class="onhover-dropdown p-0">
                        <button class="btn btn-primary-light" type="button">
                            <a href="../login-logout-signUp/lougout.php">
                                <em data-feather="log-out"></em>Log out</a>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="d-lg-none mobile-toggle pull-right w-auto">
                <em data-feather="more-horizontal"></em></div>
        </div>
    </div>
<!-- Page Header Ends                              -->
<div class="page-body-wrapper sidebar-icon ">
    <!-- Page Sidebar Start-->
    <header class="main-nav">
        <div class="sidebar-user text-center"><a class="setting-primary" href="users-profile.php">
                <em data-feather="settings"></em></a>
            <img class="img-90 rounded-circle" src="<?=$_SESSION['profil']?>" alt="">
            <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
            <a href="users-profile.php"><h6 class="mt-3 f-14 f-w-600"><?=$_SESSION['nom_personnel']?></h6></a>
            <p class="mb-0 font-roboto"><?=$_SESSION['role']?></p>

        </div>
        <nav>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><em data-feather="arrow-left"></em></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span>
                                <em class="fa fa-angle-right ps-2" aria-hidden="true"></em>
                            </div>
                        </li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6>General             </h6>
                            </div>
                        </li>
                        <li class="dropdown"><a class="nav-link menu-title"
                                                href="javascript:void(0)">
                                <em data-feather="Product"></em><span>Home</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="index.php?page=index">All card Product</a></li>
                                <li><a href="index.php?page=tableAllProduit">table All Produit</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Forms Product</h6>
                            </div>
                        </li>
                        <li class="dropdown"> <a class="nav-link menu-title"
                                                 href="javascript:void(0)">
                                <em data-feather="sliders"></em><span>Form Product </span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="addProduit.php">Add Product</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow">
                    <em data-feather="arrow-right"></em></div>
            </div>
        </nav>
    </header>
    <!-- Page Sidebar Ends-->
</div>
<?php
else :
    header('Location:../login-logout-signUp/login_one.php');
endif;?>