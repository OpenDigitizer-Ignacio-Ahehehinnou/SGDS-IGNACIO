
@extends("layouts.master")

@section("contenu")

<div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Edition d'un superviseur</h3>
    
        <div class="mt-2">

        @if(session()->has("success"))
        <div class="alert alert-success" >
            <h3>{{session()->get('success')}}</h3>
        </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger" >
            <ul >
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>

                @endforeach
            </ul>
            </div>
        @endif

        <form  method="post" action="{{ route('superviseur.update', ['superviseur'=>$superviseur['userId']] )}}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="firstName" value="{{$superviseur['firstName'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" id="prenom" name="lastName" value="{{$superviseur['lastName'] }}">
                    </div>

                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Matricule</label>
                        <input type="text" class="form-control" id="email" name="matricule" value="{{$superviseur['matricule'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone"  value="{{$superviseur['telephone'] }}">
                    </div>

                </div>
                
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adress" value="{{$superviseur['adress'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{$superviseur['username'] }}">
                    </div>

                    
                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{$superviseur['password'] }}" hidden="hidden">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">ActivationStatus</label>
                        <input type="text" class="form-control" id="activationStatus" name="activationStatus" value="{{$superviseur['activationStatus'] }}">
                    </div>

                    
                </div>

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                        <input type="text" class="form-control" id="entrepriseId" name="entrepriseId" value="{{$superviseur['entrepriseModel']['entrepriseId'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleModel" class="form-label">Role</label>
                        <input type="text" class="form-control" id="roleId" name="roleId" value="{{$superviseur['roleModel']['roleId'] }}">

                    </div>

                   

                    
                </div>

                <div class="row">

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$superviseur['creatorUsername']}}">
                    </div>

                    <div class="mb-3 col-md-6" hidden="hidden">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" name="createdAt" value="{{$superviseur['createdAt'] }}">
                    </div>

                    
                </div>
                
                <div class="row">

                <div class="mb-3 col-md-6"hidden="hidden" >
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" name="creatorId" value="{{$superviseur['creatorId'] }}" >
                    </div>
                    

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$superviseur['deletedFlag'] }}">
                    </div>

                </div>
            
                <br>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{route('superviseur')}}" class="btn btn-danger">Annuler</a>

            </form>     
        </div>
            
        
</div>

@endsection