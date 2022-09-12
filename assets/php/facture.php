<?php
    require_once 'config.php';
    class Facture extends Database{

        //Enregistrer facture de l'abonnement de l'entreprise 
        public function add_facture($type_fac,$prix_unit,$nbres,$entreprise_fac_id){
            $sql="INSERT INTO facture(type_fac,prix_unit,nbres,entreprise_fac_id) VALUES (:type_fac,:prix_unit,:nbres,:entreprise_fac_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_fac'=>$type_fac,'prix_unit'=>$prix_unit,'nbres'=>$nbres,'entreprise_fac_id'=>$entreprise_fac_id]);
            return true;
        }

        //Montant Général Généré  
        public function caisseTotalGenerals(){
            $sql="SELECT id_facture, type_fac,prix_unit,nbres,SUM(prix_unit*nbres) as Total,entreprise_fac_id,create_dates FROM facture";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->fetch(PDO::FETCH_ASSOC);
            return $count;
        }

        //Affichage avant l'édition de facture de l'abonnement de l'entreprise existante dans la base de données
        public function editerFacture($id){
            $sql="SELECT * FROM facture WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de frais d'abonnement de l'entreprise
        public function update_facture($id,$type_fac,$prix_unit,$nbres,$entreprise_fac_id){
            $sql="UPDATE facture SET type_fac=:type_fac,prix_unit=:prix_unit,nbres=:nbres,entreprise_fac_id=:entreprise_fac_id WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['type_fac'=>$type_fac,'prix_unit'=>$prix_unit,'nbres'=>$nbres,'entreprise_fac_id'=>$entreprise_fac_id,'id'=>$id]);
            return true;
        }

        //Delete facture d'abonnement de l'entreprise
        public function deleteFacture($id){
            $sql="DELETE FROM facture WHERE id_facture=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les factures d'abonnements des entreprises
        public function afficherFacturesAbonnesEntreprises(){
            $sql="SELECT id_facture,type_fac,prix_unit,nbres,(prix_unit*nbres) as Totals,entreprise_fac_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere, create_dates FROM facture INNER JOIN entreprise ON facture.entreprise_fac_id=entreprise.id_entreprise";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>