
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des entreprises</h3>
        
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->
            
                    <a href="{{ route ('entreprise.create')}}" type="button" class=" btn btn-primary">Ajouter une entreprise</a></div>

                </div>
                    <br>
                @if(session()->has("successDelete"))
                    <div class="alert alert-success" >
                        <h5>{{session()->get('successDelete')}}</h5>
                    </div>
                @endif
                <div class="row ">
                    <div class="box">
                       
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                            <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ifu</th>
                            <th scope="col">Téléphone</th> 
                            <th scope="col">Siège</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entreprises as $entreprise)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$entreprise['name']}}</td>
                            <td>{{$entreprise['email']}}</td>
                            <td>{{$entreprise['ifu']}}</td> 
                            <td>{{$entreprise['telephone']}}</td>
                            <td>{{$entreprise['siege']}}</td>       
                            <td>


                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                    <button type="button" class="btn btn-success voir4"><i class="bi bi-eye-fill"></i></button>
                                    <a href="{{route('entreprise.edit', ['entreprise'=>$entreprise['entrepriseId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a type="button" class="btn btn-danger" onclick="if(confirm('voulez-vous supprimer cet entreprise ???')){
                                        document.getElementById('form-{{$entreprise['entrepriseId']}}').submit() }"><i class="bi bi-trash3-fill"></i></a>

                                        <form id="form-{{$entreprise['entrepriseId']}}" action="{{ route( 'entreprise.supprimer', ['entreprise'=>$entreprise['entrepriseId']])}}" method="post">
                                            @csrf
                                                <input type="hidden" name="_method" value="delete">
                                        </form>
                                {{-- </div> --}}


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



@endsection
