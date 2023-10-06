@extends('layouts.master')


@section('contenu')
    <style>
        .rounded-circle-card {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            background-color: #f81111;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .rounded-circle-card h3 {
            margin: 0;
        }

        .rounded-circle-card p {
            margin: 0;
        }
    </style>
<style>
    /* Par défaut, cachez tous les tableaux */
    .hidden {
        display: none;
    }
</style>    {{-- Mes card cercle du haut --}}
    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua rounded-circle-card">
                <div class="inner">
                    <h3>{{ $validatedCount }}</h3>
                </div>

                <button onclick="afficherTableau('tableau4')" class="btn btn-sm btn-white" style="border-radius:8px;">
                    <i class="fa fa-arrow-circle-right"></i> Valider
                </button>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow rounded-circle-card">
                <div class="inner">
                    <h3>{{ $affectedCount }}</h3>
                </div>
                {{-- 
                <a href="{{ route('admin') }}" class="small-box-footer">Affecter <i
                        class="fa fa-arrow-circle-right"></i></a> --}}
                        <button onclick="afficherTableau('tableau2')" class="btn btn-sm btn-white" style="border-radius:8px;">
                            <i class="fa fa-arrow-circle-right"></i> Affecter
                        </button>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red rounded-circle-card">
                <div class="inner">
                    <h3>{{ $signaledCount }}</h3>
                </div>

                <button onclick="afficherTableau('tableau3')" class="btn btn-sm btn-white" style="border-radius:8px;">
                    <i class="fa fa-arrow-circle-right"></i> Signaler
                </button>
            </div>
        </div>



        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue rounded-circle-card">
                <div class="inner">
                    <h3>{{ $signalementCount }}</h3>
                </div>

                <button onclick="afficherTableau('tableau1')" class="btn btn-sm btn-white" style="border-radius:8px;">
                    <i class="fa fa-arrow-circle-right"></i> Signalements
                </button>
                
            </div>
        </div>

    </div>

    
     {{-- Signalement affecter --}}
     <div class="container-fluid hidden tableau tableau2">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5"><b><i>Liste des signalements  affectés</i></b></h3>

            <div class="mt-2">
                {{-- <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('signalement.create')}}" type="button" class=" btn btn-primary">Ajouter un signalement</a></div>

            </div> --}}

                <br>
                @if (session()->has('successDelete'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                        </button>
                        <h5>{{ session()->get('successDelete') }}</h5>


                    </div>
                @endif


                <div class="row">
                    <div class="box">
                        <!-- <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div> -->
                        <!-- /.box-header -->
                        <div class="box-body">
                                {{-- Tout les signalements --}}
                            <table id="example" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">Code</th>

                                        <th scope="col">Altitude</th>
                                        <th scope="col">Latitude</th>

                                        <th scope="col">Longitude</th>
                                        {{-- <th scope="col">Description</th> --}}

                                        {{-- <th scope="col">Status</th> --}}


                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($signalementsAffected as $signalement)
                                        <tr>
                                            {{-- <td>{{$loop->index +1}}</td> --}}
                                            <td>{{$signalement['uniqueCode'] }}</td>

                                            <td>{{ $signalement['altitude'] }}</td>
                                            <td>{{ $signalement['latitude'] }}</td>
                                            <td>{{ $signalement['longitude'] }}</td>
                                            {{-- <td>{{$signalement['description']}}</td> --}}
                                            {{-- <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td> --}}

                                            <td>
                                                {{-- {{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}} --}}

                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                <a href="{{ route('signalement.detail', ['reportingId' => $signalement['reportingId']]) }}"
                                                    type="button" class="btn btn-success"><i
                                                        class="bi bi-eye-fill"></i></a>


                                                <button type="button" class="btn btn-danger"
                                                    data-key="{{ $signalement['reportingId'] }}" data-toggle="modal"
                                                    data-target="#confirmationModal">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{-- <p>Place Name: <span id="place-name"></span></p> --}}

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tout les signalement --}}
    <div class="container-fluid tableau tableau1">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5"><b><i>Liste des signalements</i></b></h3>

            <div class="mt-2">
                {{-- <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('signalement.create')}}" type="button" class=" btn btn-primary">Ajouter un signalement</a></div>

            </div> --}}

                <br>
                @if (session()->has('successDelete'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                        </button>
                        <h5>{{ session()->get('successDelete') }}</h5>


                    </div>
                @endif


                <div class="row">
                    <div class="box">
                        <!-- <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div> -->
                        <!-- /.box-header -->
                        <div class="box-body">
                                {{-- Tout les signalements --}}
                            <table id="example1" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">Code</th>

                                        <th scope="col">Altitude</th>
                                        <th scope="col">Latitude</th>

                                        <th scope="col">Longitude</th>
                                        {{-- <th scope="col">Description</th> --}}

                                        {{-- <th scope="col">Status</th> --}}


                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($signalements as $signalement)
                                        <tr>
                                            {{-- <td>{{$loop->index +1}}</td> --}}
                                            <td>{{$signalement['uniqueCode'] }}</td>

                                            <td>{{ $signalement['altitude'] }}</td>
                                            <td>{{ $signalement['latitude'] }}</td>
                                            <td>{{ $signalement['longitude'] }}</td>
                                            {{-- <td>{{$signalement['description']}}</td> --}}
                                            {{-- <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td> --}}

                                            <td>
                                                {{-- {{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}} --}}

                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                <a href="{{ route('signalement.detail', ['reportingId' => $signalement['reportingId']]) }}"
                                                    type="button" class="btn btn-success"><i
                                                        class="bi bi-eye-fill"></i></a>


                                                <button type="button" class="btn btn-danger"
                                                    data-key="{{ $signalement['reportingId'] }}" data-toggle="modal"
                                                    data-target="#confirmationModal">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{-- <p>Place Name: <span id="place-name"></span></p> --}}

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    {{-- Signalement signaler --}}
    <div class="container-fluid hidden tableau tableau3">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5"><b><i>Liste des signalements en attentes</i></b></h3>

            <div class="mt-2">
                {{-- <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('signalement.create')}}" type="button" class=" btn btn-primary">Ajouter un signalement</a></div>

            </div> --}}

                <br>
                @if (session()->has('successDelete'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                        </button>
                        <h5>{{ session()->get('successDelete') }}</h5>


                    </div>
                @endif


                <div class="row">
                    <div class="box">
                        <!-- <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div> -->
                        <!-- /.box-header -->
                        <div class="box-body">
                                {{-- Tout les signalements --}}
                            <table id="example2" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">Code</th>

                                        <th scope="col">Altitude</th>
                                        <th scope="col">Latitude</th>

                                        <th scope="col">Longitude</th>
                                        {{-- <th scope="col">Description</th> --}}

                                        {{-- <th scope="col">Status</th> --}}


                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($signalementsSignaled as $signalement)
                                        <tr>
                                            {{-- <td>{{$loop->index +1}}</td> --}}
                                            <td>{{$signalement['uniqueCode'] }}</td>

                                            <td>{{ $signalement['altitude'] }}</td>
                                            <td>{{ $signalement['latitude'] }}</td>
                                            <td>{{ $signalement['longitude'] }}</td>
                                            {{-- <td>{{$signalement['description']}}</td> --}}
                                            {{-- <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td> --}}

                                            <td>
                                                {{-- {{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}} --}}

                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                <a href="{{ route('signalement.detail', ['reportingId' => $signalement['reportingId']]) }}"
                                                    type="button" class="btn btn-success"><i
                                                        class="bi bi-eye-fill"></i></a>


                                                <button type="button" class="btn btn-danger"
                                                    data-key="{{ $signalement['reportingId'] }}" data-toggle="modal"
                                                    data-target="#confirmationModal">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{-- <p>Place Name: <span id="place-name"></span></p> --}}

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Signalement valider --}}
    <div class="container-fluid hidden tableau tableau4">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5"><b><i>Liste des signalements validés</i></b></h3>

            <div class="mt-2">
                {{-- <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('signalement.create')}}" type="button" class=" btn btn-primary">Ajouter un signalement</a></div>

            </div> --}}

                <br>
                @if (session()->has('successDelete'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                        </button>
                        <h5>{{ session()->get('successDelete') }}</h5>


                    </div>
                @endif


                <div class="row">
                    <div class="box">
                        <!-- <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div> -->
                        <!-- /.box-header -->
                        <div class="box-body">
                                {{-- Tout les signalements --}}
                            <table id="example3" class="table table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">Code</th>

                                        <th scope="col">Altitude</th>
                                        <th scope="col">Latitude</th>

                                        <th scope="col">Longitude</th>
                                        {{-- <th scope="col">Description</th> --}}

                                        {{-- <th scope="col">Status</th> --}}


                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($signalementsValidated as $signalement)
                                        <tr>
                                            {{-- <td>{{$loop->index +1}}</td> --}}
                                            <td>{{$signalement['uniqueCode'] }}</td>

                                            <td>{{ $signalement['altitude'] }}</td>
                                            <td>{{ $signalement['latitude'] }}</td>
                                            <td>{{ $signalement['longitude'] }}</td>
                                            {{-- <td>{{$signalement['description']}}</td> --}}
                                            {{-- <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td> --}}

                                            <td>
                                                {{-- {{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}} --}}

                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                <a href="{{ route('signalement.detail', ['reportingId' => $signalement['reportingId']]) }}"
                                                    type="button" class="btn btn-success"><i
                                                        class="bi bi-eye-fill"></i></a>


                                                <button type="button" class="btn btn-danger"
                                                    data-key="{{ $signalement['reportingId'] }}" data-toggle="modal"
                                                    data-target="#confirmationModal">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{-- <p>Place Name: <span id="place-name"></span></p> --}}

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div id="map"></div>


    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('signalement.supprimer') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Confirmation de suppression</b></h4>
                    </div>
                    <div class="modal-body m-3">
                        <p class="mb-0">Voulez vous vraiment supprimer ce signalement ?</p>
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



    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclure la bibliothèque Mapbox GL JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {



            $('.voir5').on('click', function(e) {
                e.preventDefault()
                $('#detailModal5').modal('show')
                //alert("Ouverture du formulaire d'inscription")


            });
        });
    </script>

    <script>
        // Effectuer une requête AJAX vers ton contrôleur pour récupérer les informations de géocodage inversé
        $.ajax({
            url: {{ route('signalement') }},
            method: 'GET',
            success: function(response) {
                var latitude = response.latitude;
                var longitude = response.longitude;
                var description = response.description;
                // Récupère les autres informations nécessaires depuis la réponse

                // Initialise la carte Mapbox
                mapboxgl.accessToken =
                    'pk.eyJ1IjoiY2hyaXNzMzEiLCJhIjoiY2xpMW5hYjB6MGltYzNkbzRtYXBtbTJkdCJ9.QaO5C25ul0-5dzBxL6nf1w';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [longitude, latitude],
                    zoom: 12
                });

                // Ajoute un marqueur pour la position spécifiée
                new mapboxgl.Marker()
                    .setLngLat([longitude, latitude])
                    .addTo(map);

                // Affiche les autres informations dans ta vue
                $('#place-name').text(description);
                // Affiche les autres informations où tu souhaites les afficher
            },
            error: function() {
                // Gère les erreurs de la requête AJAX
            }
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
    function afficherTableau(classe) {
        // Masquez tous les tableaux
        const tableaux = document.querySelectorAll('.tableau');
        tableaux.forEach(tableau => {
            tableau.classList.add('hidden');
        });

        // Affichez uniquement le tableau spécifique
        const tableau = document.querySelector('.' + classe);
        if (tableau) {
            tableau.classList.remove('hidden');
        }
    }
</script>





@endsection
