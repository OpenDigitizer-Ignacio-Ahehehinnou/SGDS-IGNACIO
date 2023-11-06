@extends("layouts.master")

@section("contenu")

<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">

    <div class="panel panel-default">
        <h1 class="panel-heading">Détail de l'entreprise</h1>
    
        
            <div class="panel-body">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Zone</th>
                            <th scope="col">Gérant</th>
                            <th scope="col">Ifu</th>


                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($entreprises as $entreprise) --}}
    <tr>
        <td>
            @foreach($entreprises['listOfSolidwaistDistrict'] as $district)
                {{ $district['name'] }},
            @endforeach 
        </td>
        <td>{{$entreprises['manager']}}</td>
        <td>{{$entreprises['ifu']}}</td>
    </tr>
{{-- @endforeach --}}

                    </tbody>
                    
                </table>
                
                

</div>
<div class="col-md-2"></div>
</div></div>
</div>


@endsection