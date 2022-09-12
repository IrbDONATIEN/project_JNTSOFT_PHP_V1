<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere,demande_acceptee, frais.id_frais, frais.type_frais,frais.prix_unitaire,frais.demande_val_id,(frais.prix_unitaire*nbre_travailleurs) as Total FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN frais ON demande.id_demande=frais.demande_val_id WHERE demande_acceptee=1 AND frais.id_frais=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id_frais'];
        $vtype=$row['type_frais'];
        $vqte=$row['nbre_travailleurs'];
        $vpu=$row['prix_unitaire'];
        $vTotal=$row['Total'];
        $vEntreprise=$row['nom_entreprise'];
        
    }
?>