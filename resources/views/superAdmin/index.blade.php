@extends("layouts.master")

@section("contenu")

<div class="container-fluid">
    <div class="my-3 p-3 mt-5 bg-body rounded shadow-sm">
        <h3 class="border-bottom pb-2 mb-5">Liste des super admins</h3>

        <div class="mt-2">
            <div class="d-flex justify-content-between mb-2">
                <!-- la pagination sans oublier code bootstrap dans provider(AppServiceProvider) -->

                <a href="{{ route ('superAdmin.create')}}" type="button" class=" btn btn-primary">Ajouter un super admin
                </a>
            </div>

        </div>
        <br>

        @if(session()->has("success"))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
            <h5>{{session()->get('success')}}</h5>


        </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>

                @endforeach
            </ul>
        </div>
        @endif

        <div id="msg200"></div>

        @if(session()->has("successDelete"))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 30px;">&times;</span>
            </button>
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
                                <th>Nom & prénoms</th>
                                <th>Matricule(s)</th>
                                <th> Téléphone</th>
                                {{-- <th>Rôle</th> --}}
                                <th>Adresse</th>
                                {{-- <th>deletedFlag</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($superAdmin as $collecteur)


                            <tr>
                                <td>{{$collecteur['firstName']}} {{$collecteur['lastName']}}</td>
                                <td>{{$collecteur['matricule']}}</td>
                                <td>{{$collecteur['telephone']}}</td>
                                {{-- <td>{{$collecteur['roleModel']['libelle']}}</td> --}}
                                <td>{{$collecteur['adress']}}</td>
                            
                                <td>


                                    {{-- <div class="btn-group" role="group" aria-label="Basic outlined example"> --}}

                                        {{-- <button type="button" class="btn btn-success voir2"><i
                                                class="bi bi-eye-fill"></i></button> --}}

                                        <a href="{{route('superAdmin.edit', ['superAdmin'=>$collecteur['userId'] ] )}}"
                                            type="button" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i></a>


                                                {{-- <button type="button" class="btn btn-danger supprimerEntreprise2" data-key="{{ $collecteur['userId'] }}" data-toggle="modal" data-target="#confirmationModal2">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                         --}}

                                </td>

                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $superAdmin->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


    </div>
</div>
</div>

{{-- modal pour supprimer un superviseur  --}}
<div class="modal fade" id="confirmationModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Voulez-vous vraiment supprimer ce super admin?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button type="button" class="btn btn-danger confirm-delete2">Oui</button>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
 
{{--  Supprimer un superviseur --}}
<script>
    $(document).ready(function (e) {
        $('.confirm-delete2').on('click', function(e) {
            e.preventDefault();
            var id = $('.supprimerEntreprise2').attr('data-key');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ route('superAdmin.supprimer') }}";
            var data = {
                _token: csrfToken,
                id: id
            };
            //$('#confirmationModal2').modal('hide');

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (response) {
                    if (parseInt(response) == 200 || parseInt(response) == 500) {
                        if (parseInt(response) == 500) {
                            $("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                                <strong>Une erreur s'est produite</strong> veuillez réessayer.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>`);
                        } else {
                            $('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                                <strong>Super admin supprimé avec succès</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>`);
                        }
                    }

                    var url = "{{ route('superAdmin') }}";
                    if (response == 200) {
                        setTimeout(function () {
                            window.location = url;
                        }, 1000);
                    } else {
                        $("#msg200").html(response);
                    }
                }
            });
        });
    });
</script>




@endsection