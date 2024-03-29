@extends("layouts.master")

@section("contenu")


<div class="mt-2">

    @if(session()->has("success"))
        <div class="alert alert-success">
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
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">Ajouter une commune</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('commune.update', ['commune'=>$commune['municipalityId']])}}">

                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="municipalityId" id="municipalityId" value="{{$commune['municipalityId'] }}">

                        <div class="row mt-3">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Commune</label>
                                <input type="text" class="form-control" required style="border-radius: 10px;" id="name" name="name" value="{{$commune['name'] }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" required="true" id="code" style="border-radius: 10px;" name="code" value="{{$commune['code'] }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Département</label>
                                <select name="departmentId" id="departmentId" class="form-control" style="border-radius: 10px;">
                                    {{-- <option value="1">Entreprise A</option>
                                    <option value="2">Entreprise B</option> --}}
                                    {{-- @if($role =="ADMIN")--}}
                                    @foreach ($departements as $departement )

                                    {{-- @if($entrepris['name'] == $entreprise) --}}
                                    <option value="{{$departement['departmentId']}}">{{$departement['name']}}</option>
                                    {{-- @endif --}}
                                    @endforeach
                             
                                </select>                            
                            </div>
                        </div>

                        {{-- <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="isEnabled" class="form-label">Active</label>
                                <input type="text" class="form-control" required="true" id="isEnabled" style="border-radius: 10px;" name="isEnabled" value="{{$commune['isEnabled'] }}">
                            </div>
                        </div> --}}

                        <div class="row" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="areaKm2" class="form-label">areaKm2</label>

                                <input type="text" class="form-control" id="areaKm2" value="986532" name="areaKm2" value="{{$commune['areaKm2'] }}">

                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>

                                <input type="text" class="form-control" id="deletedFlag" value="{{$commune['deletedFlag'] }}" name="deletedFlag">

                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="establishedDate" class="form-label">establishedDate</label>
                                <input type="text" class="form-control" id="establishedDate" value="{{$commune['areaKm2'] }}" name="establishedDate">
                            </div>


                        </div>

                        <div class="row mb-3" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="population" class="form-label">population</label>
                                <input type="text" class="form-control" id="population" value="{{$commune['areaKm2'] }}" name="population">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="createdBy" class="form-label">createdBy</label>
                                <input type="text" class="form-control" value="{{$commune['createdBy'] }}" id="createdBy" name="createdBy">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="createdAt" class="form-label">createdAt</label>
                                <input type="text" class="form-control" value="{{$commune['createdAt'] }}" id="createdAt" name="createdAt">
                            </div>


                        </div>

                        <br>
                        <div class="mb-3">

                            <button type="submit" class="btn btn-primary">Enregistrer</button>

                        </div>


                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>

@endsection
