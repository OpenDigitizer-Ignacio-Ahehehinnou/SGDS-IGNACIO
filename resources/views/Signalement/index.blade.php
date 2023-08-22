
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des signalements</h3>
        
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->
            
                    <a href="{{ route ('signalement.create')}}" type="button" class=" btn btn-primary">Ajouter un signalement</a></div>

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
               
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Altitude</th>
                            <th scope="col">Latitude</th>

                            <th scope="col">Longitude</th>
                            <th scope="col">Description</th>
                           
                            <th scope="col">Status</th>
                           
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($signalements as $signalement)
                        <tr>
                            {{-- <td>{{$loop->index +1}}</td> --}}
                            <td>{{$signalement['altitude']}}</td>
                            <td>{{$signalement['latitude']}}</td>
                             <td>{{$signalement['longitude']}}</td> 
                            <td>{{$signalement['description']}}</td>
                            <td>{{$signalement['status']}}</td>
                            {{-- <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td> --}}
                          
                            <td>
                                {{-- {{ route( 'admin.supprimer', ['administrateur'=>$administrateur['userId']])}} --}}
                               
                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                    <a href="{{route( 'signalement.detail', ['reportingId'=>$signalement['reportingId']])}}" type="button" class="btn btn-success"><i class="bi bi-eye-fill"></i></a>
                                    <!-- <a href="{{route('signalement.edit', ['signalement'=>$signalement['reportingId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a> -->
                                    <a type="button" class="btn btn-danger" onclick="if(confirm('voulez-vous supprimer cet Entreprise ???')){
                                        document.getElementById('form-{{$signalement['reportingId']}}').submit() }"><i class="bi bi-trash3-fill"></i></a>

                                        <form id="form-{{$signalement['reportingId']}}" action="{{ route( 'signalement.supprimer', ['signalement'=>$signalement['reportingId']])}}" method="post">
                                            @csrf
                                                <input type="hidden" name="_method" value="delete">
                                        </form>
                                {{-- </div> --}}


                            </td>

                        </tr>
                    @endforeach
                        
                    
                    </tbody>
                    
                </table>
                <p>Place Name: <span id="place-name"></span></p>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div id="map"></div>



         <!-- Modal -->
         <div class="modal fade" id="detailModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header " style="background-color:#69B42D; color:white;">
                        <h2  class="modal-title" id="exampleModalLabel">Détails sur signalement</h2>
                    </div>
                    <div class="modal-body">

                    <table class="table table-bordered" >
                        <tbody>
                        <tr>
                            
                            <th>Altitude</th>
                            <td>{{$signalement['altitude']}}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{$signalement['latitude']}}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{$signalement['longitude']}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$signalement['description']}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$signalement['status']}}</td>
                        </tr>
                        <tr>
                            <th>Photo</th>
                        <td> <img src="{{ $signalement['photo'] }}"width="300" height="200" 200px; alt="Ma photo"></td>

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



       <!-- Inclure jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Inclure la bibliothèque Mapbox GL JS -->
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet" />

        <script>

        $(document).ready(function () {
           
            

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
        url: {{ route('signalement')}},
        method: 'GET',
        success: function(response) {
            var latitude = response.latitude;
            var longitude = response.longitude;
            var description = response.description;
            // Récupère les autres informations nécessaires depuis la réponse

            // Initialise la carte Mapbox
            mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXNzMzEiLCJhIjoiY2xpMW5hYjB6MGltYzNkbzRtYXBtbTJkdCJ9.QaO5C25ul0-5dzBxL6nf1w';
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




@endsection
