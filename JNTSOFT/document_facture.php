<?php
    require_once '../assets/php/header.php';

    require_once '../assets/php/voirfacture.php';

    setlocale(LC_TIME,'fr');
    $var=ucfirst(strftime('%A, le %d %B %Y'));
?>
<div class="container">
    <div class="col-lg-12">
        <a href="" class="nepaimprimer" onclick="window.print();">Imprimer</a>
    </div>
    <div class="">
        <table border="2">
            <tr>
                <td colspan="4"> <p align="left">
                <h4><B>CENTRE MEDICAL DU CENTRE VILLE</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°:<?=$vid;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/images/LOGO CMDC.jpeg" width="20%" height="3%" style="border-radius: 5%;"><br>
                </h4> 
                </p> <br /></td>
            </tr>
            <tr>
                <td colspan="4"><h1><center><B><U>FACTURE ENTREPRISE :&nbsp;<?=$vEntreprise;?></B></U></center></h1><br /></td>
            </tr>
            <tr class="bg-info text-white">
                <td><div class="text-center"><b>Type Frais</b></div></td>
                <td><div class="text-center"><b><b>Quantité</b></div></td>
                <td><div class="text-center"><b>Prix Unitaire</div></div></td>
                <td><div class="text-center"><b>Total</b></div></td>
            </tr>
            <tr>
                <td><div class="text-left"><?=$vtype;?></div></td>
                <td><div class="text-right"><?=$vqte;?></div></td>
                <td><div class="text-right"><?=$vpu;?></div></td>
                <td><div class="text-right"><?=$vTotal;?></div></td>
            </tr>
            <tr>
                <td colspan="4"><br/><div class="text-right">Total Frais :<b><?=$vTotal;?></b> &nbsp;CDF ou USD</div> <br /></td>
            </tr>
            <tr>
                <td colspan="4"><div class="text-right"><br/><br/>Fait à Lubumbashi <?=$var;?></div><br/> <div class="text-right"> Chef Administratif
               <br/> <br/> <i> Nom, Postnom,Prénom et Signature du Chef Administratif</i></div></td>
            </tr>
        </table>
    </div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>