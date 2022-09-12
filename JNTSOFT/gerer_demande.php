<?php
    require_once '../assets/php/header.php';
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
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card rounded-0 mt-3 border-success">
                <div class="card-header border-success">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#LDemandes" class="nav-link active font-weight-bold" data-toggle="tab">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a href="#LDemandesV" class="nav-link font-weight-bold" data-toggle="tab">Liste des demandes validées</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="LDemandes">
                            <div class="card-deck">
                                <div class="card border-primary align-self-center">
                                    <div class="card-body">
                                        <div class="table-responsive" id="afficherListesDemandes">
                                            <p class="text-center lead mt-5">Veuillez patienter...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container" id="LDemandesV">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <div class="card-body">
                                        <div class="table-responsive" id="afficherListesDemandesV">
                                            <p class="text-center lead mt-5">Veuillez patienter...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Valider demande d'abonnement de l'entreprise
         $("body").on("click", ".editerDemandeIcon", function(e){
                e.preventDefault();

                valider_demande=$(this).attr('id');

                Swal.fire({
                    title: 'Etes-vous sûr de Valider ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d2',
                    cancelButtonColor: '#d22',
                    confirmButtonText: 'Oui, validez-la!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/gerer_demande-process.php',
                            method:'post',
                            data:{valider_demande:valider_demande},
                            success:function(response){
                                Swal.fire(
                                    'Valider Demande Entreprise !',
                                    'Demande Entreprise validée avec succès.',
                                    'success'
                                )
                                afficherDemandesEntreprises();
                                afficherDemandesEntreprise();
                            } 
                        });
                        
                    }
                })

        });

        //Supprimer demande d'abonnement de l'entreprise
        $("body").on("click", ".deleteDemandeIcon", function(e){
                e.preventDefault();

                supprimer_demande=$(this).attr('id');

                Swal.fire({
                    title: 'Etes-vous sûr de Supprimer ?',
                    text: "Vous ne pourrez pas revenir en arrière !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimez-la!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/gerer_demande-process.php',
                            method:'post',
                            data:{supprimer_demande:supprimer_demande},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Demande Entreprise !',
                                    'Demande Entreprise supprimée avec succès.',
                                    'success'
                                )
                                afficherDemandesEntreprises();
                                afficherDemandesEntreprise();
                            } 
                        });
                        
                    }
                })

        });

        //Fetch All Demandes d'abonnement de l'entreprise Ajax Request
        afficherDemandesEntreprises();
        function afficherDemandesEntreprises(){
            $.ajax({
                url:'../assets/php/gerer_demande-process.php',
                method: 'post',
                data:{action: 'afficherDemandesEntreprises'},
                success:function(response){
                    $("#afficherListesDemandes").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }

        //Fetch All Demandes valide d'abonnement de l'entreprise Ajax Request
        afficherDemandesEntreprise();
        function afficherDemandesEntreprise(){
            $.ajax({
                url:'../assets/php/gerer_demande-process.php',
                method: 'post',
                data:{action: 'afficherDemandesEntreprise'},
                success:function(response){
                    $("#afficherListesDemandesV").html(response);
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