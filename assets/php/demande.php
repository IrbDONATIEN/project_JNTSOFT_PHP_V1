<?php
    require_once 'config.php';
    class Demande extends Database{

        //Enregistrer une demande entreprise 
        public function add_demande($nbre_travailleurs,$entreprise_id){
            $sql="INSERT INTO demande(nbre_travailleurs,entreprise_id) VALUES (:nbre_travailleurs,:entreprise_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nbre_travailleurs'=>$nbre_travailleurs,'entreprise_id'=>$entreprise_id]);
            return true;
        }

        //Vérifier si la demande de l'entreprise existe déjà dans la base de données
        public function demande_existe($entreprise_id){
            $sql="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,demande_acceptee FROM demande WHERE entreprise_id=:entreprise_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['entreprise_id'=>$entreprise_id]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Valider  demande entreprise
        public function validerDemande($id){
            $sql="UPDATE demande SET demande_acceptee=1,date_validation=NOW() WHERE id_demande=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Delete demande entreprise
        public function deleteDemande($id){
            $sql="DELETE FROM demande WHERE id_demande=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les demandes des entreprises
        public function afficherDemandesEntreprises(){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id,employeur.nom_employeur,demande.id_demande,demande.demande_acceptee,demande.nbre_travailleurs,demande.date_demande, demande.date_validation FROM entreprise INNER JOIN demande ON entreprise.id_entreprise=demande.entreprise_id INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE demande.demande_acceptee=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

        //Afficher toutes les demandes  des entreprises validées
        public function afficherDemandesEntreprise(){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id,employeur.nom_employeur,demande.id_demande,demande.demande_acceptee,demande.nbre_travailleurs,demande.date_demande, demande.date_validation FROM entreprise INNER JOIN demande ON entreprise.id_entreprise=demande.entreprise_id INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE demande.demande_acceptee!=0";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }
        

    }
?>