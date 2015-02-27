<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['user'];?>
                                    </h3>
                                    <p>Users number</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="<?php echo MODULE . 'user' . ACTION . 'seeuser'; ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['group'];?>
                                    </h3>
                                    <p>Projects number</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-map"></i>
                                </div>
                                <a href="<?php echo MODULE . 'project' . ACTION . 'seeproject'; ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['event'];?>
                                    </h3>
                                    <p>Events number</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-trophy"></i>
                                </div>
                                <a href="<?php echo MODULE . 'event' . ACTION . 'seeevent'; ?>" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['donat'];?> €
                                    </h3>
                                    <p>Donations </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cash"></i>
                                </div>
                                <a href="#" class="small-box-footer">...     </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['projetrestant'];?> 
                                    </h3>
                                    <p>Project to validate </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paperclip"></i>
                                </div>
                           <a href="#" class="small-box-footer">...     </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                        <?php echo $data['eventrestant'];?> 
                                    </h3>
                                    <p>Event to validate </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-paper-airplane"></i>
                                </div>
                                 <a href="#" class="small-box-footer">...     </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>