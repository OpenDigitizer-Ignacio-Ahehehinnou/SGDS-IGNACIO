
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  {{-- JAI AJOUTER CECI POUR POURVOIR UTILISER JS AJAX --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SGDS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="../../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../AdminLTE/dist/css/skins/_all-skins.min.css">
<!-- Collez le code d'intégration de Google Fonts ici -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->


  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <!-- Google Font -->


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />

<style>
.menu ul {
  list-style-type: none;
  padding: 0;
}

.menu li {
  /* background-color: white; */
  margin: 0;
  position: relative;
}

.menu a {
  display: block;
  text-decoration: none;
  color: black;
  padding: 10px 20px;
}

.menu a:hover {
  background-color: black;
  color: white;
}

.menu ul ul {
  display: none;
  background-color: black;
  position: absolute;
  top: 0;
  left: 100%;
}

.menu li:hover > ul {
  display: block;
}

</style>


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="{{route('accueil')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SGDS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SGDS</b></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
		  <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">




          <!-- User Account Menu -->
          <li class="dropdown user user-menu connexion">
            <!-- Menu Toggle Button -->
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6 " class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->

          @if ($role== 8)  
              <span class="hidden-xs">ADMIN</span>
            @elseif($role==12)
            <span class="hidden-xs">SUPER ADMIN</span>
            @else
            <span class="hidden-xs">ADMIN_MANAGER</span>

            @endif


            </a>
            <ul class="dropdown-menu oui">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6 " class="img-circle" alt="User Image">

                <p>
                  {{ $nom }} {{ $prenom }} <br>

                </p>
              </li>


              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{route('profil')}}" class="btn btn-default btn-flat">Profil</a>
                <!-- </div>
                <div class="pull-center"> -->
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Déconnexion</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
		</nav>
	</header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">





      

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://firebasestorage.googleapis.com/v0/b/odgds-fac56.appspot.com/o/supervisor_profile_test%2F1693389761675_IMG-20230830-WA0008.jpg?alt=media&token=6792a939-2ebc-432a-bd48-f0f0b56a37b6" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info"><br>
          <p>{{ $nom }} {{ $prenom }}</p>
          <!-- Status -->
          {{-- <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a> --}}
        </div>
      </div>

      <!-- search form (Optional) -->
       {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="recherche...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>  --}}
      <!-- /.search form -->
<br><br>
      <!-- Sidebar Menu -->
      {{-- {{ $entreprise }} --}}
      <ul class="sidebar-menu" data-widget="tree">

        <li class="active"><a href="{{route ('accueil') }}"><i class="fa fa-dashboard"></i> <span>Accueil</span></a></li>
        {{-- <li><a href="{{ route('superAdmin')}} "><i class="fa  fa-users"></i> <span>Super admin</span></a></li> --}}
        @if ($role == 8)

        <li><a href="{{ route('admin') }}"><i class="fa  fa-users"></i> <span>Entreprises</span></a></li>
        
          {{-- <li><a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}"><i class="fa  fa-users"></i> <span>Superviseurs</span></a></li>
          <li><a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}"><i class="fa  fa-users"></i> <span>Superviseurs</span></a></li>
        <li><a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}"><i class="fa  fa-users"></i> <span>Collecteurs</span></a></li> --}}

        
        {{-- <li><a href="{{ route('signalement.detail', ['entreprise' => $entreprise]) }}"><i class="fa fa-link"></i> <span>Signalements</span></a></li> --}}
        @endif

        @if ($role == 7)

          <li><a href="{{ route('admin') }}"><i class="fa  fa-users"></i> <span>Entreprises</span></a></li>
        
      
        @endif

      
       
        @if ($role == 12)
          {{-- <li><a href="{{ route('entreprise')}}"><i class="fa fa-university"></i> <span>Entreprises</span></a></li> --}}
          <li><a href="{{ route('admin') }}"><i class="fa  fa-users"></i> <span>Entreprises</span></a></li>

          <div class="menu">
            <ul>
              <li><a href="#"><i class="fa  fa-users"></i>Paramètre 1</a>
                <ul>
                  <li><a href="{{route('departement')}}">Départements</a></li>
                  <li><a href="{{route('commune')}}">Communes</a></li>
                  <li><a href="{{route('arrondissement')}}">Arrondissement</a></li>
                  <li><a href="{{route('quartier')}}">Quartiers</a></li>
  
                </ul>
              </li>
              <li><a href="#"><i class="fa  fa-users"></i>Paramètre 2</a>
                <ul>
                  <li><a href="{{route('categorie')}}">Catégorie déchet</a></li>
                  <li><a href="{{route('role')}}">Rôle</a></li>
                </ul>
              </li>
  
              <li><a href="#"><i class="fa  fa-users"></i>Paramètre 3</a>
                <ul>
                  <li><a href="{{route('superAdmin')}}">SuperAdmin</a></li>
                  <li><a href="{{route('role')}}">SuperAdmin_Manager</a></li>
                </ul>
              </li>
            </ul>
          </div>
          
  

        @endif



      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield("contenu")
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
     {{-- <div class="pull-right hidden-xs">
      Anything you want
    </div>  --}}
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="#">Company</a>.</strong> OpenDigitizer
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE/dist/js/adminlte.min.js"></script>

<!-- jQuery 3 -->
<script src="../../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../AdminLTE/dist/js/demo.js"></script>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<!-- page script -->
<script>
    $(document).ready(function(){
        $('#example').DataTable({
            "pageLenght":5,
            "responsive" : true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                }
            })

            $('.connexion').on('mouseout', function(e) {
        e.preventDefault()
        $('.oui').hide();
        //alert("Ouverture du formulaire d'inscription")


    });

    $('.connexion').on('mouseover ', function(e) {
        e.preventDefault()
        $('.oui').show();
        //alert("Ouverture du formulaire d'inscription")


    });
    });
</script>
<script>
    $(document).ready(function(){
        $('#example1').DataTable({
            "pageLenght":5,
            "responsive" : true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                }
            })

            $('.connexion').on('mouseout', function(e) {
        e.preventDefault()
        $('.oui').hide();
        //alert("Ouverture du formulaire d'inscription")


    });

    $('.connexion').on('mouseover ', function(e) {
        e.preventDefault()
        $('.oui').show();
        //alert("Ouverture du formulaire d'inscription")


    });
    });
</script>
<script>
    $(document).ready(function(){
        $('#example2').DataTable({
            "pageLenght":5,
            "responsive" : true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                }
            })

            $('.connexion').on('mouseout', function(e) {
        e.preventDefault()
        $('.oui').hide();
        //alert("Ouverture du formulaire d'inscription")


    });

    $('.connexion').on('mouseover ', function(e) {
        e.preventDefault()
        $('.oui').show();
        //alert("Ouverture du formulaire d'inscription")


    });
    });
</script>
<script>
    $(document).ready(function(){
        $('#example3').DataTable({
            "pageLenght":5,
            "responsive" : true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                }
            })

            $('.connexion').on('mouseout', function(e) {
        e.preventDefault()
        $('.oui').hide();
        //alert("Ouverture du formulaire d'inscription")


    });

    $('.connexion').on('mouseover ', function(e) {
        e.preventDefault()
        $('.oui').show();
        //alert("Ouverture du formulaire d'inscription")


    });

    


    
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('.menu li').click(function(){
      $(this).find('.submenu').toggle();
    });
  });
</script>

</body>
</html>
