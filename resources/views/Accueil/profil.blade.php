@extends("layouts.master")


@section("contenu")



<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../../AdminLTE/dist/img/user4-128x128.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center">Ignacio Rénix</h3>

                    <p class="text-muted text-center">Administrateur</p>

                    <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <div class="tab-pane" id="">
                        <br>
                        <form class="form-horizontal">
                           <b> <h4 class="text-center">Information sur le profil</h4></b>
                                <br><br>
                            <div class="form-group">

                                <label for="inputName" class="col-sm-3 control-label">Nom</label>

                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="nom" value="ignacio rénix" placeholder="nom">
                                </div>
                                <label for="inputName" class="col-sm-2 control-label"></label>
                            </div>

                            

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-7">
                                    <input type="email" class="form-control" id="email" value="ahehehinnou31@gmail.com" placeholder="Email">
                                </div>

                                <label for="inputName" class="col-sm-2 control-label"></label>
                            </div>

                            <div class="form-group" style="margin-left:470px;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-secondary">SAUVEGARDER</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>



    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <div class="tab-pane" id="">
                <br>
                <form class="form-horizontal">
                   <b> <h4 class="text-center">Mettez à jour le mot de passe</h4></b>
                    <br><br>

                    <div class="form-group">

                        <label for="inputName" class="col-sm-3 control-label">Mot de passe</label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="prenom" placeholder=" mot de passe">
                        </div>
                        <label for="inputName" class="col-sm-2 control-label"></label>
                    </div>
                    <div class="form-group">

                        <label for="inputName" class="col-sm-3 control-label">Nouveau mot de passe</label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="prenom" placeholder="Nouveau mot de passe">
                        </div>
                        <label for="inputName" class="col-sm-2 control-label"></label>
                    </div>

                    <div class="form-group">

                        <label for="inputName" class="col-sm-3 control-label">Confirmez mot de passe</label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="prenom" placeholder="confirmez mot de passe">
                        </div>
                        <label for="inputName" class="col-sm-2 control-label"></label>
                    </div>

                
                    <div class="form-group"style="margin-left:470px;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-secondary">SAUVEGARDER</button>
                    </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
  <!-- /.col -->
</div>


  
<!-- /.row -->

</section>
  @endsection
  