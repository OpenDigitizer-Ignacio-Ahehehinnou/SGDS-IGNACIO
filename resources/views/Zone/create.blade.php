@extends("layouts.master")


@section("contenu")

@if(session()->has("success"))
<div class="alert alert-success">
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

<br><br>

<div class="panel panel-default">
    <div class="panel-heading">Ajouter une zone</div>


    <div class="panel-body">


        <form method="post" action="{{ route('zone.ajouter')}}">
            @csrf
            {{-- <input type="text" class="form-control" id="nom" name="userId" value="31" hidden="hidden"> --}}

            <button type="button" class="btn btn-success voir" title="Ajouter les points"><i
                    class="bi bi-plus"></i></button>

            <br><br>

            <div class="row ">
                <div class="mb-3 col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Zone</label>
                    <input type="text" class="form-control" id="nom" name="nom" style="border-radius: 10px;">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="exampleInputPassword1" class="form-label">Ville</label>
                    <select class="form-control" id="ville" name="ville" style="border-radius: 10px;">

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

                <button type="submit" id="envoyerDonnees" class="btn btn-primary">Enregistrer</button>
                <a href="{{route('zone')}}" class="btn btn-danger">Annuler</a>
            </div>



        </form>
    </div>


    


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
                            <input type="text" class="form-control" id="altitude" name="altitude"
                                style="border-radius:10px;">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="prenom">Longitude :</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                style="border-radius:10px;">
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="prenom">Latitude :</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                style="border-radius:10px;">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="prenom">Ordre :</label>
                            <input type="text" class="form-control" id="ordre" name="ordre"
                                style="border-radius:10px;">
                        </div>
                    </div>


                    <!-- Ajoutez d'autres champs ici -->

                    <!-- Bouton de soumission du formulaire -->
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div> --}}
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
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

            // Envoyez les données au contrôleur via une requête AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('zone.ajouter')}}",
                data: donneesAEnvoyer,
                success: function (response) {
                    // Traitez la réponse du contrôleur ici
                    // Par exemple, affichez un message de confirmation
                    alert("Données envoyées avec succès !");
                    // Redirigez l'utilisateur si nécessaire
                },
                error: function (error) {
                    // Traitez les erreurs ici
                    alert(404)
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection