
@extends("layouts.master")

@section("contenu")


<div>

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
            <div class="panel-heading">Edition d'un collecteur</div>


            <div class="panel-body">

                <a href="{{ route('modifier_user', ['userId' => $collecteur['userId']]) }}" class="btn btn-warning">Modifier mot de passe</a>


                <form  method="post" action="{{ route('collecteur.update', ['collecteur'=>$collecteur['userId']] )}}">
                    @csrf
                    <input type="hidden" name="_method" value="put">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Nom</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="nom" name="firstName" value="{{$collecteur['firstName'] }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="prenom" name="lastName" value="{{$collecteur['lastName'] }}">
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Matricule</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="email" name="matricule" value="{{$collecteur['matricule'] }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="telephone" name="telephone"  value="{{$collecteur['telephone'] }}">
                        </div>

                    </div>
                    
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Adresse</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="adresse" name="adress" value="{{$collecteur['adress'] }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Nom utilisateur</label>
                            <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="username" name="username" value="{{$collecteur['username'] }}">
                        </div>

                        
                    </div>

                    <div class="row" hidden>

                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{$collecteur['password'] }}" hidden="hidden">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="activationStatus" class="form-label">ActivationStatus</label>
                            <input type="text" class="form-control" id="activationStatus" name="activationStatus" value="{{$collecteur['activationStatus'] }}">
                        </div>

                        
                    </div>

                    <div class="row" hidden>

                        <div class="mb-3 col-md-6">
                            <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                            <input type="text" class="form-control" id="entrepriseId" name="entrepriseId" value="{{$collecteur['entrepriseModel']['entrepriseId'] }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="roleModel" class="form-label">Role</label>
                            <input type="text" class="form-control" id="roleId" name="roleId" value="{{$collecteur['roleModel']['roleId'] }}">

                        </div>

                    

                        
                    </div>

                    <div class="row" hidden>

                        <div class="mb-3 col-md-6"hidden="hidden">
                            <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                            <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$collecteur['creatorUsername']}}">
                        </div>

                        <div class="mb-3 col-md-6" hidden="hidden">
                            <label for="activationStatus" class="form-label">createdAt</label>
                            <input type="text" class="form-control" id="creatorId" name="createdAt" value="{{$collecteur['createdAt'] }}">
                        </div>

                        
                    </div>
                    
                    <div class="row" hidden>

                    <div class="mb-3 col-md-6"hidden="hidden" >
                            <label for="activationStatus" class="form-label">Creator Id</label>
                            <input type="text" class="form-control" id="creatorId" name="creatorId" value="{{$collecteur['creatorId'] }}" >
                        </div>
                        

                        <div class="mb-3 col-md-6"hidden="hidden">
                            <label for="deletedFlag" class="form-label">deletedFlag</label>
                            <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$collecteur['deletedFlag'] }}">
                        </div>

                    </div>
                
                    <br>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>

                </form>        
            </div>

        </div>
        <div class="col-md-2"></div>
            </div></div>
    </div>
            
        
</div>

@endsection
