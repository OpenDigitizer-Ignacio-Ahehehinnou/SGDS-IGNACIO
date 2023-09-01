@extends("layouts.master")


@section("contenu")



<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="col-md-3"></div>

        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <div class="tab-pane" id="">
                    <br>
                    <div id="msg200"></div>
                    
                    <form class="form-horizontal">

                        <b>
                            <h3 class="ml-2" style="margin-left:40px;"><b>Mettez à jour le mot de passe</b></h3>
                        </b>
                            <br>
                        

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new_password"
                                            name="new_password"
                                            style="border-radius: 10px;">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="">
                                        <label for="">Confirmer mot de passe</label>
                                        <input type="password" class="form-control" id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            style="border-radius: 10px;">
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <div class="col-offset-2">
                                        <button type="submit" class="btn btn-success"
                                            id="sauvegarder2">Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>

                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
        <!-- /.col -->
    </div>

</section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Lorsque le bouton "Envoyer" est cliqué
        $("#sauvegarder2").click(function (e) {
            e.preventDefault();
        
            var id= $("#id").val();
            var new_password = $("#new_password").val();
            var new_password_confirmation = $("#new_password_confirmation").val();
            var pass= 8;


            // Récupérer le jeton CSRF depuis la balise meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //alert(tableauDonnees)
            // Créez un objet JSON contenant toutes les données
            var donneesAEnvoyer = {
                _token: csrfToken,new_password,new_password_confirmation,id
            };

            if(new_password != new_password_confirmation){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                                <b>Les mots de passe ne correspondent pas</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </p>`);
                //$('#confirm_password').css("border","2px solid red");


            }else if(new_password=="" || new_password_confirmation==""){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                                <b>Veuillez remplir les champs vide</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                                </div>`);
                            
            }else if((new_password.length) < pass){
                $('#msg200').html(` <div class='alert alert-warning text-center' role='alert'>
                <b>Votre mot de passe doit être supérieur ou égal à huit caractères </b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>`);

            }
            else{

                // Envoyez les données au contrôleur via une requête AJAX
                $.ajax({
                    type: "GET",
                    url: "{{ route('user_modif')}}",
                    data: donneesAEnvoyer,
                    success: function (response) {

                        if(parseInt(response)==200 || parseInt(response)==500){
                            
                            parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                                <strong>L'ancien mot de passe n'est pas correcte</strong> veuillez réessayez.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                                </div>`)
                            ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                                <strong> Mot de passe modifiée avec succès. </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>`)
                            ); 
                        }
                        
                        var url="{{route('accueil')}}" 
                        if(response==200){
                            setTimeout(function(){
                                window.location=url
                            },1000) 
                        }  else{
                            $("#msg200").html(response);

                            }
                    },
                    
                });
        
            }
        });
    });
</script>