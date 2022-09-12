<?php
    require_once 'connexions.php';

    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_agent,nom_agent,postnom_agent,prenom_agent,sexe_agent,lieu_naissance,date_naissance,photo,fonction_agent, entreprise_agent_id,entreprise.nom_entreprise,entreprise.employeur_id,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere, carte_agent.id_carte,carte_agent.code_unique,carte_agent.nbre_enfant,carte_agent.agent_id, carte_agent.date_etablissement, employeur.nom_employeur FROM agent INNER JOIN carte_agent ON agent.id_agent=carte_agent.agent_id INNER JOIN entreprise ON agent.entreprise_agent_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE carte_agent.id_carte=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

        $vid=$row['id_carte'];
        $vcode=$row['code_unique'];
        $vnbreEnfant=$row['nbre_enfant'];
        $vnomAgent=$row['nom_agent'];
        $vpostnomAgent=$row['postnom_agent'];
        $vprenomAgent=$row['prenom_agent'];
        $vsexeAgent=$row['sexe_agent'];
        $vEmployeur=$row['nom_employeur'];
        $vEntreprise=$row['nom_entreprise'];
        $vEseRCCM=$row['Rcc_entreprise'];
        $vAdresse=$row['adresse_domiciliere'];
        $vPhoto=$row['photo'];
        
    }
?>