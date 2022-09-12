<?php
    require_once 'config.php';
    class Protocole extends Database{

        //Enregistrer un protocole d'accords sur la demande de l'entreprise 
        public function add_protocole_accord_demande($description_protocole,$demande_id){
            $sql="INSERT INTO protocole_accord(description_protocole,demande_id) VALUES (:description_protocole,:demande_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['description_protocole'=>$description_protocole,'demande_id'=>$demande_id]);
            return true;
        }

        //Vérifier si le protocole d'accord sur la demande de l'entreprise existe déjà dans la base de données
        public function protocole_demande_existe($demande_id){
            $sql="SELECT id_protocole,description_protocole,demande_id,date_created FROM protocole_accord WHERE demande_id=:demande_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['demande_id'=>$demande_id]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Delete protocole par demande entreprise
        public function deleteProtocoleDemande($id){
            $sql="DELETE FROM protocole_accord WHERE id_protocole=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Affichage avant l'édition du protocole sur la demande de l'entreprise existante dans la base de données
        public function editerProtocoleDemande($id){
            $sql="SELECT * FROM protocole_accord WHERE id_protocole=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

         //Edition proprement dite du protocole d'accord sur la demande de l'entreprise
         public function update_protocole_demande($id,$description_protocole,$demande_id){
            $sql="UPDATE protocole_accord SET description_protocole=:description_protocole,demande_id=:demande_id WHERE id_protocole=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['description_protocole'=>$description_protocole,'demande_id'=>$demande_id,'id'=>$id]);
            return true;
        }

        //Afficher tous les protocoles d'accords sur les demandes des entreprises
        public function afficherProtocolesDemandesEntreprises(){
            $sql="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.email_entreprise,entreprise.adresse_domiciliere,entreprise.employeur_id,demande_acceptee,employeur.nom_employeur,protocole_accord.id_protocole,protocole_accord.description_protocole,protocole_accord.demande_id,protocole_accord.date_created FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur INNER JOIN protocole_accord ON demande.id_demande=protocole_accord.demande_id WHERE demande_acceptee=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }




    }
?>