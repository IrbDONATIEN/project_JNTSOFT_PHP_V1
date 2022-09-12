<?php
    
    require_once 'protocole.php';
    
    $cprotocole=new Protocole();
    
     //Gérer la requête d'insertion d'un protocole d'accords entreprise abonnée avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_proto'){
        $description_protocole=$cprotocole->test_input($_POST['description_protocole']);
        $demande_id=$cprotocole->test_input($_POST['demande_id']);

        if($cprotocole->protocole_demande_existe($demande_id)){
            echo json_encode($cprotocole->showMessage('warning', 'Ce protocole d\'accords entreprise demande est déjà enregistré!'));exit;
        }
        else{
            if($cprotocole->add_protocole_accord_demande($description_protocole,$demande_id)){
            }else{
                echo json_encode($cprotocole->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.'));exit;
            }
        }
    }

    //Gérer la requête affichage des protocoles d'accords entreprise abonnée avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherProtocolesDemandesEntreprises'){
        $output='';
        $protocole=$cprotocole->afficherProtocolesDemandesEntreprises();

        if($protocole){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Entreprise</th>
                            <th>Employeur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($protocole as $row){
                        $output .='<tr>
                                        <td>'.$row['id_protocole'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_protocole'].'" title="Voir document protocole d\'accords" class="text-success infoProtocoleBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_protocole'].'" title="Supprimer Protocole" class="text-danger deleteUtilisateursIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des protocoles d\'accords entreprise  crééent !</h3>';
        }
    }

    //Gérer supprimer protocole d'accors entreprise  abonnée en  Ajax Request
   if(isset($_POST['del_protocole_id'])){
    $id=$_POST['del_protocole_id'];
    $cprotocole->deleteProtocoleDemande($id);
   }

?>