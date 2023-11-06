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
                <div class="panel-heading">Ajouter une catégorie</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('categorie.ajouter')}}">
                        @csrf

                        <div class="row mt-3">
                            <div class="mb-3 col-md-12">
                                <label for="exampleInputEmail1" class="form-label">Nom</label>
                                <input type="text" class="form-control" required style="border-radius: 10px;" id="nom" name="nom">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="exampleInputPassword1" class="form-label">Type</label>
                                <input type="text" class="form-control" required="true" id="type" style="border-radius: 10px;" name="type">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class=" col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" required="true" id="code" style="border-radius: 10px;" name="code">
                            </div>
                        </div>

                        <div class="row" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="exampleInputPassword1" class="form-label">creatorUsername</label>

                                <input type="text" class="form-control" id="creatorUsername" value="chriss" name="creatorUsername">

                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>

                                <input type="text" class="form-control" id="deletedFlag" value="N" name="deletedFlag">

                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="activationStatus" class="form-label">createdAt</label>
                                <input type="text" class="form-control" id="creatorId" value="2023-08-02T11:37:47.544+00:00" name="createdAt">
                            </div>


                        </div>

                        <div class="row mb-3" hidden>

                            <div class="mb-3 col-md-4">
                                <label for="activationStatus" class="form-label">Creator Id</label>
                                <input type="text" class="form-control" id="creatorId" value="1" name="creatorId">
                            </div>


                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">deletedFlag</label>
                                <input type="text" class="form-control" value="N" id="deletedFlag" name="deletedFlag">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="deletedFlag" class="form-label">createdBy</label>
                                <input type="text" class="form-control" value="JaneDoe" id="createdBy" name="createdBy">
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
