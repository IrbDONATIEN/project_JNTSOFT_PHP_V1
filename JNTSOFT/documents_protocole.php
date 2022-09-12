<?php
    require_once '../assets/php/header.php';

    require_once '../assets/php/voirprotocole.php';

    setlocale(LC_TIME,'fr');
    $var=ucfirst(strftime('%A, le %d %B %Y'));
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
           <a href="" class="nepaimprimer" onclick="window.print();">Imprimer</a>
        </div>
        <div class="section-headline text-justify">
                <p align="left">
                <h4><B>CENTRE MEDICAL DU CENTRE VILLE</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°:<?=$vid;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/images/LOGO CMDC.jpeg" width="20%" height="3%" style="border-radius: 5%;"><br>
                </h4> 
                </p> 
        </div>
    </div>
    <div class="section-headline text-center">
        <h1 class="nepaimprimer"><center><B><U>PROTOCOLE D'ACCORDS ENTREPRISE ABONNEE</B></U></center></h1><br>
    </div>
    <div class="section-headline text-justify">
    <p align="justify">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Je soussigné  <b><?=$vdecript;?></b> que l'entreprise <b><?=$vEntreprise;?></b>est abonnée avec comme numéro du registre commercial de <b> <?=$vEseRCCM;?></b> au sein de notre <b>C</b>entre <b>M</b>édical <b>D</b>u <b>C</b>entre Ville en sigle <b>"CMDC"</b> pour les soins médicaux concernant ces agents dont le nombre est de <b><?=$vNbre;?></b>. 
        Adresse de l'Entreprise: <?=$vAdresse;?>. <br/> <br/>
        Nom de l'Employeur: <?=$vEmployeur;?>.
        <br/> <br/>
           <div class="text-right">Fait à Lubumbashi <?=$var;?></div>
        <br/><br/>
        <div class="text-right"> Chef Administratif
        <br/> <br/> <b>
        <?=$vdecript;?></b></div>
    </p>
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>