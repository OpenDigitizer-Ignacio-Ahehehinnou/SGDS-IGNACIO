
@extends("layouts.master")

@section("contenu")

{{-- <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Edition d'un administrateurs</h3> --}}
    
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
                <div class="panel-heading">Edition d'un administrateur</div>
    
    
                <div class="panel-body">

            <a href="{{ route('modifier_user', ['userId' => $administrateur['userId']]) }}" class="btn btn-warning">Modifier mot de passe</a>
                <br><br>

            <form  method="post" action="{{ route('admin.update', ['administrateur'=>$administrateur['userId']] )}}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" required="true" id="nom" name="firstName" value="{{$administrateur['firstName'] }}" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Prénoms</label>
                        <input type="text" class="form-control" required="true" id="prenom" name="lastName" value="{{$administrateur['lastName'] }}" style="border-radius: 10px;">
                    </div>

                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-6" hidden>
                        <label for="exampleInputPassword1" class="form-label">Matricule</label>
                        <input type="text" class="form-control" required="true" id="email" name="matricule" value="{{$administrateur['matricule'] }}" style="border-radius: 10px;">
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" required="true" id="adresse" name="adress" value="{{$administrateur['adress'] }}" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="telephone" required="true" name="telephone"  value="{{$administrateur['telephone'] }}" style="border-radius: 10px;">
                    </div>

                </div>
                
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Nom utilisateur</label>
                        <input type="text" class="form-control" required="true" id="username" name="username" value="{{$administrateur['username'] }}" style="border-radius: 10px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                       
                        {{-- <input type="text" class="form-control" required="true" id="entrepriseId" name="entrepriseId" value="{{$administrateur['username'] }}" style="border-radius: 10px;"> --}}

                        <select class="form-control" id="entrepriseId" required="true" name="entrepriseId"
                            style="border-radius: 10px;" disabled>
                           
                            <option value="{{$administrateur['entrepriseModel']['entrepriseId']}}">{{$administrateur['entrepriseModel']['name']}}</option>
                            
                            
                        </select>

                    </div>
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{$administrateur['password'] }}" hidden="hidden">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">ActivationStatus</label>
                        <input type="text" class="form-control" id="activationStatus" name="activationStatus" value="{{$administrateur['activationStatus'] }}">
                    </div>

                    
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Entreprise</label>
                        <input type="text" class="form-control" id="entrepriseId" name="entrepriseId" value="{{$administrateur['entrepriseModel']['entrepriseId'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="roleModel" class="form-label">Role</label>
                        <input type="text" class="form-control" id="roleId" name="roleId" value="{{$administrateur['roleModel']['roleId'] }}">

                    </div>

                   

                    
                </div>

                <div class="row" hidden>

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$administrateur['creatorUsername']}}">
                    </div>

                    <div class="mb-3 col-md-6" hidden="hidden">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" name="createdAt" value="{{$administrateur['createdAt'] }}">
                    </div>

                    
                </div>
                
                <div class="row" hidden>

                    <div class="mb-3 col-md-6"hidden="hidden" >
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" name="creatorId" value="{{$administrateur['creatorId'] }}" >
                    </div>
                    

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$administrateur['deletedFlag'] }}">
                    </div>

                </div>
            
                <br>
                <div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>

                </div>

               

            </form>  

                </div></div>
                <div class="col-md-2"></div>
                </div></div>
                    
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
        var onlyNumbers = inputVal.replace(/[^0-9]/g, ''); // Utilisez cette expression régulière pour ne garder que les chiffres
        $(this).val(onlyNumbers);
    });

</script>

@endsection
