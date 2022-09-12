<?php
    require_once 'config.php';
    class Frais extends Database{

        //Enregistrer frais de l'abonnement de l'entreprise 
        public function add_frais($type_frais,$prix_unitaire,$demande_val_id){
            $sql="INSERT INTO frais(type_frais,prix_unitaire,demande_val_id) VALUES (:type_frais,:prix_unitaire,:demande_val_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_frais'=>$type_frais,'prix_unitaire'=>$prix_unitaire,'demande_val_id'=>$demande_val_id]);
            return true;
        }

        //Affichage avant l'édition de frais de l'abonnement de l'entreprise existante dans la base de données
        public function editerFrais($id){
            $sql="SELECT * FROM frais WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de frais d'abonnement de l'entreprise
        public function update_frais($id,$type_frais,$prix_unitaire,$demande_val_id){
            $sql="UPDATE frais SET type_frais=:type_frais,prix_unitaire=:prix_unitaire,demande_val_id=:demande_val_id WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_frais'=>$type_frais,'prix_unitaire'=>$prix_unitaire,'demande_val_id'=>$demande_val_id,'id'=>$id]);
            return true;
        }

        //Delete frais d'abonnement de l'entreprise
        public function deleteFrais($id){
            $sql="DELETE FROM frais WHERE id_frais=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher tous les frais d'abonnements des entreprises
        public function afficherFraisAbonnesEntreprises(){
            $sql="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere,demande_acceptee, frais.id_frais, frais.type_frais,frais.prix_unitaire,frais.demande_val_id,(frais.prix_unitaire*nbre_travailleurs) as Total FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN frais ON demande.id_demande=frais.demande_val_id WHERE demande_acceptee=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>