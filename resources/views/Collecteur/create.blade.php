@extends("layouts.master")

@section("contenu")

<div class="mt-2">

    @if(session()->has("success"))
    <div class="alert alert-success">
        <h3>{{session()->get('success')}}</h3>
    </div>
    @endif


    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>

            @endforeach
        </ul>
    </div>
    @endif

    <br><br>

    <div class="panel panel-default">
        <div class="panel-heading">Ajouter un collecteur</div>


        <div class="panel-body">


            <form method="post" action="{{ route('collecteur.ajouter')}}">
                @csrf
                <input type="text" class="form-control" id="nom" name="userId" value="31" hidden="hidden">

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="firstName">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" id="prenom" name="lastName">
                    </div>

                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Matricule</label>
                        <input type="text" class="form-control" id="email" name="matricule">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>

                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adress">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>


                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">ActivationStatus</label>
                        <input type="text" class="form-control" id="activationStatus" name="activationStatus">
                    </div>


                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                        <input type="text" class="form-control" id="entrepriseId" name="entrepriseId">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleModel" class="form-label">Role</label>
                        <input type="text" class="form-control" id="roleId" name="roleId">

                    </div>




                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" name="createdAt">
                    </div>

                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" name="creatorId">
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag">
                    </div>

                </div>

                <br>
                <div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <a href="{{route('admin')}}" class="btn btn-danger">Annuler</a>

                </div>
            </form>
        </div>
    </div>
</div>

</div>

@endsection