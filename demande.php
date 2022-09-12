<?php
    require_once 'assets/php/headerindex.php';
    require_once 'assets/php/connexion.php';
?>
<div class="container mt-2">
    <div class="mt-2">
            <img src="cmdc.png">
    </div>
    <div class="alert alert-info bg-info alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>INSCRIVEZ-VOUS SUR VOTRE FORMULAIRE ABONNEMENT EMPLOYEUR EN TROIS ETAPES  !</strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-3">Poster votre demande unique pour l'entreprise! Etape 3</h4>
    <hr>
    <!--Début du premier corps d'onglet-->
    <div class="tab-pane container mt-2" id="ajoutDemande">
        <div class="card-deck">
            <div class="card border-primary align-self-center">
                <form action="#" method="post" class="px-3 mt-2" id="register-form">
                    <div id="regAlert"></div>
                    <div class="form-group">
                        <label for="nbre_travailleurs" class="m-1">Entrer nombre travailleur:</label>
                        <input type="number" name="nbre_travailleurs" id="nbre_travailleurs" class="form-control rounded-0" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="entreprise_id">Sélectionner Entreprise et Employeur:</label>
                        <select name="entreprise_id" id="entreprise_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT `id_entreprise`, `nom_entreprise`, `Rcc_entreprise`, `email_entreprise`, `adresse_domiciliere`, `date_creation`, `employeur_id`, employeur.nom_employeur, employeur.adress_email FROM `entreprise` INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_entreprise'];?>"><?php echo $tab['nom_entreprise'];?>&nbsp;|&nbsp;<?php echo $tab['nom_employeur'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ajouter Demande"  id="register-btn" class="btn btn-primary btn-lg btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    require_once 'assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        // Register Demande abonnement  ajax request
        $("#register-btn").click(function(e){
            if($("#register-form")[0].checkValidity()){
                e.preventDefault();
                    $("#register-btn").val('Veuillez patientez...');
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data: $("#register-form").serialize()+'&action=register_s',
                        success:function(response){
                            $("#register-btn").val('Ajouter Demande');
                            if(response==='register_s'){
                                window.location ='index.php';
                            }
                            else{
                                $("#regAlert").html(response);
                            }
                            window.location ='index.php';
                        }
                    });
                
            } 
         });
         
    });
</script>
</body>
</html>