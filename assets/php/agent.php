<?php
    require_once 'config.php';
    class Agent extends Database{

        //Enregistrer un agent abonné de l'entreprise 
        public function add_agent($nom_agent,$postnom_agent,$prenom_agent,$sexe_agent,$lieu_naissance,$date_naissance,$photo,$fonction_agent,$entreprise_agent_id){
            $sql="INSERT INTO agent(nom_agent,postnom_agent,prenom_agent,sexe_agent,lieu_naissance,date_naissance,photo,fonction_agent, entreprise_agent_id) VALUES (:nom_agent,:postnom_agent,:prenom_agent,:sexe_agent,:lieu_naissance,:date_naissance,:photo,:fonction_agent,:entreprise_agent_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom_agent'=>$nom_agent,'postnom_agent'=>$postnom_agent,'prenom_agent'=>$prenom_agent,'sexe_agent'=>$sexe_agent,'lieu_naissance'=>$lieu_naissance,'date_naissance'=>$date_naissance,'photo'=>$photo,'fonction_agent'=>$fonction_agent,'entreprise_agent_id'=>$entreprise_agent_id]);
            return true;
        }

        //Affichage avant l'édition d'agent existant dans la base de données
        public function editerAgentEntreprise($id){
            $sql="SELECT * FROM agent WHERE id_agent=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
        
        //Edition proprement dite de l'agent de l'entreprise
        public function update_agent($id,$nom_agent,$postnom_agent,$prenom_agent,$sexe_agent,$lieu_naissance,$date_naissance,$photo,$fonction_agent,$entreprise_agent_id){
            $sql="UPDATE agent SET nom_agent=:nom_agent,postnom_agent=:postnom_agent,prenom_agent=:prenom_agent,sexe_agent=:sexe_agent,lieu_naissance=:lieu_naissance,date_naissance=:date_naissance,photo=:photo,fonction_agent=:fonction_agent,entreprise_agent_id=:entreprise_agent_id WHERE id_agent=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nom_agent'=>$nom_agent,'postnom_agent'=>$postnom_agent,'prenom_agent'=>$prenom_agent,'sexe_agent'=>$sexe_agent,'lieu_naissance'=>$lieu_naissance,'date_naissance'=>$date_naissance,'photo'=>$photo,'fonction_agent'=>$fonction_agent,'entreprise_agent_id'=>$entreprise_agent_id,'id'=>$id]);
            return true;
        }

        //Delete un agent abonné de  l'entreprise
        public function deleteAgent($id){
            $sql="DELETE FROM agent WHERE id_agent=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher Agent abonné séléctionné par l'ID
        public function afficherAgentDetailsByID($id){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id,employeur.nom_employeur,demande.id_demande,demande.nbre_travailleurs,demande.demande_acceptee,agent.id_agent,agent.nom_agent,agent.postnom_agent,agent.prenom_agent,agent.sexe_agent,agent.lieu_naissance,agent.date_naissance,agent.photo,agent.fonction_agent,agent.create_date FROM entreprise INNER JOIN agent ON entreprise.id_entreprise=agent.entreprise_agent_id INNER JOIN demande ON entreprise.id_entreprise=demande.entreprise_id INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE agent.id_agent=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
         }

        //Afficher tous les agents des entreprises
        public function afficherAgentEntreprises(){
            $sql="SELECT id_entreprise,nom_entreprise,Rcc_entreprise,email_entreprise,adresse_domiciliere,date_creation,employeur_id,employeur.nom_employeur,demande.id_demande,demande.nbre_travailleurs,demande.demande_acceptee,agent.id_agent,agent.nom_agent,agent.postnom_agent,agent.prenom_agent,agent.sexe_agent,agent.lieu_naissance,agent.date_naissance,agent.photo,agent.fonction_agent,agent.create_date FROM entreprise INNER JOIN agent ON entreprise.id_entreprise=agent.entreprise_agent_id INNER JOIN demande ON entreprise.id_entreprise=demande.entreprise_id INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }

         


    }
?>