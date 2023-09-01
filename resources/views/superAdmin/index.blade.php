@extends("layouts.master")

@section("contenu")

<div class="container-fluid">
    <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Liste des super admins</h3>

        <div class="mt-2">
            <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('superAdmin.create')}}" type="button" class=" btn btn-primary">Ajouter un super admin
                </a>
            </div>

        </div>
        <br>

        @if(session()->has("success"))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
            <h3>{{session()->get('success')}}</h3>


        </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>

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
                                <th>Matricule(s)</th>
                                <th> Téléphone</th>
                                {{-- <th>Rôle</th> --}}
                                <th>Adresse</th>
                                {{-- <th>deletedFlag</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($superAdmin as $collecteur)

                            @if ( $collecteur['roleModel']['libelle'] == "SUPERADMIN")

                            <tr>
                                <td>{{$collecteur['firstName']}} {{$collecteur['lastName']}}</td>
                                <td>{{$collecteur['matricule']}}</td>
                                <td>{{$collecteur['telephone']}}</td>
                                {{-- <td>{{$collecteur['roleModel']['libelle']}}</td> --}}
                                <td>{{$collecteur['adress']}}</td>
                               
                                <td>


                                    {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}

                                        {{-- <button type="button" class="btn btn-success voir2"><i
                                                class="bi bi-eye-fill"></i></button> --}}

                                        <a href="{{route('collecteur.edit', ['collecteur'=>$collecteur['userId'] ] )}}"
                                            type="button" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i></a>


                                        <button type="button" class="btn btn-danger"
                                            data-key="{{ $collecteur['userId'] }}" data-toggle="modal"
                                            data-target="#confirmationModal">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>


                                </td>

                            </tr>
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
            <form method="POST" action="{{ route('superAdmin.supprimer') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Voulez vous vraiment supprimer ce super admin ?</p>
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
<div class="modal fade" id="detailModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header " style="background-color:#69B42D; color:white;">
                <h2 class="modal-title" id="exampleModalLabel">Détail collecteur</h2>
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
                            <td>98653214</td>
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
    $('.voir2').on('click', function(e) {
                e.preventDefault()
                $('#detailModal2').modal('show')
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