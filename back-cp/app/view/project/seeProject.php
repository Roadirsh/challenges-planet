<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
	<div class="box span13" onTablet="span13" onDesktop="span13">
		<div class="box-header">
			<h2><i class="halflings-icon user"></i><span class="break"></span>Projects</h2>
		</div>
		<div class="box-content">
			<ul class="dashboard-list">
			<?php foreach($data as $k => $AllGroup){ ?>
				<li>
					<a href="#">
						<img class="projet" alt="Dennis Ji" src="img/avatar.jpg">
					</a>
					<strong>Name:</strong> <a href="#"><? echo $AllGroup['group_name']; ?></a><br>
					<span class="admin_status">
    					<strong>Status:</strong> 
    				    <?php if($AllGroup['group_valid'] == 1){ ?>
    					    <strong>Status:</strong> <span class="label label-success">Approved</span><br>   
    				    <? } else { ?>
    				        <strong>Status:</strong> <span class="label label-warning">Waiting</span><br>  
                        <? } ?> 
					</span>
					<strong>Since:</strong> <? echo $AllGroup['group_date']; ?><br>
					<strong>Description:</strong><br> <? echo $AllGroup['group_descr']; ?>
					<hr>                       
				</li>
            <? } ?>
			</ul>
		</div>
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>