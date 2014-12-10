<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>
	
	<div class="box span4" onTablet="span6" onDesktop="span4">
		<div class="box-header">
			<h2><i class="halflings-icon user"></i><span class="break"></span>Last Users Alt.</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<ul class="dashboard-list">
				<li>
					<a href="#">
						<img class="avatar" alt="Dennis Ji" src="img/avatar.jpg">
					</a>
					<strong>Name:</strong> <a href="#">Dennis Ji</a><br>
					<strong>Since:</strong> Jul 25, 2012 11:09<br>
					<strong>Status:</strong> <span class="label label-success">Approved</span>                                  
				</li>
				<li>
					<a href="#">
						<img class="avatar" alt="" src="img/avatar.jpg">
					</a>
					<strong>Name:</strong> <a href="#">Dennis Ji</a><br>
					<strong>Since:</strong> Jul 25, 2012 11:09<br>
					<strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
				</li>
				<li>
					<a href="#">
						<img class="avatar" alt="" src="img/avatar.jpg">
					</a>
					<strong>Name:</strong> <a href="#">Dennis Ji</a><br>
					<strong>Since:</strong> Jul 25, 2012 11:09<br>
					<strong>Status:</strong> <span class="label label-important">Banned</span>                                  
				</li>
				<li>
					<a href="#">
						<img class="avatar" alt="" src="img/avatar.jpg">
					</a>
					<strong>Name:</strong> <a href="#">Dennis Ji</a><br>
					<strong>Since:</strong> Jul 25, 2012 11:09<br>
					<strong>Status:</strong> <span class="label label-info">Updates</span>                                  
				</li>
			</ul>
		</div>
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>