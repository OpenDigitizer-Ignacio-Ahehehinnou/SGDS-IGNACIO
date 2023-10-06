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

                                            <div id="password-info" class="invalid-text"></div>

                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{$user}}">
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
                                            id="sauvegarder2" disabled>Sauvegarder</button>
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
        
            var id= $("#id").val();
          // var id= 65,
            var new_password = $("#new_password").val();
            var new_password_confirmation = $("#new_password_confirmation").val();
            var pass= 8;
           // alert(id)

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
                $('#new_password_confirmation').css("border","2px solid red");
                setTimeout(function () {
                    msg200.textContent = ''; // Effacer le contenu du message
                }, 3000); // Attendre 3 secondes (3000 millisecondes) avant de cacher le message
    

            }else if(new_password=="" || new_password_confirmation==""){

                $('#msg200').html(` <div class='alert alert-danger text-center' role='alert'>
                                <b>Veuillez remplir les champs vide</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                                </div>`);

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
                        
                        var url="{{route('admin')}}" 
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


 