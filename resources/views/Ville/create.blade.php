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
    <div class="col-md-3"></div>
    <div class="col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">Ajouter une ville</div>


        <div class="panel-body">


            <form method="post" action="{{ route('ville.ajouter')}}">
                @csrf

                <div class="row mt-3"> 
                    <div class="mb-3 col-md-12">
                        <label for="exampleInputEmail1" class="form-label">Code</label>
                        <input type="text" class="form-control" required="true" style="border-radius: 10px;" id="nom" name="code">
                    </div>
                </div>
                    <br>
                <div class="row mt-3">
                    <div class=" col-md-12">
                        <label for="exampleInputPassword1" class="form-label">Ville</label>
                        <input type="text" class="form-control" required="true" id="prenom" style="border-radius: 10px;" name="nom">
                    </div>

                </div>

            

                <div class="row" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">creatorUsername</label>
            
                        <input type="text" class="form-control" id="creatorUsername" value="Ignacio" name="creatorUsername">

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">createdAt</label>
                        <input type="text" class="form-control" id="creatorId" value="2023-08-02T11:37:47.544+00:00" name="createdAt">
                    </div>


                </div>

                <div class="row mb-3" hidden>

                    <div class="mb-3 col-md-6">
                        <label for="activationStatus" class="form-label">Creator Id</label>
                        <input type="text" class="form-control" id="creatorId" value="1" name="creatorId">
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="deletedFlag" class="form-label">deletedFlag</label>
                        <input type="text" class="form-control" value="S" id="deletedFlag" name="deletedFlag">
                    </div>

                </div>

                <br>
                <div class="mb-3">

                    <button type="submit" class="btn btn-primary">Enregistrer</button>

                </div>




            </form>

        </div>
        <div class="col-md-3"></div>
    </div></div>
    </div>
</div>


</div>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>

<script>
    $('#prenom').on('input', function(e) {
        var inputVal = $(this).val();
        var onlyLetters = inputVal.replace(/[0-9]/g, '');intitule
        $(this).val(onlyLetters);
    });
</script>


@endsection