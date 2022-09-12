<?php
    require_once '../assets/php/header.php';

    require_once '../assets/php/voircarteAgent.php';

    setlocale(LC_TIME,'fr');
    $var=ucfirst(strftime('%A, le %d %B %Y'));
?>
<div class="container">
    <div class="col-lg-12">
        <a href="" class="nepaimprimer" onclick="window.print();">Imprimer</a>
    </div>
    <div class="">
        <table>
            <tr>
                <td colspan="3"> <p align="left">
                <h4><B>CENTRE MEDICAL DU CENTRE VILLE</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°:<?=$vid;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/images/LOGO CMDC.jpeg" width="20%" height="3%" style="border-radius: 5%;"><br>
                </h4> 
                </p> <br /></td>
            </tr>
            <tr>
                <td colspan="3"><h1><center><B><U>CARTE D'ACCESS SOINS MEDICAUX CODE:<?=$vcode;?></B></U></center></h1><br /></td>
            </tr>
            <tr>
                <td>Nom Agent:</td>
                <td><b><?=$vnomAgent;?></b></td>
                <td><div class="text-right"><b>PHOTO AGENT</b></div></td>
            </tr>
            <tr>
                <td>Postnom Agent:</td>
                <td><b><?=$vpostnomAgent;?></b></td>
                <td rowspan="6"> <center><img src="../assets/php/<?=$vPhoto;?>" alt="Photo" class="float-right" width="200px" height="200px" id="getPhoto"></center></td>
            </tr>
            <tr>
                <td>Prénom Agent:</td>
                <td><b><?=$vprenomAgent;?></b></td>
            </tr>
            <tr>
                <td>Sexe Agent:</td>
                <td><b><?=$vsexeAgent;?></b></td>
            </tr>
            <tr>
                <td>Nombre d'Enfant(s):</td>
                <td><b><?=$vnbreEnfant;?></b></td>
            </tr>
            <tr>
                <td>Entreprise :</td>
                <td><b><?=$vEntreprise;?></b></td>
            </tr>
            <tr>
                <td>Employeur :</td>
                <td><b> <?=$vEmployeur;?></b></td>
            </tr>
            <tr>
                <td colspan="3"><div class="text-right"><br/><br/>Fait à Lubumbashi <?=$var;?></div><br/> <div class="text-right"> Chef Administratif
        <br/> <br/> <i> Nom, Postnom,Prénom et Signature du Chef Administratif</i></div></td>
            </tr>
        </table>
    </div>
<?php
    require_once '../assets/php/footer.php';
?>