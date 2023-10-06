@extends("layouts.master")

@section("contenu")

<div class="container-fluid">
    <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Liste des collecteurs</h3>

        <div class="mt-2">
            <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('collecteur.create')}}" type="button" class=" btn btn-primary">Ajouter un collecteur
                </a>
            </div>

        </div>
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
                    <table id="example" class=" example table table-bordered table-striped">
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

                            @foreach($collecteurs as $collecteur)

                            @if($role == "ADMIN" && isset($collecteur['entrepriseModel']['name']) && isset($collecteur['roleModel']['libelle']))
                            @if($collecteur['entrepriseModel']['name'] == $entreprise && $collecteur['roleModel']['libelle'] == 'COLLECTOR')

                            <tr>
                                <td>{{$collecteur['firstName']}} {{$collecteur['lastName']}}</td>
                                <td>{{$collecteur['username']}}</td>

                                <td>{{$collecteur['matricule']}}</td>
                                <td>{{$collecteur['telephone']}}</td>
                                <td hidden>{{$collecteur['createdAt']}}</td>

                                <td>{{$collecteur['adress']}}</td>
                                <td>{{$collecteur['entrepriseModel']['name']}}</td>

                                <td>

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
                                @else

                                        @if(isset($collecteur['roleModel']) && $collecteur['roleModel']['libelle'] == 'COLLECTOR')

                                <tr>
                                    <td>{{$collecteur['firstName']}} {{$collecteur['lastName']}}</td>
                                    <td>{{$collecteur['username']}}</td>
                                    <td>{{$collecteur['matricule']}}</td>
                                    <td>{{$collecteur['telephone']}}</td>
                                    <td hidden>{{$collecteur['createdAt']}}</td>

                                    <td>{{$collecteur['adress']}}</td>
                                    <td>{{$collecteur['entrepriseModel']['name']}}</td>


                                    <td>
                                            <a href="{{ route( 'collecteur.edit', ['collecteur'=>$collecteur['userId']])}}"
                                                type="button" class="btn btn-warning"><i
                                                    class="bi bi-pencil-square"></i></a>


                                            <button type="button" class="btn btn-danger" data-key="{{ $collecteur['userId'] }}" data-toggle="modal" data-target="#confirmationModal">
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
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('collecteur.supprimer') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title"><b>Confirmation de suppression</b></h4>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Voulez vous vraiment supprimer ce collecteur ?</p>
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

<script>
    // Lorsque la page est chargée
$(document).ready(function() {
    // Sélectionnez le tableau par son ID
    const table = $('.example');

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
