<?php

    require_once 'connexions.php';
    //Preparation d'affichage de details des informations provenant de la base de données
	if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="SELECT id_facture,type_fac,prix_unit,nbres,(prix_unit*nbres) as Totals,entreprise_fac_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere, create_dates FROM facture INNER JOIN entreprise ON facture.entreprise_fac_id=entreprise.id_entreprise WHERE facture.id_facture=?";
		$stmt=$dbb->prepare($query);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $vid=$row['id_facture'];
        $vtype=$row['type_fac'];
        $vqte=$row['nbres'];
        $vpu=$row['prix_unit'];
        $vTotal=$row['Totals'];
        $vEntreprise=$row['nom_entreprise'];
        
    }
?>