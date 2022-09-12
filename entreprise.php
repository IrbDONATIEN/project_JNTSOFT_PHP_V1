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
            <strong>INSCRIVEZ-VOUS SUR VOTRE FORMULAIRE ABONNEMENT EMPLOYEUR EN TROIS ETAPES !</strong>
        </div>
    </div>
    <h4 class="text-center text-primary mt-3">Enregistrement Entreprise! Etape 2</h4>
    <hr>
    <!--Début du premier corps d'onglet-->
    <div class="tab-pane container mt-2" id="ajoutentreprise">
        <div class="card-deck">
            <div class="card border-primary align-self-center">
                <form action="#" method="post" class="px-3 mt-2" id="register-form">
                    <div id="regAlert"></div>
                    <div class="form-group">
                        <label for="nom_entreprise" class="m-1">Nom Entreprise:</label>
                        <input type="text" name="nom_entreprise" id="nom_entreprise" class="form-control rounded-0" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="Rcc_entreprise" class="m-1">Entreprise numéro RCCM :</label>
                        <input type="text" name="Rcc_entreprise" id="Rcc_entreprise" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="email_entreprise" class="m-2">E-mail valide Entreprise:</label>
                        <input type="email" name="email_entreprise" id="email_entreprise" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse_domiciliere" class="m-2">Adresse Domicilière Entreprise ou Siège Social:</label>
                        <textarea name="adresse_domiciliere" id="adresse_domiciliere" cols="3" rows="2" class="form-control rounded-0" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="employeur_id">Sélectionner Nom Employeur:</label>
                        <select name="employeur_id" id="employeur_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM employeur");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_employeur'];?>"><?php echo $tab['nom_employeur'];?>&nbsp;|&nbsp;<?php echo $tab['adress_email'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ajouter Entreprise"  id="register-btn" class="btn btn-primary btn-lg btn-block">
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

        // Register Entreprise abonnement  ajax request
        $("#register-btn").click(function(e){
            if($("#register-form")[0].checkValidity()){
                e.preventDefault();
                    $("#register-btn").val('Veuillez patientez...');
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data: $("#register-form").serialize()+'&action=registers',
                        success:function(response){
                            $("#register-btn").val('Ajouter Entreprise');
                            if(response==='registers'){
                                window.location ='demande.php';
                            }
                            else{
                                $("#regAlert").html(response);
                            }
                            window.location ='demande.php';
                        }
                    });
                
            } 
         });
         
    });
</script>
</body>
</html>