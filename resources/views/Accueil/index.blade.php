@extends("layouts.master")


@section("contenu")

<style>

    .carousel-caption {
      background-color: rgba(0, 0, 0, 0.5);
      bottom: 310px;
      left: 0;
      padding: 20px;
      position: absolute;
      right: 0;
    }

    .carousel-caption h3, .carousel-caption p {
      color: #fff;
      margin: 0;
    }

</style>

            <!-- Main content -->
    <section class="content">

        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{ $countAdmin }}</h3>

                <p>Administrateur</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin')}}" class="small-box-footer">Liste des administrateurs <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $countSupervisor }}<sup style="font-size: 20px"></sup></h3>

                <p>Superviseurs</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('superviseur')}}" class="small-box-footer">Liste des superviseurs <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ $countCollector }}</h3>

                <p>Collecteurs</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('collecteur')}}" class="small-box-footer">Liste des collecteurs <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $countSignalement }}</h3>

                <p>Signalement</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('signalement')}}" class="small-box-footer">Voir signalement <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      
        
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="img/2.jpg" alt="Image 1">
              <div class="carousel-caption text-center">
                <h3>Mettre le developpement durable au coeur de nos actions</h3>
                
              </div>
            </div>

            <div class="item">
              <img src="img/1.jpg" alt="Image 2">
              <div class="carousel-caption text-center">
                <h3>Améliorer le cadre se vie et le bien-être de la population</h3>
                
              </div>
            </div>

            <div class="item">
              <img src="img/3.jpeg" alt="Image 3">
              <div class="carousel-caption text-center">
                <h3>
                Une démarche innovante de gestion des déchets au Bénin
                </h3>
              
              </div>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>


    </section>




@endsection