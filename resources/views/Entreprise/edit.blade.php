
@extends("layouts.master")

@section("contenu")

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
            <div class="panel-heading">Edition d'une entreprise</div>


            <div class="panel-body">

    
        
            <form method="post" action="{{ route('entreprise.update', ['entreprise'=>$entreprise['entrepriseId']])}}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="nom" class="form-label"> Entreprise</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="name" name="name" value="{{$entreprise['name'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="adress" name="adress" value="{{$entreprise['adress'] }}">
                    </div>

                </div>
                

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Numéro IFU</label>
                        <input type="number" class="form-control" required="true" style="border-radius: 10px;" id="ifu" name="ifu" value="{{$entreprise['ifu'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="siege" class="form-label">Siège</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="siege" name="siege"  value="{{$entreprise['siege'] }}">
                    </div>
                </div>
                
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" required="true" style="border-radius: 10px;" id="email" name="email" value="{{$entreprise['email'] }}">
                    </div>

                    <div class="mb-2 col-md-6">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="number" class="form-control" required="true" style="border-radius: 10px;" id="telephone" name="telephone" value="{{$entreprise['telephone'] }}">
                    </div>
                </div>

                
                <div class="row" hidden="hidden">
                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">creatorId</label>
                        <input type="text" class="form-control" id="creatorId" name="creatorId" value="{{$entreprise['creatorId'] }}">
                    </div>
                    <div class="mb-2 col-md-4">
                        <label for="telephone" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$entreprise['creatorUsername'] }}">
                    </div>

                    <div class="mb-2 col-md-4">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$entreprise['deletedFlag'] }}">
                    </div>
                </div>
                
                <div class="row" hidden="hidden">

                    <div class="mb-2 col-md-6" >
                        <label for="nom_responsable" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="createdAt" name="createdAt" value="{{$entreprise['createdAt'] }}">
                    </div>

                    <div class="mb-2 col-md-6">
                        <label for="creatorUsername" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$entreprise['creatorUsername'] }}">
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
