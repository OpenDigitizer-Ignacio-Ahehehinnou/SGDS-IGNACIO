
@extends("layouts.master")

@section("contenu")

{{-- <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Edition d'un superviseur</h3> --}}
    
        <div class="mt-2">

        @if(session()->has("success"))
        <div class="alert alert-success" >
            <h5>{{session()->get('success')}}</h3>
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
        <div class="row">

            <div class="col-md-2"></div>
            <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Edition d'un superviseur</div>


            <div class="panel-body">

        <a href="{{ route('modifier_user', ['userId' => $superviseur['userId']]) }}" class="btn btn-warning">Modifier mot de passe</a>
        <br><br>

            <form  method="post" action="{{ route('superviseur.update', ['superviseur'=>$superviseur['userId']] )}}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" required="true" style="border-radius: 10px;" name="firstName" value="{{$superviseur['firstName'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" required="true" id="prenom" style="border-radius: 10px;" name="lastName" value="{{$superviseur['lastName'] }}">
                    </div>

                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Matricule</label>
                        <input type="text" class="form-control" required="true" id="email" style="border-radius: 10px;" name="matricule" value="{{$superviseur['matricule'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" required="true" id="telephone" style="border-radius: 10px;" name="telephone"  value="{{$superviseur['telephone'] }}">
                    </div>

                </div>
                
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" required="true" id="adresse" style="border-radius: 10px;" name="adress" value="{{$superviseur['adress'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Nom utilisateur</label>
                        <input type="text" class="form-control" required="true" id="username" style="border-radius: 10px;" name="username" value="{{$superviseur['username'] }}">
                    </div>

                    
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{$superviseur['password'] }}" hidden="hidden">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">ActivationStatus</label>
                        <input type="text" class="form-control" id="activationStatus" name="activationStatus" value="{{$superviseur['activationStatus'] }}">
                    </div>

                    
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                        <input type="text" class="form-control" id="entrepriseId" name="entrepriseId" value="{{$superviseur['entrepriseModel']['entrepriseId'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleModel" class="form-label">Role</label>
                        <input type="text" class="form-control" id="roleId" name="roleId" value="{{$superviseur['roleModel']['roleId'] }}">

                    </div>

                   

                    
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$superviseur['creatorUsername']}}">
                    </div>

                    <div class="mb-3 col-md-6" hidden="hidden">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" name="createdAt" value="{{$superviseur['createdAt'] }}">
                    </div>

                    
                </div>
                
                <div class="row" hidden>

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

            </form>     
        </div></div></div>
    <div class="col-md-2"></div>
    </div></div>
            
        
{{-- </div> --}}

@endsection
