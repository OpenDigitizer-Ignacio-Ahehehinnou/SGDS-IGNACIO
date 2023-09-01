@extends("layouts.master")


@section("contenu")

<style>
    body { margin: 0; padding: 0; }
    #map { height: 400px; }
</style>

<h3>Détail sur un signalement</h3>
<div class="row ">
    <div class="box">
        <!-- <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
        </div> -->
            <!-- /.box-header -->
        <div class="box-body">
<table class="table table-bordered" >
    <tbody>
        <tr>
        
            <th>Code</th>
            <td>{{$signalements['uniqueCode']}}</td>
        </tr>
    <tr>
        
        <th>Altitude</th>
        <td>{{$signalements['altitude']}}</td>
    </tr>
    <tr>
        <th>Latitude</th>
        <td>{{$signalements['latitude']}}</td>
    </tr>
    <tr>
        <th>Longitude</th>
        <td>{{$signalements['longitude']}}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{$signalements['description']}}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{$signalements['status']}}</td>
    </tr>
    <tr>
        <th>Photo</th>
    <td> <img src="{{ $signalements['photo'] }}"width="700" height="300" 200px; alt="Ma photo"></td>

    </tr>
    </tbody>

</table>

        </div>
    </div></div>

    <div id='map'></div>

    


    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2hyaXNzMzEiLCJhIjoiY2xpMW5hYjB6MGltYzNkbzRtYXBtbTJkdCJ9.QaO5C25ul0-5dzBxL6nf1w'; // Remplacez par votre propre jeton d'accès Mapbox

        var latitude = {{$signalements['latitude']}};
        var longitude = {{$signalements['longitude']}};

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