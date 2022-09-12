<?php
    
    require_once 'facture.php';
    
    $cfacture=new Facture();
    
     //Gérer la requête d'insertion facture entreprise abonnée avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_facture'){
        $type_fac=$cfacture->test_input($_POST['type_fac']);
        $prix_unit=$cfacture->test_input($_POST['prix_unit']);
        $nbres=$cfacture->test_input($_POST['nbres']);
        $entreprise_fac_id=$cfacture->test_input($_POST['entreprise_fac_id']);
        $cfacture->add_facture($type_fac,$prix_unit,$nbres,$entreprise_fac_id);
    }

    //Gérer la requête affichage des factures entreprise abonnée avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherFacturesAbonnesEntreprises'){
        $output='';
        $facture=$cfacture->afficherFacturesAbonnesEntreprises();

        if($facture){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Entreprise</th>
                            <th>Type Frais</th>
                            <th>Nombre Agent</th>
                            <th>Prix Unitaire</th>
                            <th>Total Facture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($facture as $row){
                        $output .='<tr>
                                        <td>'.$row['id_facture'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['type_fac'].'</td>
                                        <td>'.$row['nbres'].'</td>
                                        <td>'.$row['prix_unit'].'</td>
                                        <td>'.$row['Totals'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_facture'].'" title="Voir document facture" class="text-success infoFactureBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_facture'].'" title="Supprimer Facture" class="text-danger deleteFacturesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des factures entreprise  crééent !</h3>';
        }
    }

    //Gérer supprimer facture entreprise  abonnée en  Ajax Request
   if(isset($_POST['del_facture_id'])){
    $id=$_POST['del_facture_id'];
    $cfacture->deleteFacture($id);
   }

?>