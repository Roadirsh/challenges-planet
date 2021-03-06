<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admins <small>(<?php echo count($data); ?>)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <?php if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
        	<div class="box span13" >
        		<div class="box-content box-info">
        			<ul class="dashboard-list admin">
        			<?php foreach($data as $k => $AllTeam){ ?>
        			<?php // var_dump($AllTeam); ?>
        				<li>
        					<a href="#">
                                <?php if(!empty($AllTeam['user_profil_pic'])){ ?>
            				        <img class="avatar" alt="Dennis Ji" src="images/avatar/<?php echo $AllTeam['user_profil_pic']; ?>">
                                <?php } else { ?>
            				        <img class="avatar" alt="Dennis Ji" src="images/avatar/default.png"> 
                                <?php } ?> 
        					</a>
        					<strong>Pseudo:</strong> <a href="#"><?php echo $AllTeam['user_pseudo']; ?></a><br>
        					<span class="admin_status">
            					<strong>Status:</strong> 
            				    <?php if($AllTeam['user_super_admin'] == 1){ ?>
            					    <span class="label label-warning">Super Admin</span>  
            				    <?php } else { ?>
            				        <span class="label label-info">Admin</span> 
                                <?php } ?> 
                                <?php if($_SESSION['user'] == 'ADMIN'){ ?>
                                    <a class="btn btn-danger" href="<?php echo MODULE . 'page' . ACTION . 'delteam' . '&id=' . $AllTeam['user_id']; ?>">
        							    <i class="fa fa-trash-o"></i> 
                                    </a>
        						<?php } ?>
        					</span>
        					<small><em>Register date: <a href="#"><?php echo $AllTeam['user_date']; ?></a></em></small><br>
        					FirstName: <a href="#"><?php echo $AllTeam['user_firstname']; ?></a><br>
        					LastName: <a href="#"><?php echo $AllTeam['user_lastname']; ?></a><br>
        					D.O.B: <a href="#"><?php echo $AllTeam['user_birthday']; ?></a><br>
        					e-mail: <a href="#"><?php echo $AllTeam['user_mail']; ?></a><br>                                   
        				</li>
                    <?php } ?>
        			</ul>
        		</div>
            </div>
		</div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include(ROOT . "view/layout/footer.inc.php"); ?>