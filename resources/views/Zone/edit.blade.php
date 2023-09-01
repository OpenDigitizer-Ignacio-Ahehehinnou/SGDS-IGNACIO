
@extends("layouts.master")

@section("contenu")

{{-- <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Edition d'une zone</h3>
     --}}
        <div class="mt-2">

        @if(session()->has("success"))
        <div class="alert alert-success" >
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

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">Edition d'une zone</div>


                    <div class="panel-body">

       

        <form  method="post" action="{{ route('zone.update', ['zone'=>$zone['zoneId']] )}}">
                @csrf
                <input type="hidden" name="_method" value="put">

                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Zone</label>
                        <input type="text" class="form-control" id="nom" required="true" name="zone" value="{{$zone['nom'] }}" style="border-radius: 10px;">
                    </div>
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{$zone['zoneId'] }}" hidden="hiddien" > --}}
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Ville</label>
                        {{-- <input type="text" class="form-control" id="prenom" name="ville" value="{{$zone['cityModel']['nom'] }}"> --}}
                         <select class="form-control" id="exampleSelect" required="true" name="ville" style="border-radius: 10px;">

                        @foreach ($villes as $ville )

                            <option value="{{$ville['cityId']}}">{{$ville['nom'] }}</option>

                        @endforeach
                        
                    </select>
                    </div>

                </div>
                

                <div class="row" hidden>

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                        <input type="text" class="form-control" id="creatorUsername" name="creatorUsername" value="{{$zone['creatorUsername']}}">
                    </div>

                    <div class="mb-3 col-md-6" hidden="hidden">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" name="createdAt" value="{{$zone['createdAt'] }}">
                    </div>

                    
                </div>
                
                <div class="row" hidden>

                <div class="mb-3 col-md-6"hidden="hidden" >
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" name="creatorId" value="{{$zone['creatorId'] }}" >
                    </div>
                    

                    <div class="mb-3 col-md-6"hidden="hidden">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" id="deletedFlag" name="deletedFlag" value="{{$zone['deletedFlag'] }}">
                    </div>

                </div>
            
                <br>
                <div >

                <button type="submit" class="btn btn-warning">Modifier</button>
                {{-- <a href="{{route('zone')}}" class="btn btn-danger">Annuler</a> --}}

                </div>

               

            </form>  
                    
        </form>
    </div>
</div>
<div class="colmd-3"></div>
</div>
</div>

</div>

            
        
{{-- </div> --}}

@endsection
