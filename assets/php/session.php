<?php
session_start();
require_once 'auth.php';
$cuser=new Auth();

//Session JNTSOFT
if(!isset($_SESSION['users'])){
    header('location:../index.php');
    die;
}
    $clogin_user=$_SESSION['users'];
    
    $data=$cuser->currentUser($clogin_user);

    $cid=$data['id'];
    $crole=$data['type_utilisateur'];
    $croles=$data['roles'];
    $cnom=$data['nom'];
    $cprenom=$data['prenom'];
    $cpostnom=$data['postnom'];

    if($crole==1){
        $crole='Comptable';
    }
    else if($crole==2){
        $crole='Chef Administratif';
    }
    else if ($crole==3){
        $crole='Receptinniste';
    }
    else{
         $crole='Gestionnaire';
    }

?>