<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/auth.php';
    require_once '../assets/php/facture.php';
    $count=new Auth();
    $counts=new Facture();
?>
<div class="container mt-2">
    <div class="mt-2">
            <img src="../assets/images/cmdc.png">
    </div>
    <div class="alert alert-info bg-info alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans le système d'abonnement JNTSOFT  Nom:&nbsp;<?=$cnom;?> &nbsp;Prénom:&nbsp;<?=$cprenom;?> Fonction:<?=$croles;?>&nbsp;</strong>
        </div>
    </div>
    <hr>
    <?php if($crole=='Chef Administratif'):?>
    <h4 class="text-center text-primary mt-3">Tableau de Bord de JNTSOFT !</h4>
    <div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fa fa-building"></i>&nbsp;&nbsp;Total Entreprise</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('entreprise');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-danger">
                <div class="card-header"><i class="far fa-address-book"></i>&nbsp;&nbsp;Total Demande</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('demande');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="fas fa-book"></i>&nbsp;Total Demande Acceptée</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?= $count->totalDemandeAcceptee();?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 2-->
<div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-dark">
                <div class="card-header"><i class="fas fa-user"></i>&nbsp;&nbsp;Total Agent Abonné</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('agent');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-warning">
                <div class="card-header"><i class="far fa-address-book"></i>&nbsp;&nbsp;Total Protocole Accord</div>
                    <div class="card-body">
                        <h1 class="display-4">
                              <?= $count->totalCount('protocole_accord');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-info">
                <div class="card-header"><i class="fas fa-money-check-alt"></i>&nbsp;Total Facture</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('facture');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 2-->
<!--Fin de la ligne 3-->
<div class="row text-center ">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <!--Debut de la case 1-->
            <div class="card bg-secondary">
                <div class="card-header"><i class="fas fa-money-check-alt"></i>&nbsp;<i class="fas fa-money-check-alt"></i>&nbsp;Total Frais</div>
                    <div class="card-body">
                        <h1 class="display-4">
                             <?= $count->totalCount('frais');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-success">
                <div class="card-header"><i class="fas fa-id-card"></i>&nbsp;Total Carte Abonné</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?= $count->totalCount('carte_agent');?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
            <!--Debut de la case 1-->
            <div class="card bg-primary">
                <div class="card-header"><i class="fas fa-business-time"></i>&nbsp;Montant Facture Total</div>
                    <div class="card-body">
                        <h1 class="display-4">
                            <?php  $data=$counts->caisseTotalGenerals(); echo $data['Total'];?>
                        </h1>
                    </div>
            </div>
            <!--Fin de la case 1-->
        </div>        
    </div>
</div>
<!--Fin de la ligne 3-->
<?php else:?>
    <h1 class="text-center text-secondary mt-5">Vous n'êtes autorisé à voir les contenues de cette page !</h1>
<?php endif;?>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>