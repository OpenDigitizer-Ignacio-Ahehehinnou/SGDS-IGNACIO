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

    <form method="post" action="{{ route('profil.username2')}}">

        @csrf
        @method('POST')

        <div class="box">
            <h1 class="alert alert-success">SGDS </h1>

            @if(Session::get('error_msg'))

            <b style="font-size: 13px;color:red;">{{Session::get('error_msg')}}</b><br><br>

            @endif
            <h6>Veuillez entrer votre nom d'utilisateur</h6>
            <div class="d-flex justify-content-center">
                <div class="mb-3">
                    <input type="text" name="username" class="email form-control" placeholder="Nom utilisateur"
                        style="border-radius: 10px;" />
                </div>
            </div>


            <div class="">
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="border-radius: 10px;margin-right: 170px;">Annuler</a>
                <button type="submit" class="btn btn-success btn-sm" style="border-radius: 10px;">Générer code</button>
            </div>


        </div>
        <!-- End Box -->
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>
