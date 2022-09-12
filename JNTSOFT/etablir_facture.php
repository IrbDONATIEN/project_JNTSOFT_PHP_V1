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
            <span class="text-light lead align-self-center"><i class="fas fa-business-time"></i>&nbsp;Toutes les Factures d'Entreprises Abonnées</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addFacturesModal"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture Entreprise Abonné</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherFactures">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>

<!--Début d'Ajout facture abonné-->
<div class="modal fade" id="addFacturesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-facture-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="type_fac" id="type_frais" class="form-control form-control-lg" placeholder="Entrer type facture" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="number" name="prix_unit" id="prix_unit" class="form-control form-control-lg" placeholder="Entrer prix unitaire" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="nbres" id="nbres" class="form-control form-control-lg" placeholder="Entrer nombre agent" required>
                    </div>
                    <div class="form-group">
                        <label for="entreprise_fac_id">Sélectionner Entreprise:</label>
                        <select name="entreprise_fac_id" id="entreprise_fac_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.id_entreprise,entreprise.nom_entreprise,employeur.id_employeur,employeur.nom_employeur,demande_acceptee,date_validation FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE demande_acceptee!=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_entreprise'];?>"><?php echo $tab['nom_employeur'];?>&nbsp;|&nbsp;<?php echo $tab['nom_entreprise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addFacture" class="btn btn-info btn-block btn-lg" id="addFactureBtn" value="Ajouter Facture" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout facture abonné-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Afficher voir  facture  en Ajax Request
        $("body").on("click", ".infoFactureBtn", function(e){
                e.preventDefault();
                detail_facture_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/etablir_facture-process.php',
                    type:'post',
                    data:{detail_facture_id:detail_facture_id},
                    success:function(response){
                        window.location ='document_facture.php?id='+detail_facture_id;
                    }
                });
        });

        //Ajouter facture entreprise abonnée en Ajax Request
        $("#addFactureBtn").click(function(e){
            if($("#add-facture-form")[0].checkValidity()){
                e.preventDefault();
                $("#addFactureBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/etablir_facture-process.php',
                    method:'post',
                    data:$("#add-facture-form").serialize()+'&action=add_facture',
                    success:function(response){
                            $("#addFactureBtn").val('Ajouter Facture');
                            $("#add-facture-form")[0].reset();
                            $("#addFacturesModal").modal('hide');
                            Swal.fire({
                                title:'Facture ajoutée avec succès !',
                                type:'success'
                            });
                            afficherFacturesAbonnesEntreprises();
                    }
                });
            }
        });


        //Delete Facture entreprise abonnée
        $("body").on("click", ".deleteFacturesIcon", function(e){
            e.preventDefault();

            del_facture_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-la!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/etablir_facture-process.php',
                            method:'post',
                            data:{del_facture_id:del_facture_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Facture entreprise !',
                                    'Facture entreprise supprimée avec succès.',
                                    'success'
                                )
                                afficherFacturesAbonnesEntreprises();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All factures entreprise abonnée Ajax Request
        afficherFacturesAbonnesEntreprises();

        function afficherFacturesAbonnesEntreprises(){
            $.ajax({
                url:'../assets/php/etablir_facture-process.php',
                method: 'post',
                data:{action: 'afficherFacturesAbonnesEntreprises'},
                success:function(response){
                    $("#afficherFactures").html(response);
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