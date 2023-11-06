@extends("layouts.master")

@section("contenu")
{{--
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-5">Edition d'une categorie</h3> --}}

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
                <p>{{$error}}</p>

                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">Edition d'une catégorie</div>


                    <div class="panel-body">

                        <form method="post" action="{{ route('categorie.update', ['categorie'=>$categorie['categoryId']] )}}">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="categoryId" id="categoryId" value="{{$categorie['categoryId'] }}">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control" required="true" id="code" name="code"
                                        style="border-radius: 10px;" value="{{$categorie['code'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="exampleInputEmail1" class="form-label">Déchet</label>
                                    <input type="text" class="form-control" required="true" id="nom" name="nom"
                                        style="border-radius: 10px;" value="{{$categorie['nom'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="exampleInputPassword1" class="form-label">Type</label>
                                    <input type="text" class="form-control" required="true" id="type" name="type"
                                        style="border-radius: 10px;" value="{{$categorie['type'] }}">
                                </div>

                            </div>


                            <div class="row" hidden>

                                <div class="mb-3 col-md-6" hidden="hidden">
                                    <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
                                    <input type="text" class="form-control" id="creatorUsername" name="creatorUsername"
                                        value="{{$categorie['creatorUsername']}}">
                                </div>

                                <div class="mb-3 col-md-6" hidden="hidden">
                                    <label for="activationStatus" class="form-label">createdAt</label>
                                    <input type="text" class="form-control" id="creatorId" name="createdAt"
                                        value="{{$categorie['createdAt'] }}">
                                </div>


                            </div>

                            <div class="row" hidden>

                                <div class="mb-3 col-md-6" hidden="hidden">
                                    <label for="activationStatus" class="form-label">Creator Id</label>
                                    <input type="text" class="form-control" id="creatorId" name="creatorId"
                                        value="{{$categorie['creatorId'] }}">
                                </div>


                                <div class="mb-3 col-md-6" hidden="hidden">
                                    <label for="deletedFlag" class="form-label">deletedFlag</label>
                                    <input type="text" class="form-control" id="deletedFlag" name="deletedFlag"
                                        value="{{$categorie['deletedFlag'] }}">
                                </div>

                            </div>

                            <br>
                            <div>

                                <button type="submit" class="btn btn-warning">Modifier</button>

                            </div>



                        </form>
                    </div>
                </div>
                <div class="colmd-3"></div>
            </div>
        </div>

    </div>


    {{--
</div> --}}

@endsection
