<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
    <div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>User </h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>User name</th>
								  <th>First name</th>
								  <th>Last name</th>
								  <th>D.O.B</th>
								  <th>Mail</th>
								  <th>Date regist.</th>
								  <th>Role</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						    <?php foreach($data as $k => $AllUser){ ?>
                            <?php // var_dump($AllUser); ?>
							<tr>
								<td><a class="btn btn-info" href="#"><?php echo $AllUser['user_pseudo']; ?></a></td>
								<td><?php echo $AllUser['user_firstname']; ?></td>
								<td><?php echo $AllUser['user_lastname']; ?></td>
								<td><?php echo $AllUser['user_birthday']; ?></td>
								<td><?php echo $AllUser['user_mail']; ?></td>
								<td class="center"><?php echo $AllUser['user_date']; ?></td>
								<td class="center">
								<?php if($AllUser['user_type'] == "student"){ ?>
									<span class="label label-info"><?php echo $AllUser['user_type']; ?></span>
								<?php } elseif($AllUser['user_type'] == "organisme"){ ?>
								    <span class="label label-default"><?php echo $AllUser['user_type']; ?></span>
								<?php } ?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="<?php echo MODULE . 'user' . ACTION . 'deluser' . '&id=' . $AllUser['user_id']; ?>">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<?php } ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
</div>





<?php include(ROOT . "view/layout/footer.inc.php"); ?>