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
                <div class="panel-heading">Ajouter un rôle</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('role.ajouter')}}">
                        @csrf

                        <div class="row mt-3">
                            <div class="mb-3 col-md-12">
                                <label for="label" class="form-label">Rôle</label>
                                <input type="text" class="form-control" required style="border-radius: 10px;" id="label" name="label">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" required="true" id="code" style="border-radius: 10px;" name="code">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="47" rows="5" style="border-radius: 10px;"></textarea>                            
                            </div>
                        </div>

                        
                        <div class="row" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="areaKm2" class="form-label">areaKm2</label>

                                <input type="text" class="form-control" id="areaKm2" value="986532" name="areaKm2">

                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>

                                <input type="text" class="form-control" id="deletedFlag" value="N" name="deletedFlag">

                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="establishedDate" class="form-label">establishedDate</label>
                                <input type="text" class="form-control" id="establishedDate" value="1792-01-01" name="establishedDate">
                            </div>


                        </div>

                        <div class="row mb-3" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="population" class="form-label">population</label>
                                <input type="text" class="form-control" id="population" value="1000" name="population">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="createdBy" class="form-label">createdBy</label>
                                <input type="text" class="form-control" value="JohnDoe" id="createdBy" name="createdBy">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="createdAt" class="form-label">createdAt</label>
                                <input type="text" class="form-control" value="2023-10-24T12:00:00" id="createdAt" name="createdAt">
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
