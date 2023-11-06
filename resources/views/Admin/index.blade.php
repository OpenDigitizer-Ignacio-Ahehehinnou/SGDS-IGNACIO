
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            @if($role == 12)

            <h3 class="border-bottom pb-2 mb-5">Liste des entreprises</h3>
            @else 
            <h3 class="border-bottom pb-2 mb-5">Mon entreprise</h3>

            @endif
            <div class="mt-2">
                @if($role == 12)
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->
            
                    <a href="{{ route ('entreprise.create')}}" type="button" class=" btn btn-primary">Ajouter une entreprise</a></div>

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
                
                    <div class="box-body">
                        <table id="example" class="table table-bordered table-striped example">
                        <thead>
                    <tr>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th> 
                        <th scope="col">Adresse</th>
                        {{-- <th scope="col">Zone</th> --}}

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($entreprises as $entreprise)
                    @if($entreprise['entrepriseId'] == $entrepriseId && $entreprise['entrepriseId'] !=20 )            
                            <tr>
                                {{-- <td>{{$loop->index +1}}</td> --}}
                                <td>{{$entreprise['name']}}</td>
                                <td>{{$entreprise['email']}}</td>
                                <td>{{$entreprise['telephone']}}</td>
                                <td hidden>{{$entreprise['createdAt']}}</td>

                                <td>{{$entreprise['address']}}</td>  
                                {{-- <td>{{$entreprise['']}}</td>        --}}
                                <td>

                                        <a href="{{route('entreprise.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>

                                        <a href="{{route('entreprise.edit', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{route('admin.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-secondary"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        <a href="{{route('signalement.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-success"><i class="fa fa-flag"></i></a>

                                    <button type="button" class="btn btn-danger"
                                        data-key="{{ $entreprise['entrepriseId'] }}" data-toggle="modal"
                                        data-target="#confirmationModal">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button> 
                                    
                                        <!-- Example split danger button -->
                                        
                                </td>

                            </tr>

                            @elseif($role == 12 && $entreprise['entrepriseId'] != 20)

                            <tr>
                                {{-- <td>{{$loop->index +1}}</td> --}}
                                <td>{{$entreprise['name']}}</td>
                                <td>{{$entreprise['email']}}</td>
                                <td>{{$entreprise['telephone']}}</td>
                                <td hidden>{{$entreprise['createdAt']}}</td>

                                <td>{{$entreprise['address']}}</td>  
                                {{-- <td>{{$entreprise['']}}</td>        --}}
                                <td>

                                        <a href="{{route('entreprise.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>

                                        <a href="{{route('entreprise.edit', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{route('admin.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-secondary"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        <a href="{{route('signalement.detail', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-success"><i class="fa fa-flag"></i></a>

                                    <button type="button" class="btn btn-danger"
                                        data-key="{{ $entreprise['entrepriseId'] }}" data-toggle="modal"
                                        data-target="#confirmationModal">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button> 
                                    
                                        <!-- Example split danger button -->
                                        
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
            <form method="POST" action="{{ route('entreprise.supprimer') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Voulez vous vraiment supprimer cette entreprise ?</p>
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
                        <h2  class="modal-title" id="exampleModalLabel">Détails sur l'entreprise</h2>
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
