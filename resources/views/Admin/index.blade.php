
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des administrateurs</h3>
        
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                    <a href="{{ route ('admin.create')}}" type="button" class=" btn btn-primary">Ajouter un admin</a></div>

                </div>
                <br>

                @if(session()->has("successDelete"))
                    <div class="alert alert-success" >
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
                                        <th>Rôle</th>
                                        <th>Adresse</th>
                                        <th>Deleted Flag</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>


                                @foreach($administrateurs as $administrateur)

                                    @if ( $administrateur['roleModel']['libelle'] == "ADMIN")

                                    <!-- <p>il ya  {{ count($administrateurs) }} admins</p> -->

                                    <tr>
                                        <td>{{$administrateur['firstName']}} {{$administrateur['lastName']}}</td>
                                        <td>{{$administrateur['matricule']}}</td>
                                        <td>{{$administrateur['telephone']}}</td> 
                                        <td>{{$administrateur['roleModel']['libelle']}}</td> 
                                        <td>{{$administrateur['adress']}}</td>
                                        <td>
                                            @if( $administrateur['deletedFlag']=="A")  
                                        
                                                <span class="label label-pill label-success">A</span>

                                            @elseif($administrateur['deletedFlag']=="D")

                                                <span class="label rounded-pill label-danger">D</span>

                                            @else

                                                <span class="label rounded-pill label-warning">{{$administrateur['deletedFlag']}}</span>

                                            @endif

                                    
                                        </td>
                                        <!-- <td>Admin</td> -->
                                        <td>


                                        {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                            <!-- <button type="button" class="btn btn-success voir" id="voir"><i class="bi bi-eye-fill"></i></button> -->
                                            <button type="button" class="btn btn-success voir"><i class="bi bi-eye-fill"></i></button>


                                            <a href="{{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            
                                            
                                            <a type="button" class="btn btn-danger" onclick="if(confirm('voulez-vous supprimer cet Admin ???')){
                                                document.getElementById('form-{{$administrateur['userId']}}').submit() }"><i class="bi bi-trash3-fill"></i></a>

                                                <form id="form-{{$administrateur['userId']}}" action="{{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}}" method="post">
                                                    @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                </form>
                                        {{-- </div> --}}


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
    

         <!-- Modal -->
         <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header " style="background-color:#69B42D; color:white;">
                        <h2  class="modal-title" id="exampleModalLabel">Détail d'un administrateur</h2>
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



    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script>

        $(document).ready(function () {
        
            

            $('.voir').on('click', function(e) {
                e.preventDefault()
                $('#detailModal').modal('show')
                //alert("Ouverture du formulaire d'inscription")

                
            });
        });


    </script>



@endsection
