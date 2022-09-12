<?php
    require_once 'config.php';
    class Carte_agent extends Database{

        //Enregistrer une carte agent abonné de l'entreprise 
        public function add_carte_agent($code_unique,$nbre_enfant,$date_etablissement,$agent_id){
            $sql="INSERT INTO carte_agent(code_unique,nbre_enfant,date_etablissement,agent_id) VALUES (:code_unique,:nbre_enfant,:date_etablissement,:agent_id)"; 
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['code_unique'=>$code_unique,'nbre_enfant'=>$nbre_enfant,'date_etablissement'=>$date_etablissement,'agent_id'=>$agent_id]);
            return true;
        }

        //Vérifier si la carte agent abonné  de l'entreprise existe déjà dans la base de données
        public function carte_agent_existe($agent_id){
            $sql="SELECT id_carte,code_unique,nbre_enfant,date_etablissement,agent_id FROM carte_agent WHERE agent_id=:agent_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['agent_id'=>$agent_id]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        //Affichage avant l'édition de la carte de l'agent de l'entreprise existante dans la base de données
        public function editerCarteAgent($id){
            $sql="SELECT * FROM carte_agent WHERE id_carte=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            $result=$stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        //Edition proprement dite de la carte de l'agent abonné de l'entreprise
        public function update_carte_agent($id,$nbre_enfant,$date_etablissement,$agent_id){
            $sql="UPDATE carte_agent SET nbre_enfant=:nbre_enfant,date_etablissement=:date_etablissement,agent_id=:agent_id WHERE id_carte=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['nbre_enfant'=>$nbre_enfant,'date_etablissement'=>$date_etablissement,'agent_id'=>$agent_id,'id'=>$id]);
            return true;
        }

        //Delete une carte agent abonné de l'entreprise
        public function updateAgent($agent_id){
            $sql="UPDATE agent SET etat_carte=1 WHERE id_agent=:agent_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['agent_id'=>$agent_id]);

            return true;
        }

        //Delete une carte agent abonné de l'entreprise
        public function updateAgents($agent_id){
            $sql="UPDATE agent SET etat_carte=0 WHERE id_agent=:agent_id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['agent_id'=>$agent_id]);

            return true;
        }

        //Delete une carte agent abonné de l'entreprise
        public function deleteCarteAgent($id){
            $sql="DELETE FROM carte_agent WHERE id_carte=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);

            return true;
        }

        //Afficher toutes les cartes des agents des entreprises
        public function afficherCartesAgentEntreprises(){
            $sql="SELECT id_agent,nom_agent,postnom_agent,prenom_agent,sexe_agent,lieu_naissance,date_naissance,photo,fonction_agent, entreprise_agent_id,entreprise.nom_entreprise,entreprise.employeur_id,entreprise.Rcc_entreprise,entreprise.adresse_domiciliere, carte_agent.id_carte,carte_agent.code_unique,carte_agent.nbre_enfant,carte_agent.agent_id, carte_agent.date_etablissement, employeur.nom_employeur FROM agent INNER JOIN carte_agent ON agent.id_agent=carte_agent.agent_id INNER JOIN entreprise ON agent.entreprise_agent_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        }


    }
?>