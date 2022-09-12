<?php
    
    require_once 'carte_agent.php';
    
    $ccartes=new Carte_agent();
    
     //Gérer la requête d'insertion d'une carte agent abonné entreprise abonnée avec Ajax
     if(isset($_POST['action']) && $_POST['action']=='add_carte'){
        $code_unique=$ccartes->test_input($_POST['code_unique']);
        $nbre_enfant=$ccartes->test_input($_POST['nbre_enfant']);
        $date_etablissement=$ccartes->test_input($_POST['date_etablissement']);
        $agent_id=$ccartes->test_input($_POST['agent_id']);

        if($ccartes->carte_agent_existe($agent_id)){
            echo json_encode($cprotocole->showMessage('warning', 'Cet agent abonné  a déjà une carte établie!'));exit;
        }
        else{
            if($ccartes->add_carte_agent($code_unique,$nbre_enfant,$date_etablissement,$agent_id)){
                $ccartes->updateAgent($agent_id);
            }else{
                echo json_encode($ccartes->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.'));exit;
            }
        }
    }

    //Gérer la requête affichage des cartes d'accords entreprise abonnée avec Ajax
    if(isset($_POST['action']) && $_POST['action']=='afficherCartesAgentEntreprises'){
        $output='';
        $cartes=$ccartes->afficherCartesAgentEntreprises();
        $path='../assets/php/';
        if($cartes){
            $output .='
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code Carte</th>
                            <th>Nom Agent</th>
                            <th>Prénom Agent</th>
                            <th>Entreprise</th>
                            <th>Employeur</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($cartes as $row){
                        if($row['photo'] !=''){
                            $uphoto=$path.$row['photo'];
                        }
                        else{
                            $uphoto='../assets/images/avatar.png';
                        }
                        $output .='<tr>
                                        <td>'.$row['id_carte'].'</td>
                                        <td>'.$row['code_unique'].'</td>
                                        <td>'.$row['nom_agent'].'</td>
                                        <td>'.$row['prenom_agent'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                                        <td>
                                            <a href="#" id="'.$row['id_carte'].'" title="Voir Carte Agent" class="text-success infoCarteBtn"><i class="fas fa-info-circle fa-lg"></i>&nbsp;

                                            <a href="#" id="'.$row['id_carte'].'"  idag="'.$row['agent_id'].'" title="Supprimer Carte Agent" class="text-danger deleteCartesIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
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

    //Gérer supprimer carte agent  abonnée en  Ajax Request
   if(isset($_POST['del_carte_id'])){
        $id=$_POST['del_carte_id'];
        $agent_id=$_POST['updat_ag'];;
        $ccartes->updateAgents($agent_id);
        $ccartes->deleteCarteAgent($id);
    }

?>