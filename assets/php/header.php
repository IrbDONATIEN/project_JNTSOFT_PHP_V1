<?php
    require_once '../assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Ir Donatien">
        <meta http-equiv="x-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
        <title>JNTSOFT|<?=ucfirst(basename($_SERVER['PHP_SELF'],'.php')); ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <style type="text/css">
            @import url("https://fonts.googleapis.com/css?family=Maven+Pro:400,500,600,700,800,900&display=swap");
            *{
                font-family:'Maven Pro', sans-serif;
                font-size:18px;
            }
                       
            /*FOOTER*/
            .footer{
            background:#303022;
            color:#d3d3d3;
            height: 70px;
            position: relative;
            }

             /* Make the image fully responsive */
            .carousel-inner {
                width: 100%;
                height: 100%;
            }
            .footer .footer-botton{
            background:#343a40;
            color:#686868;
            height: 70px;
            width: 100%;
            border:1px solid red;
            text-align:center;
            position:absolute;
            bottom:0px;
            left: 0px;
            padding-top:20px;
            }
        </style>
        <link rel="shortcut icon" href="../assets/images/logo.png" />
    </head>
    <body class="bg-white">

    <nav class="navbar navbar-expand-md bg-info navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="abonnement.php"><img src="../assets/images/logo.png" style="width: 20%;height: 20%;" class="rounded-circle" >&nbsp;<strong>JNTSOFT</strong></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="abonnement.php")?"active":"";?>" href="abonnement.php"><i class="fa fa-home"></i>&nbsp;Accueil</a>
                </li>
                <?php if($crole=='Chef Administratif'):?>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="etablir_protocole.php")?"active":"";?>" href="etablir_protocole.php"><i class="fa fa-folder"></i>&nbsp;Etablir Protocole</a>
                </li>
                <?php endif;?>
                <?php if($crole=='Gestionnaire' || $crole=='Chef Administratif'):?>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="gerer_agent.php")?"active":"";?>" href="gerer_agent.php"><i class="fas fa-user"></i>&nbsp;Gérer Agent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="gerer_entreprise.php")?"active":"";?>" href="gerer_entreprise.php"><i class="fa fa-building"></i>&nbsp;Gérer Entreprise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="gerer_demande.php")?"active":"";?>" href="gerer_demande.php"><i class="fab fa-adversal"></i>&nbsp;Gérer Demande</a>
                </li>
                <?php endif;?>
                <?php if($crole=='Receptinniste' || $crole=='Chef Administratif'):?>
                <li class="nav-item">
                    <a class="nav-link <?=(basename($_SERVER['PHP_SELF'])=="etablir_carte.php")?"active":"";?>" href="etablir_carte.php"><i class="fas fa-id-card"></i>&nbsp;Etablir Carte</a>
                </li>
                <?php endif;?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog"></i>&nbsp;Salut!<?=$clogin_user;?>
                    </a>
                    <div class="dropdown-menu">
                        <?php if($crole=='Comptable' || $crole=='Chef Administratif'):?>
                            <a href="enregistrer_frais.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="enregistrer_frais.php")?"active":"";?>"><i class="fas fa-pen"></i>&nbsp;Enregistrer Frais</a>
                            <a href="etablir_facture.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF'])=="etablir_facture.php")?"active":"";?>"><i class="fas fa-business-time"></i>&nbsp;Etablir Facture</a>
                        <?php endif;?>
                        <a href="../assets/php/logout.php" class="dropdown-item"> <i class="fas fa-sign-out-alt"></i>&nbsp;Déconnexion</a>
                    </div>
                </li>
                </ul>
            </div> 
        </nav>