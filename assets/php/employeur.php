<?php
    require_once 'config.php';
    class Employeur extends Database{

         //Enregistrer un employeur
         public function add_employeur($nom_employeur,$adresse_domicile,$adress_email){
            $sql="INSERT INTO employeur(nom_employeur,adresse_domicile,adress_email) VALUES (:nom_employeur,:adresse_domicile,:adress_email)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom_employeur'=>$nom_employeur,'adresse_domicile'=>$adresse_domicile,'adress_email'=>$adress_email]);
            return true;
        }

        //Vérifier si l'email employeur existe déjà dans la base de données
        public function employeur_exist($adress_email){
            $sql="SELECT * FROM employeur WHERE adress_email=:adress_email";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['adress_email'=>$adress_email]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Delete employeur 
        public function deleteEmployeur($id){
            $sql="DELETE FROM employeur WHERE id_employeur=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les employeurs 
        public function afficherEmployeur(){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,employeur_id,employeur.id_employeur,employeur.nom_employeur,employeur.adress_email,employeur.date_created FROM entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        

    }
?>