@extends('layouts.master')


@section('contenu')
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            height: 400px;
        }
    </style>
    <style>
        .carre {
            width: 380px; /* Largeur */
            height: 250px; /* Hauteur */
            object-fit: cover; /* Pour maintenir l'aspect carré et couper l'excédent si nécessaire */
        }

        /* Style pour le tableau */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        /* Style pour l'en-tête de tableau */
        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        /* Style pour les lignes impaires du tableau */
        tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Style pour les cellules du tableau */
        td, th {
            padding: 10px;
            border: 1px solid #ddd;
        }

             /* Style pour le modal carré */
            .modal-square {
                max-width: 500px; /* Largeur maximale du modal (ajustez selon vos besoins) */
                margin: 0 auto; /* Centrez le modal horizontalement */
                height: 500px !important; /* Hauteur du modal (ajustez selon vos besoins) */
            }

            /* Style pour l'image dans le modal */
            .modal-image {
                width: 100%;
                height: 100%;
                object-fit: contain; /* Ajustez la mise en forme de l'image (contain, cover, etc.) */
            }
            /* police tableau */
            .custom-text {
        font-family: 'Roboto', sans-serif;
        }
    </style>
    

    <h3><b>Détail sur un signalement</b></h3><br>
   
    <div class="container mt-5">
        <div class="row">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Image cliquable pour agrandissement -->
                        <a href="#" data-toggle="modal" data-target="#imageModal">
                            <img src="{{ $signalements['photo'] }}" width="150" height="100" title="cliquer pour agrandir l'image" alt="Image d'exemple" class="img-fluid carre">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <!-- Informations -->
                        <table class="table table-bordered table-custom">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Informations</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Code</td>
                                    <td>{{ $signalements['uniqueCode'] }}</td>
                                </tr>
                                <tr>
                                    <td>Altitude</td>
                                    <td>{{ $signalements['altitude'] }}</td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td>{{ $signalements['latitude'] }}</td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td>{{ $signalements['longitude'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $signalements['status'] }}</td>
                                </tr>

                                <tr>
                                    <td>Date/Heure</td>
                                    <td>{{ \Carbon\Carbon::parse($signalements['createdAt'])->format('d-m-Y à H\Hi') }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $signalements['description'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
            <br><br><br>

    <!-- Fenêtre modale pour agrandir l'image -->
    <div class="modal fade bd-example-modal-lg" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
    
                <div class="modal-body">
                    <img src="{{ $signalements['photo'] }}" class="img-fluid modal-image" alt="Image agrandie">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    

    <div id='map'></div>




    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        mapboxgl.accessToken =
        'pk.eyJ1IjoiY2hyaXNzMzEiLCJhIjoiY2xpMW5hYjB6MGltYzNkbzRtYXBtbTJkdCJ9.QaO5C25ul0-5dzBxL6nf1w'; // Remplacez par votre propre jeton d'accès Mapbox

        var latitude = {{ $signalements['latitude'] }};
        var longitude = {{ $signalements['longitude'] }};

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [longitude, latitude],
            zoom: 12
        });

        var marker = new mapboxgl.Marker()
            .setLngLat([longitude, latitude])
            .addTo(map);
    </script>
@endsection
