<?php
    require_once 'assets/php/headerindex.php';
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo" style="width: 200px;height: 100px;">
                <img src="assets/images/logo1.png" style="width: 100%;height: 100%;object-fit: scale-down;position: relative;left: 70%;">
              </div>
              <hr>
              <div class="card-header bg-info">
                <h3 class="m-0 text-white"><i class="fas fa-user"></i>&nbsp;JNTSOFT</h3>
              </div>
              <form class="pt-3" action="#" id="login-form" method="post">
                <div id="LoginAlert"></div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="login_user" name="login_user" placeholder="Votre login utilisateur" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe utilisateur" required>
                </div>
                <div class="form-group">
                      <select name="type_utilisateur" id="type_utilisateur" class="form-control  form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM roles");
                                  while ($tab=$req->fetch()){?>
                                     <option value="<?php echo $tab['id'];?>"><?php echo $tab['roles'];?></option>
                            <?php
                                }
                            ?>
                      </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="valider" class="btn btn-info btn-block btn-lg" value="Se connecter" id="LoginBtn" required>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
    require_once 'assets/php/footer.php';
?>
<script type="text/javascript">
     $(document).ready(function(){
        $("#LoginBtn").click(function(e){
          if($("#login-form")[0].checkValidity()){
              e.preventDefault();
              
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'assets/php/action.php',
                  method : 'post',
                  data : $("#login-form").serialize()+'&action=login',
                  success:function(response){
                      if(response ==='login_log'){
                          window.location = 'JNTSOFT/abonnement.php';
                      }
                      else{
                          $("#LoginAlert").html(response);
                      }
                      window.location = 'JNTSOFT/abonnement.php';
                      $("#LoginBtn").val('Se connecter');
                  }
              });
          }  
        });
     });
 </script>
</body>
</html>