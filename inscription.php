<?php
    require_once 'assets/php/headerindex.php';
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
    <h4 class="text-center text-primary mt-3">Identification Employeur! Etape 1</h4>
    <hr>
    <!--Début du premier corps d'onglet-->
    <div class="tab-pane container mt-2" id="ajoutemployeur">
        <div class="card-deck">
            <div class="card border-primary align-self-center">
                <form action="#" method="post" class="px-3 mt-2" id="register-form">
                    <div id="regAlert"></div>
                    <div class="form-group">
                        <label for="nom_employeur" class="m-1">Nom Employeur:</label>
                        <input type="text" name="nom_employeur" id="nom_employeur" class="form-control rounded-0" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="adresse_domicile" class="m-2">Adresse Domicile Employeur:</label>
                        <textarea name="adresse_domicile" id="adresse_domicile" cols="3" rows="2" class="form-control rounded-0" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="adress_email" class="m-2">E-mail valide Employeur:</label>
                        <input type="email" name="adress_email" id="adress_email" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ajouter Employeur"  id="register-btn" class="btn btn-primary btn-lg btn-block">
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

        // Register Employeur abonnement  ajax request
        $("#register-btn").click(function(e){
            if($("#register-form")[0].checkValidity()){
                e.preventDefault();
                    $("#register-btn").val('Veuillez patientez...');
                    $.ajax({
                        url:'action.php',
                        method:'post',
                        data: $("#register-form").serialize()+'&action=register',
                        success:function(response){
                            $("#register-btn").val('Ajouter Employeur');
                            if(response==='register'){
                                window.location ='entreprise.php';
                            }
                            else{
                                $("#regAlert").html(response);
                            }
                            window.location ='entreprise.php';
                        }
                    });
                
            } 
         });
         
    });
</script>
</body>
</html>