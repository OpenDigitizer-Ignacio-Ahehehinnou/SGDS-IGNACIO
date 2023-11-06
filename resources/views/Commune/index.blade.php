
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des communes</h3>
        
            <div class="mt-2">
                <div class="row">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->
                    <div class="col-md-3">
                        <a href="{{ route ('commune.create')}}" type="button" class=" btn btn-primary">Ajouter une commune</a></div>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route ('commune2')}}" type="button" class=" btn btn-primary">Commune desactiver</a></div>
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
                    <div id="msg200"></div>

                    <div class="row">
                        <div class="box">
                            <div class="box-body">
                                <table id="example" class="table table-bordered table-striped example">
                                    <thead>
                                        <tr>
                                            <th scope="col">Code</th>
                                            <th scope="col">Commune</th>
                                            <th scope="col">Département</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($communes as $commune)
                                            <tr>
                                                <td>{{$commune['code']}}</td>
                                                <td>{{$commune['name']}}</td>
                                                <td>{{$commune['solidwaistDepartment']['name']}}</td> 
                                                <td>{{$commune['isEnabled']}}</td>

                                                <td>
                                                    <button type="button" class="btn btn-success" title="Désactiver" onclick="updateStatus({{ $commune['municipalityId'] }})">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    
                                                    <a href="{{route('commune.edit', ['commune'=>$commune['municipalityId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                
                                                    <button type="button" class="btn btn-danger" data-key="{{ $commune['municipalityId'] }}" data-toggle="modal" data-target="#confirmationModal">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>

                                                    

                                                </td>
                                            </tr>
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
            <form method="POST" action="{{ route('commune.supprimer') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Voulez vous vraiment supprimer cette commune ?</p>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-md modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header " style="background-color:#6f42c1; color:white;">
                        <h2  class="modal-title" id="exampleModalLabel">FICHE DE POSTE</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id='annonceModal'>

                        
                        
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>


         <!-- Modal -->
         <div class="modal fade" id="detailModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header " style="background-color:#69B42D; color:white;">
                        <h2  class="modal-title" id="exampleModalLabel">Détails sur l'departement</h2>
                    </div>
                    <div class="modal-body">

                    <table class="table table-bordered" >
                        <tbody>
                        <tr>
                            
                            <th>Raispn sociale</th>
                            <td>ARI SERVICE</td>
                        </tr>
                        <tr>
                            <th>IFU</th>
                            <td>000587463321</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>78451203</td>
                        </tr>
                        <tr>
                            <th>Adresse</th>
                            <td>Cotonou/Akpakpa</td>
                        </tr>
                        <tr>
                            <th>Nom responsable</th>
                            <td>Ignacio AHEHEHINNOU</td>
                        </tr>
                        </tbody>

                    </table>

                        
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>



    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script>

        $(document).ready(function () {
           

            $('.voir4').on('click', function(e) {
                e.preventDefault()
                $('#detailModal4').modal('show')
                //alert("Ouverture du formulaire d'inscription")

                
            });
        });


        </script>

        {{-- Lescript pour la suppression --}}
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

{{-- Le script pour desactiver  --}}
<script>
    function updateStatus(communeId) {
        // Récupérer le jeton CSRF depuis la balise meta
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //alert(communeId)
        $.ajax({
            type: 'PUT',
            url: "{{route('commune.desactiver')}}",
            data: {
                _token: csrfToken,
                communeId: communeId
            },
            success: function (response) {
                if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
                            </div>`)
                        ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Commune désactivée avec succès. </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        ); 
                    }
                    
                    var url="{{route('commune')}}" 
                    if(response==200){
                        setTimeout(function(){
                            window.location=url
                        },1000) 
                    }  else{
                        $("#msg200").html(response);

                        }
            },
            error: function (error) {
                // Gérez les erreurs ici
                console.error(error);
            }
        });
    }
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
