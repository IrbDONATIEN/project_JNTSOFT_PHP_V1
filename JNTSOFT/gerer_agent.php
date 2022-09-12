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
                <span class="text-light lead align-self-center"><i class="fa fa-user"></i>&nbsp;Tous les agents abonnés</span>
                    <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addAgentsModal"><i class="fa fa-user"></i>&nbsp;Ajouter Agent abonné</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive" id="afficherAgents">
                    <p class="text-center lead mt-5">Veuillez patienter...</p>
                </div>
            </div>
    </div>
</div>

<!--Début d'Ajout agent abonné-->
<div class="modal fade" id="addAgentsModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fa fa-user"></i>&nbsp;Ajouter Agent Abonné</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-agent-form" class="px-3" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="nom_agent" id="nom_agent" class="form-control form-control-lg" placeholder="Entrer nom de l'agent" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="postnom_agent" id="postnom_agent" class="form-control form-control-lg" placeholder="Entrer postnom de l'agent" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom_agent" id="prenom_agent" class="form-control form-control-lg" placeholder="Entrer prénom de l'agent" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe_agent">Séléctionner Sexe Agent :</label>
                        <select name="sexe_agent" id="sexe_agent" class="form-control form-control-lg">
                            <option value="" disabled>Séléctionner sexe agent</option>
                            <option value="Masculin" required>Masculin</option>
                            <option value="Feminin" required>Féminin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lieu_naissance" id="lieu_naissance" class="form-control form-control-lg" placeholder="Entrer lieu de naissance de l'agent" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe_agent">Séléctionner date naissance agent :</label>
                        <input type="date" name="date_naissance" id="date_naissance" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="photo"> Séléctionner photo agent</label>
                        <input type="file" name="photo" id="photo" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="fonction_agent" id="fonction_agent" class="form-control form-control-lg" placeholder="Entrer fonction de l'agent" required>
                    </div>
                    <div class="form-group">
                        <label for="entreprise_agent_id">Sélectionner Entreprise de l'agent:</label>
                        <select name="entreprise_agent_id" id="entreprise_agent_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_demande,nbre_travailleurs,date_demande,entreprise_id,entreprise.id_entreprise,entreprise.nom_entreprise,employeur.id_employeur,employeur.nom_employeur,demande_acceptee,date_validation FROM demande INNER JOIN entreprise ON demande.entreprise_id=entreprise.id_entreprise INNER JOIN employeur ON entreprise.employeur_id=employeur.id_employeur WHERE demande_acceptee!=0");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_entreprise'];?>"><?php echo $tab['nom_employeur'];?>&nbsp;|&nbsp;<?php echo $tab['nom_entreprise'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addAgents" class="btn btn-info btn-block btn-lg" id="addAgentsBtn" value="Ajouter Agent Abonné" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout agent abonné-->
<!-- Début Affichage de détail d'agent abonné avec formulaire Modal-->
<div class="modal fade" id="showAgentsModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getAgent"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getPostnomAgent"></p>
                            <p id="getPrenomAgent"></p>
                            <p id="getSexeAgent"></p>
                            <p id="getLieu_naissance"></p>
                            <p id="getDate_naissance"></p>
                            <p id="getFonction_agent"></p>
                            <p id="getEntreprise"></p>
                            <p id="getEmployeur"></p>
                            <p id="getCreate_date"></p>
                        </div>
                    </div>
            <div class="card align-self-center" id="getPhoto"></div>
            </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>
<!--Fin Affichage de détail d'agent abonné avec formulaire Modal-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Afficher détail d'agent abonné en Ajax Request
        $("body").on("click", ".agentDetailsIcon", function(e){
            e.preventDefault();
            detail_agent_id=$(this).attr('id');
            $.ajax({
                url: '../assets/php/gerer_agent_ese-process.php',
                type:'post',
                data:{detail_agent_id:detail_agent_id},
                success:function(response){
                    data=JSON.parse(response);
                    $("#getAgent").text(data.nom_agent+'  '+'(ID:  '+data.id_agent+')');
                    $("#getPostnomAgent").text('Postnom: '+data.postnom_agent);
                    $("#getPrenomAgent").text('Prénom: '+data.prenom_agent);
                    $("#getSexeAgent").text('Sexe: '+data.sexe_agent);
                    $("#getLieu_naissance").text('Lieu Naissance: '+data.lieu_naissance);
                    $("#getDate_naissance").text('Date Naissance: '+data.date_naissance);
                    $("#getFonction_agent").text('Fonction Agent: '+data.fonction_agent);
                    $("#getEntreprise").text('Entreprise: '+data.nom_entreprise);
                    $("#getEmployeur").text('Employeur: '+data.nom_employeur);
                    $("#getCreate_date").text('Date Création: '+data.create_date);
                    if(data.photo !=''){
                        $("#getPhoto").html('<img src="../assets/php/'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="300px">');
                    }
                    else{
                        $("#getPhoto").html('<img src="../assets/images/avatar.png" class="img-thumbnail img-fluid align-self-center" width="300px">');
                    }

                //console.log(data);
            }
        });
    });

    //Supprimer agent abonné de l'entreprise
    $("body").on("click", ".deleteAgentIcon", function(e){
                e.preventDefault();

                supprimer_agent=$(this).attr('id');

                Swal.fire({
                    title: 'Etes-vous sûr de Supprimer ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimez-le!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/gerer_agent_ese-process.php',
                            method:'post',
                            data:{supprimer_agent:supprimer_agent},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Agent abonné Entreprise !',
                                    'Agent abonné Entreprise supprimé avec succès.',
                                    'success'
                                )
                                afficherAgentEntreprises();
                            } 
                        });
                        
                    }
                })

        });

        //Ajouter agent abonné Ajax Request
        $("#add-agent-form").submit(function(e){
             e.preventDefault();

             $.ajax({
                url:'../assets/php/gerer_agent_ese-process.php',
                method:'post',
                processData:false,
                contentType:false,
                cache:false,
                data:new FormData(this),
                success:function(response){
                    //location.reload();
                    $("#add-agent-form")[0].reset();
                    $("#addAgentsModal").modal('hide');
                    Swal.fire({
                        title:'Agent abonné ajouté avec succès !',
                        type:'success'
                    });
                    afficherAgentEntreprises();
                }
            });
        });

        //Fetch All Agent abonné Entreprise Ajax Request
        afficherAgentEntreprises();

        function afficherAgentEntreprises(){
            $.ajax({
                url:'../assets/php/gerer_agent_ese-process.php',
                method: 'post',
                data:{action: 'afficherAgentEntreprises'},
                success:function(response){
                    $("#afficherAgents").html(response);
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