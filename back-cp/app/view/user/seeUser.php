<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users <small>(<?php echo count($data); ?>)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">See Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
            <?php if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
                    <!-- search on all the dashboard -->
                    <form action="?module=user&action=seeuser" method="post" class="sidebar-form">
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
                        
        				<div class="box span12">
        				
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
        						    <?php //var_dump($data); ?>
        						    
        						    <?php foreach($data as $k => $AllUser){ ?>
                                    <?php //var_dump($AllUser); ?>
        							<tr>
        								<td><a href="<?php echo MODULE . 'user' . ACTION . 'seeoneuser' . ID . $AllUser['user_id']; ?>"><?php echo $AllUser['user_pseudo']; ?></a></td>
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
        									<a class="btn btn-info" href="<?php echo MODULE . 'user' . ACTION . 'seeoneuser' . ID . $AllUser['user_id']; ?> " >         										<i class="fa fa-pencil-square-o"></i>  
        									</a>
        									<a class="btn btn-danger" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" href="<?php echo MODULE . 'user' . ACTION . 'deluser' . ID . $AllUser['user_id']; ?>">
        										<i class="fa fa-trash-o"></i> 
        									</a>
        								</td>
        							</tr>
        							<?php } ?>
        						  </tbody>
        					  </table>            
        					</div>
        				</div><!--/span-->
        			
        			</div><!--/row-->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>