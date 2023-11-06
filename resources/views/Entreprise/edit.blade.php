
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
                <input type="hidden" name="entrepriseId" id="entrepriseId" value="{{$entreprise['entrepriseId'] }}">

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="nom" class="form-label"> Entreprise</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="name" name="name" value="{{$entreprise['name'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="address" name="address" value="{{$entreprise['address'] }}">
                    </div>

                </div>
                

                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Numéro IFU</label>
                        <input type="number" class="form-control" required="true" style="border-radius: 10px;" id="ifu" name="ifu" value="{{$entreprise['ifu'] }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="siege" class="form-label">Responsable</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="manager" name="manager"  value="{{$entreprise['manager'] }}">
                    </div>
                </div>
                
                <div class="row">

                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" required="true" style="border-radius: 10px;" id="email" name="email" value="{{$entreprise['email'] }}">
                    </div>

                    <div class="mb-2 col-md-4">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="telephone" name="telephone" value="{{$entreprise['telephone'] }}">
                    </div>

                    <div class="mb-2 col-md-4">
                        <label for="telephone" class="form-label">Code</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="code" name="code" value="{{$entreprise['code'] }}">
                    </div>
                </div>

                
                <div class="row" hidden="hidden">
                    
                    <div class="mb-2 col-md-4">
                        <label for="telephone" class="form-label">isParentCompany</label>
                        <input type="text" class="form-control" id="isParentCompany" name="isParentCompany" value="{{$entreprise['isParentCompany'] }}">
                    </div>

                    <div class="mb-2 col-md-4">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$entreprise['deletedFlag'] }}">
                    </div>
                </div>
                
                <div class="row" hidden="hidden">

                    <div class="mb-2 col-md-3" >
                        <label for="nom_responsable" class="form-label">createdBy</label>
                        <input type="text" class="form-control" id="createdBy" name="createdBy" value="{{$entreprise['createdBy'] }}">
                    </div>

                    <div class="mb-2 col-md-3" >
                        <label for="userIdForLog" class="form-label">userIdForLog</label>
                        <input type="text" class="form-control" id="userIdForLog" name="userIdForLog" value="{{$entreprise['userIdForLog'] }}">
                    </div>

                    <div class="mb-2 col-md-3" >
                        <label for="updatedAt" class="form-label">updatedAt</label>
                        <input type="text" class="form-control" id="updatedAt" name="updatedAt" value="{{$entreprise['updatedAt'] }}">
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
