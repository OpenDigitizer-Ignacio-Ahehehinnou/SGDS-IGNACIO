@extends("layouts.master")

@section("contenu")


<div class="mt-2">

    @if(session()->has("success"))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
            <h5>{{session()->get('success')}}</h5>

        </div>
    @endif


    @if($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach($errors->all() as $error)
            <h5>{{$error}}</h5>

            @endforeach
        </ul>
    </div>
    @endif
    <br><br>
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-heading">Ajouter un collecteur</div>


                <div class="panel-body">

                    <div id="msg200"></div>
                    <form method="post" action="{{ route('collecteur.ajouter')}}">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Nom</label>
                                <input type="text" class="form-control" required="true" id="nom" name="firstName" value="{{old('firstName')}}"
                                    style="border-radius: 10px;" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                                <input type="text" class="form-control" required="true" id="prenom" name="lastName" value="{{old('lastName')}}"
                                    style="border-radius: 10px;" required>
                            </div>

                        </div>

                        <div class="row">
                            

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" required="true" id="telephone" name="telephone" value="{{old('telephone')}}"
                                    style="border-radius: 10px;" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Adresse</label>
                              <input type="text" class="form-control" required="true" id="adresse" name="adress" value="{{old('adress')}}"
                                    style="border-radius: 10px;" required>
                            </div>

                        </div>


                        <div class="row">
                                {{--  --}}
                                <div class="mb-3 col-md-4">
                                    <label for="matricule" class="form-label">Matricule</label>
                                    <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule') }}"
                                        style="border-radius: 10px;" required>
                                </div>
                                <div class="form-check col-md-2">
                                    <label class="form-check-label" for="exampleCheckbox">Générer</label>

                                    <input type="checkbox" class="form-check-input" name="exampleCheckbox" id="exampleCheckbox">
                                </div>


                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" required="true" id="email" name="email" value="{{old('email')}}"
                                    style="border-radius: 10px;" required>
                            </div>
                        </div>


                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Nom utilisateur</label>
                                <input type="text" class="form-control" required="true" id="username" name="username"value="{{old('username')}}"
                                    style="border-radius: 10px;" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                                <select class="form-control" id="entrepriseId" required="true" name="entrepriseId"
                                    style="border-radius: 10px;">
                                    @foreach ($entreprises as $entrepris)
                                        @if($entrepris['entrepriseId'] == $entreprise && $role == 8) 
                                            <option value="{{$entrepris['entrepriseId']}}" selected>{{$entrepris['name']}}</option>
                                        
                                        @endif 

                                        @if($entrepris['entrepriseId'] == $entreprise && $role == 7) 
                                            <option value="{{$entrepris['entrepriseId']}}" selected>{{$entrepris['name']}}</option>
                                        
                                        @endif 


                                        @if( $role == 12) 
                                        <option value="{{$entrepris['entrepriseId']}}" selected>{{$entrepris['name']}}</option>
                                    
                                    @endif 
                                    @endforeach

                                  
                                </select>

                            </div>
                            <input type="hidden" class="form-control" required="true" id="roleId" name="roleId" value="14">


                        </div>


                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                                <input type="text" class="form-control" required="true" id="password" name="password" value="{{old('password')}}"
                                    style="border-radius: 10px;" required>

                                    <div id="password-info" class="invalid-text"></div>

                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Confimer mot de passe</label>
                                <input type="text" class="form-control" required="true" id="password_confirm" name="password_confirm" value="{{old('password_confirm')}}"
                                    style="border-radius: 10px;" required>

                                    <div id="password-info2" class="invalid-text"></div>

                            </div>


                        </div>

                        

                        <div class="row" hidden>


                            <div class="mb-3 col-md-6">
                                <label for="activationStatus" class="form-label">ActivationStatus</label>
                                <input type="text" class="form-control" id="activationStatus" name="activationStatus"
                                    value="aaa" style="border-radius: 10px;">
                            </div>

                        </div>

                        <div class="row" hidden>

                            <div class="mb-3 col-md-6">
                                <label for="exampleInputPassword1" class="form-label">creatorUsername</label>

                                <input type="text" class="form-control" id="creatorUsername" value="Ignacio"
                                    name="creatorUsername">

                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="activationStatus" class="form-label">createdAt</label>
                                <input type="text" class="form-control" id="creatorId"
                                    value="2023-08-02T11:37:47.544+00:00" name="createdAt">
                            </div>


                        </div>

                        <div class="row" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="activationStatus" class="form-label">Creator Id</label>
                                <input type="text" class="form-control" id="creatorId" value="1" name="creatorId">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>
                                <input type="text" class="form-control" value="S" id="deletedFlag" name="deletedFlag">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="activationStatus" class="form-label">photo</label>
                                <input type="text" class="form-control" id="photoProfil"
                                    value="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6 "
                                    name="photoProfil">
                            </div>


                        </div>

                        <br>
                        <div class="d-flex justify-content-end">
                            <a href="{{route('admin')}}" class="btn btn-danger">Annuler</a>
                            <button type="submit" class="btn btn-primary" id="envoyerDonnees" disabled>Enregistrer</button>
                        </div>

                </div>

                </form>

            </div>
        </div>
        <div class="col-md-2"></div>

    </div>
</div>


</div>
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


<script src="https://code.jquery.com/jquery-3.6.4.js"></script>

<script>
    // Obtenir la date actuelle
    var today = new Date();

  // Convertir la date en format lisible par l'homme
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var dateStr = today.toLocaleDateString('fr-FR', options);

  // Afficher la date sur la page
    document.getElementById("date").textContent = dateStr;

</script>


<script>
    const passwordInput = document.getElementById('password');
    const passwordInfo = document.getElementById('password-info');
    const submitBtn = document.getElementById('envoyerDonnees');

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

    //Controle pour refuser la saisie des chiffres dans intitulé nom et prenom
    $('#nom').on('input', function(e) {
        var inputVal = $(this).val();
        var onlyLetters = inputVal.replace(/[0-9]/g, '');
        $(this).val(onlyLetters);
    });

    $('#prenom').on('input', function(e) {
        var inputVal = $(this).val();
        var onlyLetters = inputVal.replace(/[0-9]/g, '');
        $(this).val(onlyLetters);
    });
    $('#telephone').on('input', function(e) {
        var inputVal = $(this).val();
        var onlyNumbers = inputVal.replace(/[^0-9]/g, ''); // Utilisez cette expression régulière pour ne garder que les chiffres
        $(this).val(onlyNumbers);
    });

</script>
<script>
    // Récupérez la référence de la case à cocher et du champ de texte
    var checkBox = document.getElementById("exampleCheckbox");
    var matriculeInput = document.getElementById("matricule");

    // Écoutez les changements d'état de la case à cocher
    checkBox.addEventListener("change", function () {
        if (checkBox.checked) {
            // Si la case à cocher est cochée, désactivez le champ de texte
            matriculeInput.disabled = true;
            // Effacez la valeur du champ de texte
            matriculeInput.value = "";

        } else {
            // Si la case à cocher n'est pas cochée, activez le champ de texte
            matriculeInput.disabled = false;
        }
    });

</script>
@endsection
