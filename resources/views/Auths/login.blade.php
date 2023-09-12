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

    <form method="post" action="{{ route('handlelogin')}}">

        @csrf
        @method('POST')

        <div class="box">
            <h1 class="alert alert-success">SGDS - LOGIN </h1>

            @if(Session::get('error_msg'))

            <b style="font-size: 13px;color:red;">{{Session::get('error_msg')}}</b>

            @endif

            <div class="d-flex justify-content-center">
                <div class="mb-3">
                    <input type="text" name="username" class="email form-control" placeholder="Nom utilisateur"
                        style="border-radius: 10px;" />
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="mb-3">
                    <input type="password" name="password" class="email form-control" placeholder="Mot de passe"
                        style="border-radius: 10px;" />
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <div class="align-items-center" style="margin:auto; text-align: center;">

                    <button type="submit" class="btn btn-success btn-sm"
                        style="margin: 0 auto 20px; display: block; border-radius: 10px;padding:8px;">Connexion</button>
                    
                </div>
               
            </div>

            <div class="d-flex justify-content-start" style="margin-left: 2rem">

                <a href=""style="text-decoration: none; display: block; margin-bottom: 10px; text-align: start; font-size:10px;"class="mm">Mot de passe oublié</a>

            </div>
            <!-- End Btn -->
            <!-- End Btn2 -->
        </div>
        <!-- End Box -->
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>