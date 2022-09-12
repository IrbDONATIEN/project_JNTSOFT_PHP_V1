<?php

    session_start();
    require_once 'auth.php';
    $user=new Auth();
   
    //Gérer l'authentification de l'utilisateur Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login'){
        $login_user=$user->test_input($_POST['login_user']);
        $motdepasse=$user->test_input($_POST['motdepasse']);
        $type_utilisateur=$user->test_input($_POST['type_utilisateur']);

        $loggedInUser=$user->loginUser($login_user,$motdepasse,$type_utilisateur);

        if($loggedInUser !=null){
            $_SESSION['users']=$login_user;
        }
        else{
            echo $user->showMessage('danger', 'Login, Mot de passe et Rôle utilisateur est Incorrect!');
        }
    }

?>