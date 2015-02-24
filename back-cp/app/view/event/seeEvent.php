<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Events <small>(<?php echo count($data); ?>)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">See Events</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <?php if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
            <!-- search on all the dashboard -->
            <form action="?module=event&action=seeevent" method="post" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="search" id="search" value="" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <?php if(empty($data)){ ?>
                <div class="alert alert-danger user_event">
    				<center>There is no result to this research</center>
    			</div>
            <?php } ?>
            <div class="row-fluid">		
        				<div class="box span12">
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
        							    <td><a class="" href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $AllEvent['event_id']; ?>"><?php echo $AllEvent['event_name']; ?></a></td>
        								<td><?php echo $AllEvent['event_begin']; ?></td>
        								<td><?php echo $AllEvent['event_end']; ?></td>
        								<td><?php echo $AllEvent['event_date']; ?></td>
        								<td class="center">
                        				    <?php if($AllEvent['event_valid'] == 1){ ?>
                        					    <span class="label label-success">Active</span> 
                        				    <?php } else { ?>
                        				        <span class="label label-warning">No active</span> 
                                            <?php } ?>	
        								</td>
        								<td class="center">
        									<a class="btn btn-info" href="#">
        										<i class="fa fa-pencil-square-o"></i>  
        									</a>
        									<a class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" href="<?php echo MODULE . 'event' . ACTION . 'delevent' . ID . $AllEvent['event_id']; ?>">
        										<i class="fa fa-trash-o"></i>  
        									</a>
        								</td>
        							</tr>
        							<?php } ?>
        						  </tbody>
        					  </table>            
        					</div>
        				</div><!--/span-->
            </div>	
   		</div><!--/row-->
    </section><!-- /.content -->
</aside><!-- /.right-side -->


<?php include(ROOT . "view/layout/footer.inc.php"); ?>