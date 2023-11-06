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

      @if($role == 12)

        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{ $countEntreprisesA }}</h3>

                <p>Active</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="" class="small-box-footer">Liste des entreprises actives <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $countEntreprisesI }}<sup style="font-size: 20px"></sup></h3>

                <p>Inactive</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="" class="small-box-footer">Liste des entreprises inactive <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ $countArrondissementA }}</h3>

                <p> Active</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="" class="small-box-footer">Liste des arrondissements actives <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $countArrondissementI }}</h3>

                <p>Inactive</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="" class="small-box-footer">Liste des arrondissements inactive <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      @endif

      @if($role == 8 || $role==7)

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $countAdmin }}</h3>

              <p>Admins</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}" class="small-box-footer">Liste des administrateurs <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $countSuperviseur }}<sup style="font-size: 20px"></sup></h3>

              <p>Superviseurs</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}" class="small-box-footer">Liste des superviseurs <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $countCollecteur }}</h3>

              <p> Collecteurs</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.detail', ['entreprise' => $entreprise]) }}" class="small-box-footer">Liste des collecteurs<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $countSignaler }}</h3>

              <p>Déchets gérés</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('signalement.detail', ['entreprise' => $entreprise]) }}" class="small-box-footer">Liste des déchets signaler <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    @endif
   
        
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