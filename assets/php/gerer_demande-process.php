<?php
    
    require_once 'demande.php';
    
    $cdemande=new Demande();

    //Gérer la requête Afficher toutes les demandes d'abonnement de l'entreprise en Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='afficherDemandesEntreprises'){
        
        $output='';
        $demandes=$cdemande->afficherDemandesEntreprises();

        if($demandes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employeur</th>
                            <th>Entreprise</th>
                            <th>Email Entreprise</th>
                            <th>Nbre. Trav.</th>
                            <th>Date</th>
                            <th>Reçue il y a</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($demandes as $row){
                        $output .='<tr>
                                        <td>'.$row['id_demande'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['email_entreprise'].'</td>
                                        <td>'.$row['nbre_travailleurs'].'</td>
                                        <td>'.$row['date_demande'].'</td>
                                        <td>'.$cdemande->timeInAgo($row['date_demande']).'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_demande'].'" title="Valider demande" class="text-primary editerDemandeIcon"><i class="fas fa-edit fa-lg"></i></a>&nbsp;
                                            <a href="#" id="'.$row['id_demande'].'" title="Supprimer demande d\'abonnement entreprise" class="text-danger deleteDemandeIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des demandes d\'abonnement entreprise reçues!</h3>';
        }
    }

    //Gérer la requête Afficher toutes les demandes d'abonnement de l'entreprise validées en Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='afficherDemandesEntreprise'){
        
        $output='';
        $demandes=$cdemande->afficherDemandesEntreprise();

        if($demandes){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employeur</th>
                            <th>Entreprise</th>
                            <th>Email Entreprise</th>
                            <th>Nbre. Trav.</th>
                            <th>Date</th>
                            <th>Validée il y a</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($demandes as $row){
                        $output .='<tr>
                                        <td>'.$row['id_demande'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['email_entreprise'].'</td>
                                        <td>'.$row['nbre_travailleurs'].'</td>
                                        <td>'.$row['date_validation'].'</td>
                                        <td>'.$cdemande->timeInAgo($row['date_validation']).'</td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore des demandes d\'abonnement entreprise validée ici!</h3>';
        }
    }

    //Gérer valider la demande d'abonnement entreprise en  Ajax Request
    if(isset($_POST['valider_demande'])){
        $id=$_POST['valider_demande'];
        $cdemande->validerDemande($id);
    }

    //Gérer supprimer la demande d'abonnement entreprise en  Ajax Request
    if(isset($_POST['supprimer_demande'])){
        $id=$_POST['supprimer_demande'];
        $cdemande->deleteDemande($id);
    }

?>