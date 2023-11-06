@extends('layouts.master')

@section('contenu')

    {{-- <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Edition d'un superAdmins</h3> --}}

    <div class="mt-2">

        @if (session()->has('success'))
            <div class="alert alert-success">
                <h5>{{ session()->get('success') }}</h3>
            </div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <h5>{{ $error }}</h5>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Edition d'un super admin</div>


                    <div class="panel-body">

                    
                        <br><br>

                        <form method="post"
                            action="{{ route('superAdmin.update', ['superAdmin' => $superAdmin['userId']]) }}">
                            @csrf
                            <input type="hidden" name="_method" value="put">

                            <input type="hidden" class="form-control" id="userId"
                            name="userId" value="{{ $superAdmin['userId'] }}">
                           
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                                    <input type="text" class="form-control" required="true" id="nom"
                                        name="firstName" value="{{ $superAdmin['firstName'] }}"
                                        style="border-radius: 10px;">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                                    <input type="text" class="form-control" required="true" id="prenom"
                                        name="lastName" value="{{ $superAdmin['lastName'] }}"
                                        style="border-radius: 10px;">
                                </div>

                            </div>

                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" required="true" id="adresse" name="adress"
                                        value="{{ $superAdmin['adress'] }}" style="border-radius: 10px;">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" required="true"
                                        name="telephone" value="{{ $superAdmin['telephone'] }}"
                                        style="border-radius: 10px;">
                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Matricule</label>
                                    <input type="text" class="form-control" required="true" id="matricule"
                                        name="matricule" value="{{ $superAdmin['matricule'] }}"
                                        style="border-radius: 10px;" readonly>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="exampleInputPassword1" class="form-label">Email</label>
                                    <input type="text" class="form-control" required="true" id="email" name="email"
                                        value="{{ $superAdmin['email'] }}" style="border-radius: 10px;">
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-5">
                                    <label for="username" class="form-label">Nom utilisateur</label>
                                    <input type="text" class="form-control" required="true" id="username"
                                        name="username" value="{{ $superAdmin['username'] }}"
                                        style="border-radius: 10px;" readonly>
                                </div>

                                <div class="col-md-1" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-warning" id="editUsernameButton">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                                
                                {{-- <div class="mb-3 col-md-6" >
                                    <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                                    <input type="text" class="form-control" id="entrepriseId" name="entrepriseId"
                                    value="{{ $targetEntreprise['entrepriseId']}}" style="border-radius: 10px;">

                                </div> --}}
                            </div>


                            <div class="row" hidden>

                                <div class="mb-3 col-md-6">
                                    <label for="test" class="form-label">Entreprise</label>
                                    <input type="text" class="form-control" id="entrepriseId" name="entrepriseId"
                                        value="{{ $targetEntreprise['entrepriseId']}}" style="border-radius: 10px;">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="updatedBy" class="form-label">updatedBy</label>
                                    <input type="text" class="form-control" id="updatedBy" name="updatedBy"
                                        value="aaa" style="border-radius: 10px;">
                                </div>
    
                                 <div class="mb-3 col-md-6">
                                    <label for="roleModel" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="roleId" name="roleId" value="12">
    
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
                            <div>

                                <button type="submit" class="btn btn-primary">Enregistrer</button>

                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        {{-- </div> --}}


    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>

    <script>
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
            var onlyNumbers = inputVal.replace(/[^0-9]/g,
                ''); // Utilisez cette expression régulière pour ne garder que les chiffres
            $(this).val(onlyNumbers);
        });

        //Activer le champ username pour mmodifier
        // Récupérez la référence de l'icône de modification et du champ de texte
        var editButton = document.getElementById("editUsernameButton");
        var usernameInput = document.getElementById("username");

        // Écoutez les clics sur le bouton d'édition
        editButton.addEventListener("click", function() {
            // Supprimez l'attribut "readonly" du champ de texte
            usernameInput.removeAttribute("readonly");
        });
    </script>

@endsection
