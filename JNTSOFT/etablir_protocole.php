<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/connexion.php';
?>
<div class="container mt-2">
    <div class="mt-2">
            <img src="../assets/images/cmdc.png">
    </div>
    <div class="alert alert-info bg-info alert-dismissible text-center text-white mt-2 m-0">
        <div class="col-lg-16">
            <strong>Bienvenu(e) dans le système d'abonnement JNTSOFT  Nom:&nbsp;<?=$cnom;?> &nbsp;Prénom:&nbsp;<?=$cprenom;?> Fonction:<?=$croles;?>&nbsp;</strong>
        </div>
    </div>
    <hr>
    <div class="card border-info mt-2">
            <h5 class="card-header bg-info d-flex justify-content-between">
                <span class="text-light lead align-self-center"><i class="fa fa-folder"></i>&nbsp;Tous les protocoles d'Accords Abonnés</span>
                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addProtocolesModal"><i class="fa fa-folder"></i>&nbsp;Ajouter Protocole Accords</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive" id="afficherProtocoles">
                    <p class="text-center lead mt-5">Veuillez patienter...</p>
                </div>
            </div>
    </div>
</div>
<!--Début d'Ajout protocole d'accords abonné-->
<div class="modal fade" id="addProtocolesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-folder"></i>&nbsp;Ajouter Protocole d'accords</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-protocole-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="description_protocole" id="description_protocole" class="form-control form-control-lg" placeholder="Entrer nom du chef Administratif" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="demande_id">Sélectionner demande Entreprise:</label>
                        <select name="demande_id" id="demande_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.id_entreprise,entreprise.nom_entreprise,employeur.id_employeur,employeur.nom_employeur,demande_acceptee,date_validation FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE demande_acceptee!=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_demande'];?>"><?php echo $tab['nom_employeur'];?>&nbsp;|&nbsp;<?php echo $tab['nom_entreprise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addProtocole" class="btn btn-info btn-block btn-lg" id="addProtocoleBtn" value="Ajouter Protocole" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout protocole d'accords abonné-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Afficher voir  document procotole d'accords  en Ajax Request
        $("body").on("click", ".infoProtocoleBtn", function(e){
                e.preventDefault();
                detail_protocole_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/etablir_protocole-process.php',
                    type:'post',
                    data:{detail_protocole_id:detail_protocole_id},
                    success:function(response){
                        window.location ='documents_protocole.php?id='+detail_protocole_id;
                    }
                });
        });

        //Ajouter protocole d'accords en Ajax Request
        $("#addProtocoleBtn").click(function(e){
            if($("#add-protocole-form")[0].checkValidity()){
                e.preventDefault();
                $("#addProtocoleBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/etablir_protocole-process.php',
                    method:'post',
                    data:$("#add-protocole-form").serialize()+'&action=add_proto',
                    success:function(response){
                        if(response==='add_proto'){  
                        }
                        else{
                            $("#addProtocoleBtn").val('Ajouter Protocole');
                            $("#add-protocole-form")[0].reset();
                            $("#addProtocolesModal").modal('hide');
                            Swal.fire({
                                title:'Protocole d\'accords ajouté avec succès !',
                                type:'success'
                            });

                            $("#userAlert").html(response);
                        }
                        afficherProtocolesDemandesEntreprises();
                    }
                });
            }
        });


        //Delete Protocole d'accords entreprise abonnée
        $("body").on("click", ".deleteUtilisateursIcon", function(e){
            e.preventDefault();

            del_protocole_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/etablir_protocole-process.php',
                            method:'post',
                            data:{del_protocole_id:del_protocole_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Protocole d\'accords entreprise !',
                                    'Protocole d\'accords entreprise supprimé avec succès.',
                                    'success'
                                )
                                afficherProtocolesDemandesEntreprises();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All protocole d'accords entreprise abonnée Ajax Request
        afficherProtocolesDemandesEntreprises();

        function afficherProtocolesDemandesEntreprises(){
            $.ajax({
                url:'../assets/php/etablir_protocole-process.php',
                method: 'post',
                data:{action: 'afficherProtocolesDemandesEntreprises'},
                success:function(response){
                    $("#afficherProtocoles").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>
</html>