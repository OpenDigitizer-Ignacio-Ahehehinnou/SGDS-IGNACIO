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
                <div class="panel-heading">Ajouter un departement</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('departement.update', ['departement'=>$departement['departmentId']])}}">

                        @csrf
                        <input type="hidden" name="_method" value="put">

                        <input type="hidden" name="departmentId" id="departmentId" value="{{$departement['departmentId'] }}">

                        <div class="row mt-3">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Département</label>
                                <input type="text" class="form-control" required style="border-radius: 10px;" id="name" name="name" value="{{$departement['name'] }}">

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" required="true" id="code" style="border-radius: 10px;" name="code"value="{{$departement['code'] }}">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="isEnabled" class="form-label">Active</label>
                                <input type="text" class="form-control" required="true" id="isEnabled" style="border-radius: 10px;" name="isEnabled" value="{{$departement['isEnabled'] }}">
                            </div>
                        </div>

                        <div class="row" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="areaKm2" class="form-label">areaKm2</label>

                                <input type="text" class="form-control" id="areaKm2" value="{{$departement['areaKm2'] }}" name="areaKm2">

                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>

                                <input type="text" class="form-control" id="deletedFlag" value="{{$departement['deletedFlag'] }}" name="deletedFlag">

                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="establishedDate" class="form-label">establishedDate</label>
                                <input type="text" class="form-control" id="establishedDate" value="{{$departement['establishedDate'] }}" name="establishedDate">
                            </div>


                        </div>

                        <div class="row mb-3" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="population" class="form-label">population</label>
                                <input type="text" class="form-control" id="population" value="{{$departement['population'] }}" name="population">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="countryName" class="form-label">countryName</label>
                                <input type="text" class="form-control" value="{{$departement['countryName'] }}" id="countryName" name="countryName">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">createdBy</label>
                                <input type="text" class="form-control" value="{{$departement['createdBy'] }}" id="createdBy" name="createdBy">
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