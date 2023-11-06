
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h5 class="border-bottom pb-2 mb-5">Arrondissement</h5>

            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                    <a href="{{ route ('arrondissement.create')}}" type="button" class=" btn btn-primary">Ajouter un arrondissement</a></div>
                    <a href="{{ route ('arrondissement2')}}" type="button" class=" btn btn-primary">Arrondissement desactivée</a></div>

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
                                        <th>Code</th>
                                        <th>Arrondissement</th>
                                        <th>Commune</th>
                                        <th>Entreprise</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>


                                @foreach($arrondissements as $arrondissement)


                                    <tr>
                                        <td>{{$arrondissement['code']}}</td>
                                        <td>{{$arrondissement['name']}}</td>
                                        <td>{{$arrondissement['solidwaistMunicipality']['name']}}</td>
                                        <td>{{$arrondissement['solidwaistEntreprise']['name']}}</td>

                                        <td>

                                            <button type="button" class="btn btn-success" title="Désactiver" onclick="updateStatus({{ $arrondissement['districtId'] }})">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <a href="{{route('arrondissement.edit', ['arrondissement'=>$arrondissement['districtId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>


                                                <button type="button" class="btn btn-danger"
                                                    data-key="{{ $arrondissement['districtId'] }}" data-toggle="modal"
                                                    data-target="#confirmationModal">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                                
                                                    </td>
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
                <form method="POST" action="{{ route('categorie.supprimer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <p class="mb-0">Voulez vous vraiment supprimer cette categorie ?</p>
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

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


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
    function updateStatus(districtId) {
        // Récupérer le jeton CSRF depuis la balise meta
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //alert(communeId)
        $.ajax({
            type: 'PUT',
            url: "{{route('arrondissement.desactiver')}}",
            data: {
                _token: csrfToken,
                districtId: districtId
            },
            success: function (response) {
                if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
                            </div>`)
                        ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Arrondissement désactivée avec succès. </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        ); 
                    }
                    
                    var url="{{route('arrondissement')}}" 
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



@endsection
