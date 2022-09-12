<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/connexion.php';

    //Création code unique
    $mois = (int)(date("m"));
    $sec1 = date("s");
    $sec2 = (int)(date("s"));
    $code1 = $mois+$sec2 + $sec1+$sec1;
    $code2 = $code1 +$sec1+$sec2 + $mois;  
    $code_unique= $code1.''.$code2 ;
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
            <span class="text-light lead align-self-center"><i class="fas fa-id-card"></i>&nbsp;Toutes les Cartes d'Agents Abonnés</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addCartesModal"><i class="fas fa-id-card"></i>&nbsp;Ajouter Carte Agent Abonnés</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherCartes">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>

<!--Début d'Ajout carte agent abonné-->
<div class="modal fade" id="addCartesModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fas fa-id-card"></i>&nbsp;Ajouter Carte Agent</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-carte-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="hidden" name="code_unique" id="code_unique" value="<?php echo $code_unique;?>">
                        <input type="number" name="nbre_enfant" id="nbre_enfant" class="form-control form-control-lg" placeholder="Entrer nombre enfant agent" required autofocus>
                    </div>
                    <div class="form-group">
                        <label>Sélectionner la date d'Etablissement de cette carte:</label>
                        <input type="date" name="date_etablissement" id="date_etablissement" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="agent_id">Sélectionner Agent abonné:</label>
                        <select name="agent_id" id="agent_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_agent, nom_agent,postnom_agent,prenom_agent,sexe_agent,lieu_naissance,date_naissance,photo,fonction_agent, entreprise_agent_id,entreprise.nom_entreprise,entreprise.Rcc_entreprise,create_date,etat_carte FROM agent INNER JOIN entreprise ON agent.entreprise_agent_id=entreprise.id_entreprise WHERE etat_carte=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_agent'];?>"><?php echo $tab['nom_agent'];?>&nbsp;|&nbsp;<?php echo $tab['nom_entreprise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addCarte" class="btn btn-info btn-block btn-lg" id="addCarteBtn" value="Ajouter Carte Agent" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout carte agent abonné-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Afficher voir  la carte d'accès aux soins médicaux en Ajax Request
        $("body").on("click", ".infoCarteBtn", function(e){
                e.preventDefault();
                detail_carte_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/etablir_carte-process.php',
                    type:'post',
                    data:{detail_carte_id:detail_carte_id},
                    success:function(response){
                        window.location ='carte_agent.php?id='+detail_carte_id;
                    }
                });
        });

        //Ajouter carte agent en Ajax Request
        $("#addCarteBtn").click(function(e){
            if($("#add-carte-form")[0].checkValidity()){
                e.preventDefault();
                $("#addCarteBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/etablir_carte-process.php',
                    method:'post',
                    data:$("#add-carte-form").serialize()+'&action=add_carte',
                    success:function(response){
                        if(response==='add_carte'){  
                        }
                        else{
                            $("#addCarteBtn").val('Ajouter Carte Agent');
                            $("#add-carte-form")[0].reset();
                            $("#addCartesModal").modal('hide');
                            Swal.fire({
                                title:'Carte agent ajoutée avec succès !',
                                type:'success'
                            });

                            $("#userAlert").html(response);
                        }
                        afficherCartesAgentEntreprises();
                    }
                });
            }
        });


        //Delete carte d'accès aux soins médicaux abonné
        $("body").on("click", ".deleteCartesIcon", function(e){
            e.preventDefault();

            del_carte_id=$(this).attr('id');
            updat_ag=$(this).attr('idag');

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
                            url:'../assets/php/etablir_carte-process.php',
                            method:'post',
                            data:{del_carte_id:del_carte_id,updat_ag:updat_ag},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Carte d\'accès aux soins médicaux !',
                                    'Carte d\'accès aux soins médicaux supprimée avec succès.',
                                    'success'
                                )
                                afficherCartesAgentEntreprises();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All cartes des agents abonnés en Ajax Request
        afficherCartesAgentEntreprises();

        function afficherCartesAgentEntreprises(){
            $.ajax({
                url:'../assets/php/etablir_carte-process.php',
                method: 'post',
                data:{action: 'afficherCartesAgentEntreprises'},
                success:function(response){
                    $("#afficherCartes").html(response);
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