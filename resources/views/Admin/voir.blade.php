@extends('layouts.master')

@section('contenu')
    <style>
        .nav-tabs {
            display: flex;
            justify-content: space-between;
        }

        .tab-content {
            display: flex;
            flex-direction: column;
        }
    </style>





    @php
            $pos = [];

        $bos=[];
        $tos=[];

    @endphp

    @foreach ($admins as $admin)
    @php
    $pos[] = [
        'po0' => $admin['userId'],

        'po' => $admin['firstName'],
        'po1' => $admin['lastName'],
        'po2' => $admin['telephone'],
        'po3' => $admin['matricule'],
        'po4' => $admin['adress'],
        'po5' => $admin['email'],
    ];
@endphp
    @endforeach




    @foreach ($superviseurs as $superviseur)
    @php
    $bos[] = [
        'bo0' => $superviseur['userId'],
        'bo' => $superviseur['firstName'],
        'bo1' => $superviseur['lastName'],
        'bo2' => $superviseur['telephone'],
        'bo3' => $superviseur['matricule'],
        'bo4' => $superviseur['adress'],
        'bo5' => $superviseur['email'],
    ];
@endphp
    @endforeach



    @foreach ($collecteurs as $collecteur)
    @php
    $tos[] = [
        'to0' => $collecteur['userId'],
        'to' => $collecteur['firstName'],
        'to1' => $collecteur['lastName'],
        'to2' => $collecteur['telephone'],
        'to3' => $collecteur['matricule'],
        'to4' => $collecteur['adress'],
        'to5' => $collecteur['email'],
    ];
@endphp
    @endforeach



    <div class="d-flex flex-row">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#categorieActive" data-toggle="tab">Liste des admins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#categorieSupprime" data-toggle="tab">Liste des superviseurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#toutesCategories" data-toggle="tab">Liste des collecteurs</a>
            </li>
        </ul>
    </div>

    <div class="tab-content mt-2">

        <div id="categorieActive" class="tab-pane fade show active">


            <div class="card" style="margin:20px;">



                <h1 class="card-header">Liste des administrateurs</h1><br>

                <div id="msg200"></div>

                
                @if($role== 7 or $role==12)
                <div class="d-flex justify-content-between mb-2">

                    <a href="{{ route('admin.create') }}" type="button" class=" btn btn-primary">Ajouter un admin</a>
                </div>
                @endif

            </div>

            <div class="card-body">
                <div class="card-body">

                    <table id="example" class="table table-bordered table-striped example">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Email</th>
                                @if($role== 7 or $role==12)

                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pos as $item)
                            <tr>
                                <td>{{ $item['po'] }}</td>
                                <td>{{ $item['po1'] }}</td>
                                <td>{{ $item['po2'] }}</td>
                                <td>{{ $item['po3'] }}</td>
                                <td>{{ $item['po4'] }}</td>
                                <td>{{ $item['po5'] }}</td>
                                @if($role== 7 or $role==12)

                                <td>
                                    <button type="button" class="btn btn-success" title="Désactiver" onclick="updateStatus({{ $item['po0'] }})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    {{-- <a href="{{route('admin.edit', ['admin'=>$item['po0'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> --}}
                                    <a href="{{ route('admin.edit', ['administrateur' => $item['po0']]) }}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>


                                    <button type="button" class="btn btn-danger supprimerEntreprise"
                                        data-key="{{ $item['po0'] }}" data-toggle="modal"
                                        >
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                
                            
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" >
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                            
                                            <div class="modal-body m-3">
                                                <p class="mb-0">Voulez-vous vraiment supprimer cet élément ?</p>
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


                                </td>
                            @endif
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                </div>


            </div>

        </div>

    

        <div id="categorieSupprime" class="tab-pane fade">


            <div class="card" style="margin:20px;">



                <h1 class="card-header">Liste des superviseurs</h1><br>

                <div class="d-flex justify-content-between mb-2">

                    <a href="{{ route('superviseur.create') }}" type="button" class=" btn btn-primary">Ajouter un superviseur</a>
                </div>

            </div>

            <div class="card-body">
                <div class="card-body">

                    <table id="example" class="table table-bordered table-striped example">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bos as $item)
                            <tr>
                                <td>{{ $item['bo'] }}</td>
                                <td>{{ $item['bo1'] }}</td>
                                <td>{{ $item['bo2'] }}</td>
                                <td>{{ $item['bo3'] }}</td>
                                <td>{{ $item['bo4'] }}</td>
                                <td>{{ $item['bo5'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" title="Désactiver" onclick="updateStatus2({{ $item['bo0'] }})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    {{-- <a href="{{route('admin.edit', ['admin'=>$item['po0'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> --}}
                                    <a href="{{ route('superviseur.edit', ['superviseur' => $item['bo0']]) }}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>


                                        <button type="button" class="btn btn-danger"
                                            data-key="{{ $item['bo0'] }}" data-toggle="modal"
                                            data-target="#confirmationModal2">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>



                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                </div>


            </div>

        </div>


    

        <div id="toutesCategories" class="tab-pane fade">


            <div class="card" style="margin:20px;">



                <h1 class="card-header">Liste des collecteurs</h1><br>

                <div class="d-flex justify-content-between mb-2">

                    <a href="{{ route('collecteur.create') }}" type="button" class=" btn btn-primary">Ajouter un collecteur</a>
                </div>

            </div>

            <div class="card-body">
                <div class="card-body">

                    <table id="example" class="table table-bordered table-striped example">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Matricule</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tos as $item)
                            <tr>
                                <td>{{ $item['to'] }}</td>
                                <td>{{ $item['to1'] }}</td>
                                <td>{{ $item['to2'] }}</td>
                                <td>{{ $item['to3'] }}</td>
                                <td>{{ $item['to4'] }}</td>
                                <td>{{ $item['to5'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" title="Désactiver" onclick="updateStatus3({{ $item['to0'] }})">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    {{-- <a href="{{route('admin.edit', ['admin'=>$item['po0'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> --}}
                                    <a href="{{ route('collecteur.edit', ['collecteur' => $item['to0']]) }}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>


                                        <button type="button" class="btn btn-danger"
                                            data-key="{{ $item['to0'] }}" data-toggle="modal"
                                            data-target="#confirmationModal3">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>


                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                </div>


            </div>

        </div>

    </div>

     {{-- <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.supprimer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body m-3">
                        <p class="mb-0">Voulez vous vraiment supprimer cet admin ?</p>
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
      --}}
     {{-- modal pour supprimer un superviseur  --}}
     <div class="modal fade" id="confirmationModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('superviseur.supprimer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
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

    {{-- modal pour supprimer un collecteur  --}}
    <div class="modal fade" id="confirmationModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('superviseur.supprimer') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
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




    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>


    
{{--  Supprimer un admin --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#confirmationModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var deleteId = button.data('key');
            var modal = $(this);
            modal.find('#documentId').val(deleteId);
        });
    });
</script> --}}
<script>
    
    $(document).ready(function (e) {
        
        $('.supprimerEntreprise').on('click', function(e) {
            e.preventDefault()
        
            //alert("Ouverture du formulaire d'inscription")

            var id = $(this).attr('data-key');
           // alert(id);
            var isBoss = confirm("Voulez vous supprimer cette entreprise ?");
            if(isBoss==true){
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var url = "{{ route('admin.supprimer')}}";

                var data = {
                    _token: csrfToken,
                    id

                };

                
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (response)
                    { 
                            if(parseInt(response)==200 || parseInt(response)==500){
                
                                parseInt(response)==500?($("#msg2").html(`<div class='alert alert-danger text-center' role='alert'>
                                    <strong>Une erreur s'est produite</strong> veuillez réessayez.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>`)
                                ):($('#msg2').html(`<div class='alert alert-success text-center' role='alert'>
                                    <strong>Entreprise supprimé avec succès  </strong> "
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>`)
                                ); 
                            }
                            
                            var url="{{route('admin')}}" 
                            if(response==200){
                                setTimeout(function(){
                                    window.location=url
                                },3000) 
                            }  else{
                                $("#msg2").html(response);
        
                                } 

                    }
                
                });
            }else{
                $("#msg2").innerHtml("");
            }
        });
    });
</script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {

        $('#confirmationModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var deleteId = button.data('key');
            var modal = $(this);
            //console.log(deleteId);
            modal.find('#documentId').val(deleteId);
        })
    });
</script> --}}


    {{-- Le script pour  desactiver un admin  --}}
<script>
    function updateStatus(po0) {
        // Récupérer le jeton CSRF depuis la balise meta
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //alert(po0)
        $.ajax({
            type: 'PUT',
            url: "{{route('admin.desactiver')}}",
            data: {
                _token: csrfToken,
                userId: po0
            },
            success: function (response) {
                if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
                            </div>`)
                        ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Admin désactivé avec succès. </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        ); 
                    }
                    
                    var url="{{route('admin')}}" 
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

    
{{--  Supprimer un superviseur --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

       $('#confirmationModal2').on('show.bs.modal', function(e) {
           var button = $(e.relatedTarget);
           var deleteId = button.data('key');
           var modal = $(this);
           modal.find('#documentId').val(deleteId);
       })


   });
</script>


  {{-- Le script pour  desactiver un superviseur  --}}
  <script>
    function updateStatus2(bo0) {
        // Récupérer le jeton CSRF depuis la balise meta
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //alert(po0)
        $.ajax({
            type: 'PUT',
            url: "{{route('superviseur.desactiver')}}",
            data: {
                _token: csrfToken,
                userId: bo0
            },
            success: function (response) {
                if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
                            </div>`)
                        ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Superviseur désactivé avec succès. </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        ); 
                    }
                    
                    var url="{{route('admin')}}" 
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


{{--  Supprimer un collecteur --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        $('#confirmationModal3').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var deleteId = button.data('key');
            var modal = $(this);
            modal.find('#documentId').val(deleteId);
        })

    });
</script>


  {{-- Le script pour  desactiver un collecteur  --}}
  <script>
    function updateStatus3(to0) {
        // Récupérer le jeton CSRF depuis la balise meta
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //alert(po0)
        $.ajax({
            type: 'PUT',
            url: "{{route('superviseur.desactiver')}}",
            data: {
                _token: csrfToken,
                userId: to0
            },
            success: function (response) {
                if(parseInt(response)==200 || parseInt(response)==500){
                        
                        parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                            <strong>Une erreur s'est produite</strong> veuillez réessayez.
                            
                            </div>`)
                        ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                            <strong> Collecteur désactivé avec succès. </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        ); 
                    }
                    
                    var url="{{route('admin')}}" 
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
