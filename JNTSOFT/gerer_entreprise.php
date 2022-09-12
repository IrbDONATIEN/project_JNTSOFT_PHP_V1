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
                            <a href="#LEntreprises" class="nav-link active font-weight-bold" data-toggle="tab">Liste d'Entreprises</a>
                        </li>
                        <li class="nav-item">
                            <a href="#LEmployeurs" class="nav-link font-weight-bold" data-toggle="tab">Liste d'Employeurs</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="LEntreprises">
                            <div class="card-deck">
                                <div class="table-responsive" id="afficherListesEntreprises">
                                    <p class="text-center lead mt-5">Veuillez patienter...</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container" id="LEmployeurs">
                            <div class="card-deck">
                                <div class="table-responsive" id="afficherListesEmployeurs">
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
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Supprimer entreprise d'abonnement
        $("body").on("click", ".deleteEntrepriseIcon", function(e){
                e.preventDefault();

                supprimer_entreprise=$(this).attr('id');

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
                            url:'../assets/php/gerer_entreprise-process.php',
                            method:'post',
                            data:{supprimer_entreprise:supprimer_entreprise},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Demande Entreprise !',
                                    'Demande Entreprise supprimée avec succès.',
                                    'success'
                                )
                                afficherEntreprises();
                            } 
                        });
                        
                    }
                })

        });

        //Fetch All entreprise d'abonnement Ajax Request
        afficherEntreprises();
        function afficherEntreprises(){
            $.ajax({
                url:'../assets/php/gerer_entreprise-process.php',
                method: 'post',
                data:{action: 'afficherEntreprises'},
                success:function(response){
                    $("#afficherListesEntreprises").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }


        //Supprimer entreprise d'abonnement
        $("body").on("click", ".deleteEmployeurIcon", function(e){
                e.preventDefault();

                supprimer_employeur=$(this).attr('id');

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
                            url:'../assets/php/gerer_entreprise-process.php',
                            method:'post',
                            data:{supprimer_employeur:supprimer_employeur},
                            success:function(response){
                                Swal.fire(
                                    'Supprimer Employeur Entreprise !',
                                    'Employeur Entreprise supprimé avec succès.',
                                    'success'
                                )
                                afficherEmployeur();
                                afficherEntreprises();
                            } 
                        });
                        
                    }
                })

        });

        //Fetch All employeur de l'entreprise en Ajax Request
        afficherEmployeur();
        function afficherEmployeur(){
            $.ajax({
                url:'../assets/php/gerer_entreprise-process.php',
                method: 'post',
                data:{action: 'afficherEmployeur'},
                success:function(response){
                    $("#afficherListesEmployeurs").html(response);
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