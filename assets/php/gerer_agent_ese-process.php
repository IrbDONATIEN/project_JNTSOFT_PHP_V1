<?php
  
   require_once 'agent.php';
  
   $cagent=new Agent();
   
   //Gérer la requête d'ajout agent abonné avec Ajax
   if(isset($_FILES['photo'])){
      $nom_agent=$cagent->test_input($_POST['nom_agent']);
      $postnom_agent=$cagent->test_input($_POST['postnom_agent']);
      $prenom_agent=$cagent->test_input($_POST['prenom_agent']);
      $sexe_agent=$cagent->test_input($_POST['sexe_agent']);
      $lieu_naissance=$cagent->test_input($_POST['lieu_naissance']);
      $date_naissance=$cagent->test_input($_POST['date_naissance']);
      $fonction_agent=$cagent->test_input($_POST['fonction_agent']);
      $entreprise_agent_id=$cagent->test_input($_POST['entreprise_agent_id']);
      $fichier='uploads/';
      if(isset($_FILES['photo']['name']) && ($_FILES['photo']['name']!="")){
         $photo=$fichier.$_FILES['photo']['name'];
         move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
      }
      $cagent->add_agent($nom_agent,$postnom_agent,$prenom_agent,$sexe_agent,$lieu_naissance,$date_naissance,$photo,$fonction_agent,$entreprise_agent_id);
   }

    //Gérer la requête d'affichages des agents abonnés des entreprises avec Ajax
    if(isset($_POST['action'])&& $_POST['action']=='afficherAgentEntreprises'){
      $output='';
      $data=$cagent->afficherAgentEntreprises();
      $path='../assets/php/';

      if($data){
          $output .='
              <table class="table table-striped table-bordered table-sm text-center">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nom Agent</th>
                          <th>Postnom Agent</th>
                          <th>Prénom Agent</th>
                          <th>Entreprise</th>
                          <th>Employeur</th>
                          <th>Photo Agent</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>';
                  foreach($data as $row){
                      if($row['photo'] !=''){
                          $uphoto=$path.$row['photo'];
                      }
                      else{
                          $uphoto='../assets/images/avatar.png';
                      }
                      $output .='<tr>
                                      <td>'.$row['id_agent'].'</td>
                                      <td>'.$row['nom_agent'].'</td>
                                      <td>'.$row['postnom_agent'].'</td>
                                      <td>'.$row['prenom_agent'].'</td>
                                      <td>'.$row['nom_entreprise'].'</td>
                                      <td>'.$row['nom_employeur'].'</td>
                                      <td> <img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                                      <td class="text-center">
                                          <a href="#" id="'.$row['id_agent'].'" title="Voir Détail Agent Abonné" class="text-primary agentDetailsIcon" data-toggle="modal" data-target="#showAgentsModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
                                          <a href="#" id="'.$row['id_agent'].'" title="Supprimer Agent Abonné" class="text-danger deleteAgentIcon"><i class="fas fa-trash-alt fa-lg"></i></a>
                                      </td>
                                 </tr>';
                  }
                  $output .='
                  </tbody>
                  </table>';
                  echo $output;
      }
      else{
          echo '<h3 class="text-center text-secondary">:( Pas encore des projets mariages créée pour cette commune !</h3>';
      }
    }

    //Afficher détail Agent abonné séléctionné en Ajax Request
    if(isset($_POST['detail_agent_id'])){
       
      $id=$_POST['detail_agent_id'];

      $data=$cagent->afficherAgentDetailsByID($id);

      echo json_encode($data);
   }

   //Gérer supprimer agent abonné de  l'entreprise en  Ajax Request
   if(isset($_POST['supprimer_agent'])){
      $id=$_POST['supprimer_agent'];
      $cagent->deleteAgent($id);
   }

?>