@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des administrateurs</h3>

            @if( $role == "SUPERADMIN" )
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <a href="{{ route ('admin.create')}}" type="button" style="margin-right: 200px;" class="btn btn-primary ml-auto">Ajouter un admin</a>
                </div>
            </div>

            @endif
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
                        <table id="example" class="table table-bordered table-striped za">
                            <thead>
                                <tr>
                                    <th>Nom & prénoms</th>
                                    <th>Nom d'utilisateur</th>
                                    <th>Matricule(s)</th>
                                    <th> Téléphone</th>
                                    {{-- <th>Rôle</th> --}}
                                    <th>Adresse</th>
                                    <th>Entreprise</th>
                                    @if( $role == "SUPERADMIN" )
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>


                                @foreach($administrateurs as $administrateur)
                                @if($role == "ADMIN" && isset($administrateur['entrepriseModel']['name']) && isset($administrateur['roleModel']['libelle']))
                                @if($administrateur['entrepriseModel']['name'] == $entreprise && $administrateur['roleModel']['libelle'] == 'ADMIN')

                                    <tr>
                                        <td>{{$administrateur['firstName']}} {{$administrateur['lastName']}}</td>
                                        <td>{{$administrateur['username']}}</td>
                                        <td>{{$administrateur['matricule']}}</td>
                                        <td>{{$administrateur['telephone']}}</td>
                                        <td hidden="hidden">{{$administrateur['createdAt']}}</td>
                                        <td>{{$administrateur['adress']}}</td>

                                        <td>{{$administrateur['entrepriseModel']['name']}}</td>
                                    </tr>

                                    @endif
                                @else

@if(isset($administrateur['roleModel']) && $administrateur['roleModel']['libelle'] == 'ADMIN')
                                <tr>
                                    <td>{{$administrateur['firstName']}} {{$administrateur['lastName']}}</td>
                                    <td>{{$administrateur['username']}}</td>

                                    <td>{{$administrateur['matricule']}}</td>
                                    <td>{{$administrateur['telephone']}}</td>
                                    <td hidden="hidden">{{$administrateur['createdAt']}}</td>
                                    <td>{{$administrateur['adress']}}</td>

                                    <td>{{$administrateur['entrepriseModel']['name']}}</td>


                                    <td>
                                            <a href="{{ route( 'admin.edit', ['administrateur'=>$administrateur['userId']])}}"
                                                type="button" class="btn btn-warning"><i
                                                    class="bi bi-pencil-square"></i></a>


                                            <button type="button" class="btn btn-danger" data-key="{{ $administrateur['userId'] }}" data-toggle="modal" data-target="#confirmationModal">
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
            <form method="POST" action="{{ route('admin.supprimer') }}">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Voulez vous vraiment supprimer ce administrateur ?</p>
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
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header " style="background-color:#69B42D; color:white;">
                <h2 class="modal-title" id="exampleModalLabel">Détail d'un administrateur</h2>
            </div>
            <div class="modal-body">



                <table class="table table-bordered">
                    <tbody>
                        <tr>

                            <th>Nom & prénoms</th>
                            <td>{{$administrateur['firstName']}} {{$administrateur['lastName']}}</td>
                        </tr>
                        <tr>
                            <th>Matricule</th>
                            <td>{{$administrateur['firstName']}}</td>
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
    $(document).ready(function () {



            $('.voir').on('click', function(e) {
                e.preventDefault()
                $('#detailModal').modal('show')
                //alert("Ouverture du formulaire d'inscription")


            });
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
<script>
    // Lorsque la page est chargée
$(document).ready(function() {
    // Sélectionnez le tableau par son ID
    const table = $('.za');

    // Sélectionnez toutes les lignes sauf la première (l'en-tête)
    const rows = table.find('tr:gt(0)').toArray();

    // Triez les lignes en fonction de la colonne createdAt en ordre décroissant
    rows.sort(function(a, b) {
        const dateA = new Date($(a).find('td:eq(4)').text());
        const dateB = new Date($(b).find('td:eq(4)').text());
        return dateB - dateA;
    });

    // Remplacez les lignes dans le tableau avec les lignes triées
    $.each(rows, function(index, row) {
        table.append(row);
    });
});

</script>


@endsection
