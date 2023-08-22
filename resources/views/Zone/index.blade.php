
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des zones</h3>
        
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                    <a href="{{ route ('zone.create')}}" type="button" class=" btn btn-primary">Ajouter une zone</a></div>

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
                                        <th>Zone</th>
                                        <th>Ville</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>


                                @foreach($zones as $zone)

                                    
                                    <tr>
                                        <td>{{$zone['nom']}}</td>
                                        <td>{{$zone['cityModel']['nom']}}</td>
                                        <td>
                                            
                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                    <a href="{{route('zone.edit', ['zone'=>$zone['zoneId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                    
                                                    <a type="button" class="btn btn-danger" onclick="if(confirm('voulez-vous supprimer cette zone ???')){
                                                        document.getElementById('form-{{$zone['zoneId']}}').submit() }"><i class="bi bi-trash3-fill"></i></a>
        
                                                        <form id="form-{{$zone['zoneId']}}" action="{{ route( 'zone.supprimer', ['zone'=>$zone['zoneId']])}}" method="post">
                                                            @csrf
                                                                <input type="hidden" name="_method" value="delete">
                                                        </form>
                                                {{-- </div> --}}
        
        
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



@endsection
