<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Login-SGDS</title>
</head>

<body>


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">

    <form method="post" action="{{ route('code2')}}">

        @csrf
        @method('POST')

        <div class="box">
            <h1 class="alert alert-success">SGDS</h1>

            @if(Session::get('error_msg'))

            <b style="font-size: 13px;color:red;">{{Session::get('error_msg')}}</b><br><br>

            @endif<br>
            <h6>Veuillez saisir le code à six (06) chiffres que vous avez reçu.</h6><br>
            <div class="mb-3 d-flex justify-content-between align-items-center code-input-container">
                <input type="text" name="code1" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]"/>
                <input type="text" name="code2" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]"/>
                <input type="text" name="code3" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]"/>
                <input type="text" name="code4" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]" />
                <input type="text" name="code5" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]" />
                <input type="text" name="code6" class="form-control code-input" maxlength="1" inputmode="numeric" pattern="[0-9]"/>
                <input type="hidden" name="username" value="{{$username}}"/>
               

            </div>



            <div class="d-flex align-items-center">
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="border-radius: 10px; margin-right:80px;">Annuler</a>
                <a href="" class="btn btn-warning btn-sm" style="border-radius: 10px;margin-right:10px">Réinitialiser</a>
                <button type="submit" class="btn btn-success btn-sm" style="border-radius: 10px;">Valider</button>
            </div>




        </div>
        <!-- End Box -->
    </form>

<style>
    .code-input-container {
    display: flex;
    /* justify-content: space-between; */
    margin: 0 10px; /* Ajustez la valeur de la marge selon vos préférences */
    }

    .code-input {
        width: 50px; /* Vous pouvez ajuster la largeur des carrés selon vos préférences */
        text-align: center; /* Pour centrer le contenu dans les carrés */
    }




</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script>
        // Sélectionnez tous les champs d'entrée par leur classe
const codeInputs = document.querySelectorAll('.code-input');

// Ajoutez un gestionnaire d'événement pour chaque champ
codeInputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        // Remplacez tout caractère non numérique par une chaîne vide
        e.target.value = e.target.value.replace(/[^0-9]/g, '');

        // Déplacez automatiquement le focus vers le champ suivant s'il est rempli
        if (e.target.value && index < codeInputs.length - 1) {
            codeInputs[index + 1].focus();
        }
    });
});

    </script>

</body>

</html>
