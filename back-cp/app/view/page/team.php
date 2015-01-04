<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
	<div class="box span13" onTablet="span13" onDesktop="span13">
		<div class="box-header">
			<h2><i class="halflings-icon user"></i><span class="break"></span>Admin</h2>
		</div>
		<div class="box-content">
			<ul class="dashboard-list">
			<?php foreach($data as $k => $AllTeam){ ?>
			<?php // var_dump($AllTeam); ?>
				<li>
					<a href="#">
                        <?php if(!empty($AllTeam['user_profil_pic'])){ ?>
    				        <img class="avatar" alt="Dennis Ji" src="<? echo $AllTeam['user_profil_pic']; ?>">
                        <? } else { ?>
    				        <img class="avatar" alt="Dennis Ji" src="img/avatar.jpg"> 
                        <? } ?> 
					</a>
					<strong>Pseudo:</strong> <a href="#"><? echo $AllTeam['user_pseudo']; ?></a><br>
					<span class="admin_status">
    					<strong>Status:</strong> 
    				    <?php if($AllTeam['user_super_admin'] == 1){ ?>
    					    <span class="label label-warning">Super Admin</span>  
    				    <? } else { ?>
    				        <span class="label label-info">Admin</span> 
                        <? } ?> 
                        <?php if($_SESSION['user'] == 'ADMIN'){ ?>
                            <a class="btn btn-danger" href="<? echo MODULE . 'page' . ACTION . 'delteam' . '&id=' . $AllTeam['user_id']; ?>">
							    <i class="halflings-icon white trash"></i> 
                            </a>
						<? } ?>
					</span>
					<small><em>Register date: <a href="#"><? echo $AllTeam['user_date']; ?></a></em></small><br>
					FirstName: <a href="#"><? echo $AllTeam['user_firstname']; ?></a><br>
					LastName: <a href="#"><? echo $AllTeam['user_lastname']; ?></a><br>
					D.O.B: <a href="#"><? echo $AllTeam['user_birthday']; ?></a><br>
					e-mail: <a href="#"><? echo $AllTeam['user_mail']; ?></a><br>                                   
				</li>
            <? } ?>
			</ul>
		</div>
    </div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>