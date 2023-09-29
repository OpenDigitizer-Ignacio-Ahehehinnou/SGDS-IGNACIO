

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
            <div class="panel-heading">Ajouter une entreprise</div>
        
            
                <div class="panel-body">

                    <form method="post" action="{{ route('entreprise.ajouter')}}">
                        @csrf
                    
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="nom" class="form-label">Raison sociale</label>
                                <input type="text" required="true" style="border-radius: 10px;" class="form-control" id="nom" name="name" aria-describedby="nom" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" required="true" style="border-radius: 10px;" class="form-control" id="adresse" name="adress" value="{{old('adress')}}" required>
                            </div>

                        </div>

                        <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="ifu" class="form-label">Numéro IFU</label>
                                    <input type="number" required="true" style="border-radius: 10px;" class="form-control" id="ifu" name="ifu" value="{{old('ifu')}}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="siege" class="form-label">Siège</label>
                                    <input type="text" required="true" style="border-radius: 10px;" class="form-control" id="siege" name="siege" value="{{old('siege')}}">
                                </div>

                        </div>
                        

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" required="true" style="border-radius: 10px;" class="form-control" id="email" name="email" value="{{old('email')}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="number" required="true" style="border-radius: 10px;" class="form-control" id="telephone" name="telephone" value="{{old('telephone')}}">
                            </div>


                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nom_responsable" class="form-label">Nom et prénom du responsable</label>
                                <input type="text" required="true" style="border-radius: 10px;" class="form-control" id="nom_responsable" name="nom_responsable" value="{{old('nom_responsable')}}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="nom_responsable" class="form-label">Zone</label>

                                <select class="form-control" required="true" id="zone" name="zone" style="border-radius: 10px;">

                                    @foreach ($zones as $zone )
            
                                    <option value="{{$zone['zoneId']}}">{{$zone['nom']}}</option>
            
                                    @endforeach
            
                                </select>


                            </div>

                        </div>

                         <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
            
                        <input type="text" class="form-control" id="creatorUsername" value="Ignacio" name="creatorUsername">

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" value="2023-08-02T11:37:47.544+00:00" name="createdAt">
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
                    
                        <button type="submit" class="btn btn-primary">Enregistrer</button>

                    </form>
                            
                </div>
                <div class="col-md-2"></div>
        </div></div>
            </div>
        </div>
            
        
    </div>

@endsection
