@extends("layouts.master")

@section("contenu")

<div class="mt-2">

    @if(session()->has("success"))
    <div class="alert alert-success" role="alert">
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


            <form method="post" action="{{ route('collecteur.ajouter')}}">
                @csrf
                <input type="hidden" class="form-control" id="nom" name="userId" value="31" hidden>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" required="true" name="firstName" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" id="prenom" required="true" name="lastName" style="border-radius: 10px;">
                    </div>

                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Matricule</label>
                        <input type="text" class="form-control" required="true" id="email" name="matricule" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" required="true" id="telephone" name="telephone" style="border-radius: 10px;">
                    </div>

                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" required="true" id="adresse" name="adress" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Nom utilisateur</label>
                        <input type="text" class="form-control" required="true" id="username" name="username" style="border-radius: 10px;">
                    </div>


                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="text" class="form-control" required="true" id="password" name="password" style="border-radius: 10px;">
                    
                        <div id="password-info" class="invalid-text"></div>

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                        {{-- <input type="text" class="form-control" id="entrepriseId" name="entrepriseId" style="border-radius: 10px;"> --}}

                        <select class="form-control" id="entrepriseId" required="true" name="entrepriseId" style="border-radius: 10px;">

                            @if($role =="ADMIN")
                                @foreach ($entreprises as $entrepris )

                                @if($entrepris['name'] == $entreprise)

                                <option value="{{$entrepris['entrepriseId']}}">{{$entrepris['name']}}</option>
                                @endif
                                @endforeach
                            @endif

                            @if($role =="SUPERADMIN")
                                @foreach ($entreprises as $entrepris )

                                <option value="{{$entrepris['entrepriseId']}}">{{$entrepris['name']}}</option>

                                @endforeach
                            @endif
                        </select>

                    </div>


                </div>


                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">ActivationStatus</label>
                        <input type="text" class="form-control" id="activationStatus" name="activationStatus" value="aaa">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleModel" class="form-label">Role</label>
                        <input type="text" class="form-control" id="roleId" name="roleId" value="4">

                    </div>
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-4">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>

                        <input type="text" class="form-control" id="creatorUsername" value="Ignacio" name="creatorUsername">

                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" value="2023-08-02T11:37:47.544+00:00" name="createdAt">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="activationStatus" class="form-label">photo</label>
                        <input type="text" class="form-control" id="photo"
                        value="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6 "
                        name="photo">
                    </div>


                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" value="1" name="creatorId">
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" value="S" id="deletedFlag" name="deletedFlag">
                    </div>

                </div>

                <br>
                <div>

                    <button type="submit" class="btn btn-primary" id="envoyerDonnees" disabled>Enregistrer</button>

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
</script>

@endsection
