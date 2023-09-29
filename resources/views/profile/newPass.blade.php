<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Login-SGDS</title>
</head>

<body>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">

    <form class="form-horizontal">
      
        <div id="msg200"></div>

        <div class="box">
            <h1 class="alert alert-success">SGDS </h1>

            @if(Session::get('error_msg'))

            <b style="font-size: 13px;color:red;">{{Session::get('error_msg')}}</b>

            @endif

            <div class="d-flex justify-content-center">
                
                <div class="mb-3">
                    <input type="password" name="username" id="new_password" class="email form-control" placeholder="Nouveau mot de passe"
                        style="border-radius: 10px;" />

                        <div id="password-info" class="invalid-text mt-3" style="font-size: 10px;"></div>

                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="mb-3">
                    <input type="password" name="password" id="new_password_confirmation"  class="email form-control" placeholder="Confirmer mot de passe"
                        style="border-radius: 10px;" />
                </div>
            </div>
            <input type="hidden" id="username" value="{{$username}}"/>
            
            <div class="">
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="border-radius: 10px;">Annuler</a>
                <button type="submit" class="btn btn-success btn-sm" id="sauvegarder2" style="border-radius: 10px;" disabled>Valider</button>

            </div>
            </div>

            <!-- End Btn -->
            <!-- End Btn2 -->
        </div>
        <!-- End Box -->
    </form>


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
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    const passwordInput = document.getElementById('new_password');
    const passwordInfo = document.getElementById('password-info');
    const submitBtn = document.getElementById('sauvegarder2');

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
        $("#sauvegarder2").click(function (e) {
            e.preventDefault();
        
            var username= $("#username").val();
            var new_password = $("#new_password").val();
            var new_password_confirmation = $("#new_password_confirmation").val();
            var pass= 8;


            // Récupérer le jeton CSRF depuis la balise meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //alert(tableauDonnees)
            // Créez un objet JSON contenant toutes les données
            var donneesAEnvoyer = {
                _token: csrfToken,new_password,new_password_confirmation,username
            };

            if(new_password != new_password_confirmation){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                                <b>Les mots de passe ne correspondent pas</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </p>`);
                $('#new_password_confirmation').css("border","2px solid red");
                setTimeout(function () {
                    passwordInfo.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    

            }else if(new_password=="" || new_password_confirmation==""){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                                <b>Veuillez remplir les champs vide</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                                </div>`);

                                setTimeout(function () {
                    passwordInfo.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    
                            
            }else if((new_password.length) < pass){
                $('#msg200').html(` <div class='alert alert-warning text-center' role='alert'>
                <b>Votre mot de passe doit être supérieur ou égal à huit caractères </b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>`);

                            setTimeout(function () {
                    passwordInfo.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    

            }
            else{
                $('#new_password_confirmation').css("border","2px solid green");

                // Envoyez les données au contrôleur via une requête AJAX
                $.ajax({
                    type: "GET",
                    url: "{{ route('newPass2')}}",
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
                        
                        var url="{{route('login')}}" 
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

</body>

</html>