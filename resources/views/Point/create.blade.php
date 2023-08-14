@extends("layouts.master")


@section("contenu")


<div class="panel panel-default">
    <div class="panel-heading">Ajouter un point</div>


    <div class="panel-body">


        <form method="post" action="{{ route('point.ajouter')}}">
            @csrf
            {{-- <input type="text" class="form-control" id="nom" name="userId" value="31" hidden="hidden"> --}}

           
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Altitude</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" style="border-radius: 10px;">
                </div>
    
                <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" style="border-radius: 10px;">
                </div>
            </div>
    
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="text" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="email" name="email" style="border-radius: 10px;">
                </div>
    
                <div class="mb-3 col-md-6">
                    <label for="city" class="form-label">Ordre</label>
                    <input type="text" class="form-control" id="city" name="city" style="border-radius: 10px;">
                </div>
            </div>
    
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="exampleInputPassword1" class="form-label">Zone</label>
                    <select class="form-control" id="exampleSelect" name="selectedOption" style="border-radius: 10px;">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                        <option value="option4">Option 4</option>
                    </select>
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
.
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{route('point')}}" class="btn btn-danger">Annuler</a>

            </div>
        </form>
    </div>
</div>

@endsection