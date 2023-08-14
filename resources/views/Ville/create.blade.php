@extends("layouts.master")


@section("contenu")


<div class="panel panel-default">
    <div class="panel-heading">Ajouter une ville</div>


    <div class="panel-body">


        <form method="post" action="{{ route('ville.ajouter')}}">
            @csrf
            {{-- <input type="text" class="form-control" id="nom" name="userId" value="31" hidden="hidden"> --}}

           
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1" class="form-label">Code</label>
                        <input type="text" class="form-control" id="nom" name="firstName" style="border-radius: 10px;">
                    </div>
                
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Libellé</label>
                        <input type="text" class="form-control" id="prenom" name="lastName" style="border-radius: 10px;">
                    </div>
                </div>
            
            {{-- <div class="row">

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

            </div> --}}

            <br>
            <div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{route('ville')}}" class="btn btn-danger">Annuler</a>

            </div>
        </form>
    </div>
</div>

@endsection