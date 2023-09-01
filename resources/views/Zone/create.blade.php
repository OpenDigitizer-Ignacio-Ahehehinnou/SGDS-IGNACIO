@extends("layouts.master")


@section("contenu")

@if(session()->has("success"))
<div class="alert alert-success">
    <h5>{{session()->get('success')}}</h5>
</div>
@endif


        @if($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach($errors->all() as $error)
                <h5>{{$error}}</h5>
    
                @endforeach
            </ul>
        </div>
        @endif

<br><br>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">

    <div class="panel panel-default">
        <div class="panel-heading">Ajouter une zone</div>


        <div class="panel-body">

            <div id="msg200"></div>
        <form method="post" action="{{ route('zone.ajouter')}}">
            @csrf
            {{-- <input type="text" class="form-control" id="nom" name="userId" value="31" hidden="hidden"> --}}

            <button type="button" class="btn btn-success voir" title="Ajouter les points"><i
                    class="bi bi-plus"></i></button>

            <br><br>

            <div class="row ">
                <div class="mb-3 col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Zone</label>
                    <input type="text" class="form-control" required="true" id="nom" name="nom" style="border-radius: 10px;">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="exampleInputPassword1" class="form-label">Ville</label>
                    <select class="form-control" id="ville" required="true" name="ville" style="border-radius: 10px;">

                        @foreach ($villes as $ville )

                        <option value="{{$ville['cityId']}}">{{$ville['nom']}}</option>

                        @endforeach

                    </select>
                </div>
            </div>


            <div class="row" hidden>

                <div class="mb-3 col-md-6">
                    <label for="exampleInputPassword1" class="form-label">creatorUsername</label>

                    <input type="text" class="form-control" id="creatorUsername" value="Ignacio" name="creatorUsername">

                </div>

                <div class="mb-3 col-md-6">
                    <label for="activationStatus" class="form-label">createdAt</label>
                    <input type="text" class="form-control" id="creatorId" value="2023-08-02T11:37:47.544+00:00"
                        name="createdAt">
                </div>


            </div>

            <div class="row" hidden>

                <div class="mb-3 col-md-6">
                    <label for="activationStatus" class="form-label">Creator Id</label>
                    <input type="text" class="form-control" id="creatorId" value="1" name="creatorId">
                </div>


                <div class="mb-3 col-md-6">
                    <label for="deletedFlag" class="form-label">deletedFlag</label>
                    <input type="text" class="form-control" value="S" id="deletedFlag" name="deletedFlag">
                </div>

            </div>

                <br><br>

                <input type="hidden" name="tableauDonnees" id="tableauDonnees" value="">

            
            <table id="infoTable" class="table">
                <thead>
                    <tr>
                        <th>Altitude</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Ordre</th>
                    </tr>
                </thead>
                <tbody >
                    <!-- Les données du formulaire seront affichées ici -->

                </tbody>
            </table>
            <br>
            <div>
                <div id="msg20"></div>
                <button type="submit" id="envoyerDonnees" class="btn btn-success">Enregistrer</button>
            </div>



        </form>
    </div>


    
<div class="col-md-2"></div>
    </div></div>

</div>




{{-- Modal pour point --}}

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header " style="background-color:#69B42D; color:white;">
                <h4 class="modal-title" id="exampleModalLabel">Ajouter les points</h4>
            </div>
            <div class="modal-body">


                <form action="/enregistrer" method="POST">
                    @csrf
                    <!-- Protection contre les attaques CSRF -->

                    <!-- Champs du formulaire -->

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nom">Altitude :</label>
                            <input type="text" class="form-control" required="true" id="altitude" name="altitude"
                                style="border-radius:10px;">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="prenom">Longitude :</label>
                            <input type="text" class="form-control" required="true" id="longitude" name="longitude"
                                style="border-radius:10px;">
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="prenom">Latitude :</label>
                            <input type="text" class="form-control" required="true" id="latitude" name="latitude"
                                style="border-radius:10px;">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="prenom">Ordre :</label>
                            <input type="text" class="form-control" required="true" id="ordre" name="ordre"
                                style="border-radius:10px;">
                        </div>
                    </div>


                    <!-- Ajoutez d'autres champs ici -->

                    <!-- Bouton de soumission du formulaire -->
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div> --}}
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.4.js"></script>

<script>
    $(document).ready(function () {
        $('.voir').on('click', function(e) {
            e.preventDefault()
            $('#detailModal').modal('show')
            //alert("Ouverture du formulaire d'inscription")
            
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Lorsque le formulaire du modal est soumis
        $("form").submit(function (e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire

            // Récupérer les valeurs des champs du formulaire
            var altitude = $("#altitude").val();
            var longitude = $("#longitude").val();
            var latitude = $("#latitude").val();
            var ordre = $("#ordre").val();

            // if(altitude =="" || longitude=="" || ordre=="" || latitude==""){

            //     $('#msg20').html(` <p  class="text-danger">
            //     <b>Les champs (altitude,longitude,latitude,ordre) ne peuvent pas êtes vide...</b>
            //                 </p>`);
            //     //$('#confirm_password').css("border","2px solid red");
            // }

            // Créer une nouvelle ligne dans le tableau avec les valeurs récupérées
            var newRow = $("<tr>");
            newRow.append("<td>" + altitude + "</td>");
            newRow.append("<td>" + longitude + "</td>");
            newRow.append("<td>" + latitude + "</td>");
            newRow.append("<td>" + ordre + "</td>");

            // Ajouter la nouvelle ligne au tableau
            $("#infoTable tbody").append(newRow);

            // Réinitialiser les champs du formulaire
            $("#altitude").val("");
            $("#longitude").val("");
            $("#latitude").val("");
            $("#ordre").val("");
        });

        $('#altitude').on('input', function(e) {
            var inputVal = $(this).val();
            var onlyNumbers = inputVal.replace(/\D/g, ''); // Utilisez /\D/g pour supprimer tout ce qui n'est pas un chiffre
            $(this).val(onlyNumbers);
        });
        $('#longitude').on('input', function(e) {
            var inputVal = $(this).val();
            var onlyNumbers = inputVal.replace(/\D/g, ''); // Utilisez /\D/g pour supprimer tout ce qui n'est pas un chiffre
            $(this).val(onlyNumbers);
        });
        $('#latitude').on('input', function(e) {
            var inputVal = $(this).val();
            var onlyNumbers = inputVal.replace(/\D/g, ''); // Utilisez /\D/g pour supprimer tout ce qui n'est pas un chiffre
            $(this).val(onlyNumbers);
        });
        $('#ordre').on('input', function(e) {
            var inputVal = $(this).val();
            var onlyNumbers = inputVal.replace(/\D/g, ''); // Utilisez /\D/g pour supprimer tout ce qui n'est pas un chiffre
            $(this).val(onlyNumbers);
        });

    });
</script>

<script>
    $(document).ready(function () {
        // Lorsque le bouton "Envoyer" est cliqué
        $("#envoyerDonnees").click(function () {
            // Récupérez les données du tableau en tant qu'objet JSON
            var tableauDonnees = [];
            $("#infoTable tbody tr").each(function () {
                var altitude = $(this).find("td:eq(0)").text();
                var longitude = $(this).find("td:eq(1)").text();
                var latitude = $(this).find("td:eq(2)").text();
                var ordre = $(this).find("td:eq(3)").text();

                tableauDonnees.push({
                    altitude: altitude,
                    longitude: longitude,
                    latitude: latitude,
                    ordre: ordre
                });
            });
           // alert(altitude)

            // Récupérez les données des champs "nom" et "ville"
            var nom = $("#nom").val();
            var ville = $("#ville").val();
            // Récupérer le jeton CSRF depuis la balise meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //alert(tableauDonnees)
            // Créez un objet JSON contenant toutes les données
            var donneesAEnvoyer = {
                _token: csrfToken,
                nom: nom,
                ville: ville,
                tableauDonnees: tableauDonnees
            };

            if(altitude =="" || latitude==""){

                $('#msg20').html(` <p  class="text-danger">
                <b>Les champs (zone, ville) ne peuvent pas êtes vide...</b>
                            </p>`);
                //$('#confirm_password').css("border","2px solid red");
            }else{


                // Envoyez les données au contrôleur via une requête AJAX
                $.ajax({
                    type: "POST",
                    url: "{{ route('zone.ajouter')}}",
                    data: donneesAEnvoyer,
                    success: function (response) {

                        if(parseInt(response)==200 || parseInt(response)==500){
                            
                            parseInt(response)==500?($("#msg200").html(`<div class='alert alert-danger text-center' role='alert'>
                                <strong>Une erreur s'est produite</strong> veuillez réessayez.
                                
                                </div>`)
                            ):($('#msg200').html(`<div class='alert alert-success text-center' role='alert'>
                                <strong>La zone a été ajoutée avec succès. </strong>
                                
                                </div>`)
                            ); 
                        }
                        
                        var url="{{route('zone')}}" 
                        if(response==200){
                            setTimeout(function(){
                                window.location=url
                            },1000) 
                        }  else{
                            $("#msg200").html(response);

                            }
                    },
                    
                });
             }
        });
    });
</script>

@endsection