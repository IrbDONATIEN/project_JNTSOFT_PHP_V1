<?php

    require_once 'assets/php/employeur.php';
    require_once 'assets/php/entreprise.php';
    require_once 'assets/php/demande.php';
    $employeur=new Employeur();
    $entreprise=new Entreprise();
    $demande=new Demande();

    //Gérer Identification de l'employeur en  Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='register'){
        $nom_employeur=$employeur->test_input($_POST['nom_employeur']);
        $adress_email=$employeur->test_input($_POST['adress_email']);
        $adresse_domicile=$employeur->test_input($_POST['adresse_domicile']);
    
        if($employeur->employeur_exist($adress_email)){
            echo $employeur->showMessage('warning', 'Cette adresse e-mail est déjà utilisée et Veuillez choisir une autre svp! ');
        }else{
            if($employeur->add_employeur($nom_employeur,$adresse_domicile,$adress_email)){
                echo 'register';
            }else{
                echo $user->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

    //Gérer Identification de l'entreprise en  Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='registers'){
        $nom_entreprise=$entreprise->test_input($_POST['nom_entreprise']);
        $Rcc_entreprise=$entreprise->test_input($_POST['Rcc_entreprise']);
        $email_entreprise=$entreprise->test_input($_POST['email_entreprise']);
        $adresse_domiciliere=$entreprise->test_input($_POST['adresse_domiciliere']);
        $employeur_id=$entreprise->test_input($_POST['employeur_id']);
    
        if($entreprise->entreprise_existe($nom_entreprise)){
            echo $entreprise->showMessage('warning', 'Cette entreprise existe déjà et Veuillez choisir une autre svp! ');
        }else{
            if($entreprise->add_entreprise($nom_entreprise,$Rcc_entreprise,$email_entreprise,$adresse_domiciliere,$employeur_id)){
                echo 'registers';
            }else{
                echo $user->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

    //Gérer écrire une demande d'abonnement en  Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='register_s'){
        $nbre_travailleurs=$demande->test_input($_POST['nbre_travailleurs']);
        $entreprise_id=$demande->test_input($_POST['entreprise_id']);
    
        if($demande->demande_existe($entreprise_id)){
            echo $demande->showMessage('warning', 'Une demande pour cette entreprise existe déjà et Veuillez contacter l\'administrateur ou chef Administratif de l\'hôpital! ');
        }else{
            if($demande->add_demande($nbre_travailleurs,$entreprise_id)){
                echo 'register_s';
            }else{
                echo $user->showMessage('danger', 'Un problème est survenu! Réessayez plus tard.');
            }
        }
    }

?>