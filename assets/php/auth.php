<?php
     require_once 'config.php';
     class Auth extends Database{
        
        //Login Utilisateur
        public function loginUser($login_user,$motdepasse,$type_utilisateur){
            $sql="SELECT login_user,motdepasse,type_utilisateur FROM utilisateur WHERE login_user=:login_user AND motdepasse=:motdepasse AND type_utilisateur=:type_utilisateur";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login_user'=>$login_user,'motdepasse'=>$motdepasse,'type_utilisateur'=>$type_utilisateur]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Afficher les détails de l'utilisateur  connecté
        public function currentUser($login_user){
            $sql="SELECT utilisateur.id,nom,postnom,prenom,sexe,telephone,login_user,motdepasse,type_utilisateur,roles.roles FROM utilisateur INNER JOIN roles ON utilisateur.type_utilisateur=roles.id WHERE login_user=:login_user";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['login_user'=>$login_user]);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        //Compteur de nombres des lignes dans chaque tables
        public function totalCount($tablename){
            $sql="SELECT * FROM $tablename";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

        //Compteur de nombre 
        public function totalDemandeAcceptee(){
            $sql="SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,demande_acceptee FROM demande WHERE demande_acceptee=1";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $count=$stmt->rowCount();
            return $count;
        }

     }
?>