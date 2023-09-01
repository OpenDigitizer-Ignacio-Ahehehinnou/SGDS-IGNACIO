@extends("layouts.master")

@section("contenu")

<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">

    <div class="panel panel-default">
        <div class="panel-heading">Zone liée a l'entreprise</div>
    
        
            <div class="panel-body">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Zone</th>
                            <th scope="col">Villes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($zones as $zone)
                        <tr>
                            <td>{{$zone['nom']}}</td>
                            <td>{{$zone['cityModel']['nom']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                

</div>
<div class="col-md-2"></div>
</div></div>
</div>


@endsection