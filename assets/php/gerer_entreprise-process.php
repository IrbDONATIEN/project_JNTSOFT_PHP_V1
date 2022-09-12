<?php
   
    require_once 'entreprise.php';
    require_once 'employeur.php';
    
    $cemployeur=new Employeur();
    $centreprise=new Entreprise();
   
    //Gérer la requête Afficher toutes les entreprises abonnées en Ajax Request
    if(isset($_POST['action']) && $_POST['action']=='afficherEntreprises'){
        
        $output='';
        $entreprises=$centreprise->afficherEntreprises();
        if($entreprises){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employeur</th>
                            <th>Entreprise</th>
                            <th>RCCM</th>
                            <th>Email Entreprise</th>
                            <th>Date Création</th>
                            <th>Créée il y a</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($entreprises as $row){
                        $output .='<tr>
                                        <td>'.$row['id_entreprise'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['Rcc_entreprise'].'</td>
                                        <td>'.$row['email_entreprise'].'</td>
                                        <td>'.$row['date_creation'].'</td>
                                        <td>'.$centreprise->timeInAgo($row['date_creation']).'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_entreprise'].'" title="Supprimer une entreprise" class="text-danger deleteEntrepriseIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'entreprises enregistrées ici !</h3>';
        }
    }

    //Gérer supprimer l'entreprise d'abonnement entreprise en  Ajax Request
    if(isset($_POST['supprimer_entreprise'])){
        $id=$_POST['supprimer_entreprise'];
        $centreprise->deleteEntreprise($id);
    }


     //Gérer la requête Afficher tous les employeurs en Ajax Request
     if(isset($_POST['action']) && $_POST['action']=='afficherEmployeur'){
        $output='';
        $employeurs=$cemployeur->afficherEmployeur();
        if($employeurs){
            $output .='
                <table class="table table-striped table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employeur</th>
                            <th>Entreprise</th>
                            <th>RCCM</th>
                            <th>Email Employeur</th>
                            <th>Date Création</th>
                            <th>Créée il y a</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($employeurs as $row){
                        $output .='<tr>
                                        <td>'.$row['id_employeur'].'</td>
                                        <td>'.$row['nom_employeur'].'</td>
                                        <td>'.$row['nom_entreprise'].'</td>
                                        <td>'.$row['Rcc_entreprise'].'</td>
                                        <td>'.$row['adress_email'].'</td>
                                        <td>'.$row['date_created'].'</td>
                                        <td>'.$cemployeur->timeInAgo($row['date_created']).'</td>
                                        <td>
                                            <a href="#" id="'.$row['id_employeur'].'" title="Supprimer un employeur" class="text-danger deleteEmployeurIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                        </td>
                                   </tr>';
                    }
                    $output .='
                    </tbody>
                    </table>';
                    echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary">:( Pas encore d\'employeurs entreprise enregistrés ici !</h3>';
        }
    }

    //Gérer supprimer l'employeur d'entreprise en  Ajax Request
    if(isset($_POST['supprimer_employeur'])){
        $id=$_POST['supprimer_employeur'];
        $cemployeur->deleteEmployeur($id);
    }

?>