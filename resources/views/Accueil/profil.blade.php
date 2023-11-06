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
                    <div class="box-body box-profile" style="display: flex; justify-content: center;">
                        <label for="fileUpload" style="cursor: pointer;">
                            <img id="profilePicture" class="profile-user-img img-responsive img-circle"
                                title="Cliquer pour changer votre profil"
                                src="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6"
                                alt="User profile picture" style="width: 150px; height: 150px;">
                        </label>
                        <input type="file" id="fileUpload" accept=".jpg, .jpeg, .png" style="display: none;">
                    </div>
                      
                    <h3 class="profile-username text-center">{{ $nom }} {{ $prenom }}</h3>

                    <p class="text-muted text-center">{{ $roleLabel }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Entreprise </b> <a class="pull-right">{{ $entreprisee }}</a>
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

                    <div class="form-group">
                        <div class="col-offset-2">
                            <button type="submit" class="btn btn-warning">Modifier</button>
                        </div>
                    </div>
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
                            <br><br><br>
                        

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


    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Modifier les informations</h3>
            <hr>
            <form method="post" action="{{ route('admin.updateProfil', ['administrateur' => 'userId']) }}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <input type="hidden" class="form-control" id="userId"
                name="userId" value="{{ $userId }}">
                               <div class="row">
                    <div class="col-md-12">
                        <label>Nom </label>
                        <input type="text" id="nom" name="firstName" class="form-control" value="{{ $nom }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-12">
                        <label>Prénoms </label>
                        <input type="text" id="prenom" name="lestName" class="form-control" value="{{ $prenom }}" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="text" class="form-control" required="true" id="email" name="email"
                            value="{{ $email }}" style="border-radius: 10px;">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-md-4">
                        <label>Rôle </label>
                        <input type="text" id="nom" name="roleId" class="form-control" value="{{ $role }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-4">
                        <label>Entreprise </label>
                        <input type="text" id="prenom" name="entrepriseId" class="form-control" value="{{ $entreprise }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-4">
                        <label>Adresse </label>
                        <input type="text" id="prenom" name="adresse" class="form-control" value="{{ $adresse }}" style="border-radius: 10px;">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-md-6">
                        <label>Matricule </label>
                        <input type="text" name="matricule" class="form-control" value="{{ $matricule }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-6">
                        <label>username </label>
                        <input type="text" name="username" class="form-control" value="{{ $username }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-6">
                        <label>Téléphone </label>
                        <input type="text" name="telephone" class="form-control" value="{{ $telephone }}" style="border-radius: 10px;">
                    </div>
                </div>



                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="updatedBy" class="form-label">updatedBy</label>
                        <input type="text" class="form-control" id="updatedBy" name="updatedBy"
                            value="aaa" style="border-radius: 10px;">
                    </div>


                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">updatedAt</label>

                        <input type="text" class="form-control" id="updatedAt" value="2023-11-03T12:38:48.846Z"
                            name="updatedAt">

                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId"
                            value="2023-08-02T11:37:47.544+00:00" name="createdAt">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="deletedAt" class="form-label">deletedAt</label>
                        <input type="text" class="form-control" id="deletedAt"
                            value="2023-11-03T12:38:48.846Z" name="deletedAt">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="createdBy" class="form-label">createdBy</label>
                        <input type="text" class="form-control" id="createdBy"
                            value="abc" name="createdBy">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="deletedBy" class="form-label">deletedBy</label>
                        <input type="text" class="form-control" id="deletedBy"
                            value="abc" name="deletedBy">
                    </div>




                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-4">
                        <label for="userIdForLog" class="form-label">userIdForLog</label>
                        <input type="text" class="form-control" id="userIdForLog" value="1" name="userIdForLog">
                    </div>


                    <div class="mb-3 col-md-4">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" value="s" id="deletedFlag" name="deletedFlag">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="activationStatus" class="form-label">photo</label>
                        <input type="text" class="form-control" id="photoProfil"
                            value="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6 "
                            name="photoProfil">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="activationStatus" class="form-label">verificationCodeExpiredAt</label>
                        <input type="text" class="form-control" id="verificationCodeExpiredAt"
                            value="2023-11-03T12:38:48.846Z"
                            name="verificationCodeExpiredAt">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="verificationCode" class="form-label">verificationCode</label>
                        <input type="text" class="form-control" id="verificationCode"
                            value="ssdfe"
                            name="verificationCode">
                    </div>

                    
                </div>
                <br>
                <div class="form-group">
                    <div class="col-offset-2">
                        <button type="submit" class="btn btn-warning">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
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

{{-- css de mon modal --}}
<style>
    /* Style du modal */
    .modal {
        display: none; /* Par défaut, cache le modal */
        position: fixed; /* Permet au modal de rester à la même position même si la page est défilée */
        z-index: 1; /* Place le modal en premier plan */
        left: 0;
        top: 10;
        width: 100%; /* Couvre toute la largeur de l'écran */
        height: 100%; /* Couvre toute la hauteur de l'écran */
        overflow: auto; /* Active le défilement si le contenu dépasse la taille de l'écran */
        background-color: rgba(0,0,0,0.4); /* Fond gris semi-transparent */
    }

    /* Contenu du modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* Centré verticalement et horizontalement */
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Largeur du modal */
    }

    /* Style pour le bouton de fermeture */
    .close {
        color: black;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style pour les champs de saisie dans le formulaire */
    input[type="text"] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
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


<script>
    // Lorsque le document est prêt
    $(document).ready(function() {
        // Lorsque l'utilisateur clique sur le bouton "Modifier"
        $(".btn-warning").click(function() {
            // Affiche le modal
            $("#myModal").show();
            // Remplit les champs du formulaire du modal avec les informations pertinentes
            $("#nom").val("{{ $nom }}");
            $("#prenom").val("{{ $prenom }}");
            // Remplissez d'autres champs en fonction de vos besoins
        });

        // Lorsque l'utilisateur clique sur la croix, cache le modal
        $(".close").click(function() {
            $("#myModal").hide();
        });

        // Lorsque l'utilisateur clique en dehors du modal, cache-le
        $(window).click(function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").hide();
            }
        });
    });
</script>

@endsection
