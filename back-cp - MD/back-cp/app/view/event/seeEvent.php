<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>


<div id="content" class="span10">
    <?if(!empty($_SESSION['message'])){ ?>
        <div class="alert alert-success" role="alert"><? echo $_SESSION['message']; ?></div>
    <? $_SESSION['message'] = ''; } ?>
    <div class="row-fluid">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Event </h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Event Name</th>
								  <th>Date begin</th>
								  <th>Date end</th>
								  <th>Date regist.</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						   <?php foreach($data as $k => $AllEvent){ ?>
							<tr>
							    <td><a class="btn btn-info" href="<? echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $AllEvent['event_id']; ?>"><? echo $AllEvent['event_name']; ?></a></td>
								<td><? echo $AllEvent['event_begin']; ?></td>
								<td><? echo $AllEvent['event_end']; ?></td>
								<td><? echo $AllEvent['event_date']; ?></td>
								<td class="center">
                				    <?php if($AllEvent['event_valid'] == 1){ ?>
                					    <span class="label label-success">Active</span> 
                				    <? } else { ?>
                				        <span class="label label-warning">No active</span> 
                                    <? } ?>	
								</td>
								<td class="center">
									<a class="btn btn-info" href="#">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="<? echo MODULE . 'event' . ACTION . 'delevent' . ID . $AllEvent['event_id']; ?>">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<? } ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->



<?php include(ROOT . "view/layout/footer.inc.php"); ?>