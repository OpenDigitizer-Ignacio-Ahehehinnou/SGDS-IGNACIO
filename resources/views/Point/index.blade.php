
@extends("layouts.master")


@section("contenu")


    <div class="container-fluid">
        <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-5">Liste des points</h3>
        
            <div class="mt-2">
                <div class="d-flex justify-content-between mb-2">
                    <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                    <a href="{{ route ('point.create')}}" type="button" class=" btn btn-primary">Ajouter un point</a></div>

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
                                        <th>Code</th>
                                        <th>Ville</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>


                                @foreach($points as $point)

                                    
                                    <tr>
                                        <td>{{$point['code']}}</td>
                                        <td>{{$point['nom']}}</td>
                                        <td>
                                            
                                                {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}
                                                    <a href="{{route('ville.edit', ['ville'=>$ville['cityId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                    
                                                    <a type="button" class="btn btn-danger" onclick="if(confirm('voulez-vous supprimer cette ville ???')){
                                                        document.getElementById('form-{{$ville['cityId']}}').submit() }"><i class="bi bi-trash3-fill"></i></a>
        
                                                        <form id="form-{{$ville['cityId']}}" action="{{ route( 'ville.supprimer', ['ville'=>$ville['cityId']])}}" method="post">
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
