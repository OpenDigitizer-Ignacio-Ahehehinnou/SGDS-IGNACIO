

@extends("layouts.master")

@section("contenu")


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

        <br><br>

    
        <div class="panel panel-default">
            <div class="panel-heading">Ajouter une entreprise</div>
        
            
                <div class="panel-body">

                    <form method="post" action="{{ route('entreprise.ajouter')}}">
                        @csrf
                    
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="nom" class="form-label">Raison sociale</label>
                                <input type="text" class="form-control" id="nom" name="nom" aria-describedby="nom">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse">
                            </div>

                        </div>

                        <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="ifu" class="form-label">Numéro IFU</label>
                                    <input type="number" class="form-control" id="ifu" name="ifu">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="siege" class="form-label">Siège</label>
                                    <input type="text" class="form-control" id="siege" name="siege">
                                </div>

                        </div>
                        

                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="number" class="form-control" id="telephone" name="telephone">
                            </div>


                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="nom_responsable" class="form-label">Nom et prénom du responsable</label>
                                <input type="text" class="form-control" id="nom_responsable" name="nom_responsable">
                            </div>

                        </div>

                        
                        
                            <br>
                    
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <a href="{{route('entreprise')}}" class="btn btn-danger">Annuler</a>

                    </form>
                            
                </div>
            </div>
        </div>
            
        
    </div>

@endsection
