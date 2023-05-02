@extends("layouts.master")

@section("contenu")

<div class="card" style="margin:20px;">

    <div class="card-header">Détail d'un admin</div>
    <div class="card-body">
        <div class="card-body">

        </div>


    </div>

</div>

<table class="table table-bordered"  style="width:100%">
        
        <tbody>
        
            <tr>
                <th scope="col">Nom</th>
                <td>{{$administrateur['firstname']}}</td>
            </tr>
            <tr>
                <th scope="col">Prénoms</th>
                <td>{{$administrateur['lastName']}}</td>
            </tr>
            <tr>
            <th scope="col">Email</th>
                <td>{{$administrateur['matricule']}}</td>
            </tr>
            <tr>
            <th scope="col">Rôle</th>
                <td>{{admin}}</td>
            </tr>
           
        </tbody>
</table> 

@endsection