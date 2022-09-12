<?php
    
    require_once 'frais.php';
    $cfrais=new Frais();
   
     //Gérer la requête d'insertion frais entreprise abonnée avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_frais'){
        $type_frais=$cfrais->test_input($_POST['type_frais']);
        $prix_unitaire=$cfrais->test_input($_POST['prix_unitaire']);
        $demande_val_id=$cfrais->test_input($_POST['demande_val_id']);
        $cfrais->add_frais($type_frais,$prix_unitaire,$demande_val_id);
    }

    //Gérer la requête affichage des frais entreprise abonnée avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherFraisAbonnesEntreprises'){
        $output='';
        $frais=$cfrais->afficherFraisAbonnesEntreprises();

        if($frais){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Entreprise</th>
                            <th>Type Frais</th>
                            <th>Prix Unitaire</th>
                            <th>Total Frais</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($frais as $row){
                        $output .='<tr>
                                        <td>'.$row['id_frais'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['type_frais'].'</td>
                                        <td>'.$row['prix_unitaire'].'</td>
                                        <td>'.$row['Total'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_frais'].'" title="Voir document frais" class="text-success infoFraisBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_frais'].'" title="Supprimer Frais" class="text-danger deleteFraisIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des frais entreprise  crééent !</h3>';
        }
    }

    //Gérer supprimer frais entreprise  abonnée en  Ajax Request
   if(isset($_POST['del_frais_id'])){
    $id=$_POST['del_frais_id'];
    $cfrais->deleteFrais($id);
   }

?>