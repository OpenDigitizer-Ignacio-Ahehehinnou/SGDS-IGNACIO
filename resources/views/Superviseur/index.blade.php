@extends("layouts.master")

@section("contenu")
<h3 class="border-bottom pb-2 mb-3">Liste des superviseurs</h3>

<div class="mt-2">
    <div class="d-flex justify-content-end mb-2">
        <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

        <a href="{{ route ('superviseur.create')}}" type="button" class=" btn btn-primary">Ajouter un
            superviseur</a>
    </div>

</div>
<div class="container-fluid">

    <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">

        <br>

        @if(session()->has("success"))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
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

        @if(session()->has("successDelete"))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
            <h5>{{session()->get('successDelete')}}</h5>


        </div>
        @endif
        <div class="row ">
            <div class="box">
                <!-- <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div> -->
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom & prénoms</th>
                                <th>Nom d'utilisateur</th>
                                <th>Matricule(s)</th>
                                <th> Téléphone</th>
                                {{-- <th>Rôle</th> --}}

                                <th>Adresse</th>
                                <th>Entreprise</th>

                                <th>Actions</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach($superviseurs as $superviseur)

                            @if($role == "ADMIN" && isset($superviseur['entrepriseModel']['name']) && isset($superviseur['roleModel']['libelle']))
                            @if($superviseur['entrepriseModel']['name'] == $entreprise && $superviseur['roleModel']['libelle'] == 'SUPERVISOR')

                            <tr>
                                <td>{{$superviseur['firstName']}} {{$superviseur['lastName']}}</td>
                                <td>{{$superviseur['username']}}</td>
                                <td>{{$superviseur['matricule']}}</td>
                                <td>{{$superviseur['telephone']}}</td>
                                <td>{{$superviseur['adress']}}</td>
                                <td>{{$superviseur['entrepriseModel']['name']}}</td>


                                <td>

                                        <a href="{{route('superviseur.edit', ['superviseur'=>$superviseur['userId'] ] )}}"
                                            type="button" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i></a>


                                        <button type="button" class="btn btn-danger"
                                            data-key="{{ $superviseur['userId'] }}" data-toggle="modal"
                                            data-target="#confirmationModal">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>

                                </td>

                            </tr>
                            @endif
                            @else

                                    @if(isset($superviseur['roleModel']) && $superviseur['roleModel']['libelle'] == 'SUPERVISOR')

                            <tr>
                                <td>{{$superviseur['firstName']}} {{$superviseur['lastName']}}</td>
                                <td>{{$superviseur['username']}}</td>
                                <td>{{$superviseur['matricule']}}</td>
                                <td>{{$superviseur['telephone']}}</td>
                                <td>{{$superviseur['adress']}}</td>
                                <td>{{$superviseur['entrepriseModel']['name']}}</td>


                                <td>
                                        <a href="{{ route( 'superviseur.edit', ['superviseur'=>$superviseur['userId']])}}"
                                            type="button" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i></a>


                                        <button type="button" class="btn btn-danger" data-key="{{ $superviseur['userId'] }}" data-toggle="modal" data-target="#confirmationModal">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>

                                </td>

                            </tr>
                            @endif

                            @endif
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


    </div>
</div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('superviseur.supprimer') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Voulez vous vraiment supprimer ce superviseur ?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="documentId" id="documentId" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui</button>
                </div>
            </form>
        </div>
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="detailModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header " style="background-color:#69B42D; color:white;">
                <h2 class="modal-title" id="exampleModalLabel">Détail superviseur</h2>
            </div>
            <div class="modal-body">

                <table class="table table-bordered">
                    <tbody>


                        <tr>

                            <th>Nom & prénoms</th>
                            <td>Dossou Jean</td>
                        </tr>
                        <tr>
                            <th>Matricule</th>
                            <td>AS0052</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>78451203</td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td>Superviseur</td>
                        </tr>
                        <tr>
                            <th>Adresse</th>
                            <td>Cotonou/Akpakpa</td>
                        </tr>
                    </tbody>

                </table>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
<script>
    $('.voir3').on('click', function(e) {
                e.preventDefault()
                $('#detailModal3').modal('show')
                //alert("Ouverture du formulaire d'inscription")


            });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

       $('#confirmationModal').on('show.bs.modal', function(e) {
           var button = $(e.relatedTarget);
           var deleteId = button.data('key');
           var modal = $(this);
           modal.find('#documentId').val(deleteId);
       })


   });

</script>


@endsection
