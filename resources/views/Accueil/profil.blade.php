@extends("layouts.master")


@section("contenu")



<!-- Main content -->
<section class="content mt-3">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle"
                        src="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6"
                        alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $nom }} {{ $prenom }}</h3>

                    <p class="text-muted text-center">{{ $role }}</p><br>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Entreprise </b> <a class="pull-right">{{ $entreprise }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Matricule</b> <a class="pull-right">{{ $matricule }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Téléphone</b> <a class="pull-right">{{ $telephone }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Adresse</b> <a class="pull-right">{{ $adresse }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->


        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <div class="tab-pane" id="">
                    <br>
                    <div id="msg200"></div>
                    <form class="form-horizontal">

                        <b>
                            <h3 class="ml-2" style="margin-left:40px;"><b>Mettez à jour votre mot de passe</b></h3>
                        </b>
                            <br>
                        

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Ancien mot de passe</label>
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password"
                                            style="border-radius: 10px;">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="">
                                        <label for="">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="new_password"
                                            name="new_password"
                                            style="border-radius: 10px;">

                                            <div id="password-info" class="invalid-text"></div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class=" mx-auto">
                                        <!-- Ajout de la classe mx-auto -->
                                        <label for="">Confirmer mot de passe</label>
                                        <input type="password" class="form-control" id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            style="border-radius: 10px;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-offset-2">
                                        <button type="submit" class="btn btn-success"
                                            id="sauvegarder" disabled>Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>

                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-1"></div>
    </div>

</section>



<style>
    input {
        width: 200px;
        padding: 5px;
    }
    .valid {
        border: 2px solid green;
    }
    .invalid {
        border: 2px solid red;
    }
    .valid-text {
        color: green;
    }
    .invalid-text {
        color: red;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const passwordInput = document.getElementById('new_password');
    const passwordInfo = document.getElementById('password-info');
    const submitBtn = document.getElementById('sauvegarder');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;
        const isValid = validatePassword(password);

        if (isValid) {
            passwordInput.classList.remove('invalid');
            passwordInput.classList.add('valid');
            passwordInfo.classList.remove('invalid-text');
            passwordInfo.classList.add('valid-text');
            passwordInfo.textContent = 'Mot de passe valide.';
            submitBtn.disabled = false;

            // Ajouter une temporisation pour cacher le message de succès
        setTimeout(function () {
            passwordInfo.textContent = ''; // Effacer le contenu du message
        }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    
    
    
    } else {
            passwordInput.classList.remove('valid');
            passwordInput.classList.add('invalid');
            passwordInfo.classList.remove('valid-text');
            passwordInfo.classList.add('invalid-text');
            passwordInfo.textContent = 'Le mot de passe doit contenir au moins 8 caractères, dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.';
            submitBtn.disabled = true;
        }
    });

    function validatePassword(password) {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return regex.test(password);
    }
</script>
<script>
    $(document).ready(function () {
        // Lorsque le bouton "Envoyer" est cliqué
        $("#sauvegarder").click(function (e) {
            e.preventDefault();
           
            var current_password = $("#current_password").val();
            var new_password = $("#new_password").val();
            var new_password_confirmation = $("#new_password_confirmation").val();
            var pass= 8;

            // Récupérer le jeton CSRF depuis la balise meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //alert(tableauDonnees)
            // Créez un objet JSON contenant toutes les données
            var donneesAEnvoyer = {
                _token: csrfToken,current_password,new_password,new_password_confirmation
            };
            if(new_password=="" || new_password_confirmation=="" || current_password ==""){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                <b>Veuillez remplir les champs vide</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>`);
                            setTimeout(function () {
                    msg200.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    

            }else if(new_password != new_password_confirmation){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                <b>Les mots de passe ne correspondent pas</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>`);
                            $('#new_password_confirmation').css("border","2px solid red");
                setTimeout(function () {
                    msg200.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    

            }else if((new_password.length) < pass){
                $('#msg200').html(` <div class='alert alert-warning text-center' role='alert'>
                <b>Votre mot de passe doit être supérieur ou égal à huit caractères </b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>`);
                            setTimeout(function () {
                    msg200.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    
            }else{
                $('#new_password_confirmation').css("border","2px solid green");

            // Envoyez les données au contrôleur via une requête AJAX
            $.ajax({
                type: "GET",
                url: "{{ route('profil_update')}}",
                data: donneesAEnvoyer,
                success: function (response) {

                    if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
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

@endsection
