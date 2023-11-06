<div class="row">
    <div class="box">
        <div class="box-body">
            <table id="example" class="table table-bordered table-striped example">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Commune</th>
                        <th scope="col">Département</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($communes as $commune)
                        <tr>
                            <td>{{$commune['code']}}</td>
                            <td>{{$commune['name']}}</td>
                            <td>{{$commune['solidwaistDepartment']['name']}}</td> 
                            <td>
                                <a href="{{route('commune.edit', ['commune'=>$commune['municipalityId'] ] )}}" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-danger" data-key="{{ $commune['municipalityId'] }}" data-toggle="modal" data-target="#confirmationModal">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
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
