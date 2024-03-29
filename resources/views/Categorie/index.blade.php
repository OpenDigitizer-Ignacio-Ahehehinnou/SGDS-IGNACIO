
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h5 class="border-bottom pb-2 mb-5">Catégorie de déchet</h5>

            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                    <a href="{{ route ('categorie.create')}}" type="button" class=" btn btn-primary">Ajouter une catégorie</a></div>

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








            <div class="d-flex flex-row">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#categorieActive" data-toggle="tab">Catégorie active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categorieSupprime" data-toggle="tab">Catégorie supprimée</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#toutesCategories" data-toggle="tab">Toutes les catégories</a>
                    </li>
                </ul>
            </div>
        
            <div class="tab-content mt-2">
                <div id="categorieActive" class="tab-pane fade show active">
                    

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
                                            <th>Déchet</th>
                                            <th>Type</th>
    
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
    
    
                                    @foreach($categories as $categorie)
    
    
                                        <tr>
                                            <td>{{$categorie['code']}}</td>
                                            <td>{{$categorie['nom']}}</td>
                                            <td>{{$categorie['type']}}</td>
                                            <td>
    
                                                    {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                        <a href="{{route('categorie.edit', ['categorie'=>$categorie['categoryId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
    
    
                                                        <button type="button" class="btn btn-danger"
                                                        data-key="{{ $categorie['categoryId'] }}" data-toggle="modal"
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
                <div id="categorieSupprime" class="tab-pane fade">
                    

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
                                            <th>Déchet</th>
                                            <th>Type</th>
    
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
    
    
                                    @foreach($categoriesSupprimer as $categorie)
    
    
                                        <tr>
                                            <td>{{$categorie['code']}}</td>
                                            <td>{{$categorie['nom']}}</td>
                                            <td>{{$categorie['type']}}</td>
                                            <td>
    
                                                    {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                        <a href="{{route('categorie.edit', ['categorie'=>$categorie['categoryId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
    
    
                                                        <button type="button" class="btn btn-danger"
                                                        data-key="{{ $categorie['categoryId'] }}" data-toggle="modal"
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
                <div id="toutesCategories" class="tab-pane fade">


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
                                            <th>Déchet</th>
                                            <th>Type</th>
    
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
    
    
                                    @foreach($categoriesTout as $categorie)
    
    
                                        <tr>
                                            <td>{{$categorie['code']}}</td>
                                            <td>{{$categorie['nom']}}</td>
                                            <td>{{$categorie['type']}}</td>
                                            <td>
    
                                                    {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                        <a href="{{route('categorie.edit', ['categorie'=>$categorie['categoryId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
    
    
                                                        <button type="button" class="btn btn-danger"
                                                        data-key="{{ $categorie['categoryId'] }}" data-toggle="modal"
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


@endsection
