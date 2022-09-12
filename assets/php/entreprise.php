<?php
    require_once 'config.php';
    class Entreprise extends Database{

        //Enregistrer une entreprise 
        public function add_entreprise($nom_entreprise,$Rcc_entreprise,$email_entreprise,$adresse_domiciliere,$employeur_id){
            $sql="INSERT INTO entreprise(nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,employeur_id) VALUES (:nom_entreprise,:Rcc_entreprise,:email_entreprise,:adresse_domiciliere,:employeur_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom_entreprise'=>$nom_entreprise,'Rcc_entreprise'=>$Rcc_entreprise,'email_entreprise'=>$email_entreprise,'adresse_domiciliere'=>$adresse_domiciliere,'employeur_id'=>$employeur_id]);
            return true;
        }

        //Vérifier si l'entreprise existe déjà dans la base de données
        public function entreprise_existe($nom_entreprise){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id FROM entreprise WHERE nom_entreprise=:nom_entreprise";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom_entreprise'=>$nom_entreprise]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Delete entreprise
        public function deleteEntreprise($id){
            $sql="DELETE FROM entreprise WHERE id_entreprise=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les entreprises
        public function afficherEntreprises(){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id,employeur.nom_employeur FROM entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        

    }
?>