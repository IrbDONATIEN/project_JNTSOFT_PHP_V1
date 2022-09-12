<?php
    require_once 'connexions.php';

    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.email_entreprise,entreprise.adresse_domiciliere,entreprise.employeur_id,demande_acceptee,employeur.nom_employeur,protocole_accord.id_protocole,protocole_accord.description_protocole,protocole_accord.demande_id,protocole_accord.date_created FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur INNER JOIN protocole_accord ON demande.id_demande=protocole_accord.demande_id WHERE demande_acceptee=1 AND protocole_accord.id_protocole=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

        $vid=$row['id_protocole'];
        $vdecript=$row['description_protocole'];
        $vEmployeur=$row['nom_employeur'];
        $vEntreprise=$row['nom_entreprise'];
        $vEseRCCM=$row['Rcc_entreprise'];
        $vNbre=$row['nbre_travailleurs'];
        $vAdresse=$row['adresse_domiciliere'];
        $vdate=$row['date_created'];
        
    }
?>