<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Projects Teams <small>(<?php echo count($data); ?>)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">See Projects</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div id="content" class="span10">
            <?if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
            <!-- search on all the dashboard -->
            <form action="?module=project&action=seeproject" method="post" class="sidebar-form">
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
        	<div class="box span13">
        		<div class="box-content">
        			<ul class="dashboard-list">
        			<?php foreach($data as $k => $AllGroup){ ?>
        				<li class="allgroup">
        					<a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . '&amp;id=' . $AllGroup['group_id']; ?>">
        						<img class="projet" alt="Dennis Ji" src="<?php echo PROJECT . $AllGroup['group_img']; ?>">
        					</a>
        					<strong>Name:</strong> <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . '&amp;id=' . $AllGroup['group_id']; ?>"><?php echo $AllGroup['group_name']; ?></a><br>
        					<span class="admin_status">
        					    <a class="btn btn-danger del" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette entrée?'));" href="<?php echo MODULE . 'project' . ACTION . 'delproject' . ID . $AllGroup['group_id']; ?>">
        							<i class="fa fa-trash-o"></i> 
        						</a>
            					<strong>Status:</strong> 
            				    <?php if($AllGroup['group_valid'] == 1){ ?>
            					    <span class="label label-success">Approved</span><br>   
            				    <?php } else { ?>
            				        <span class="label label-warning">Waiting</span><br>  
                                <?php } ?> 
        					</span>
        					<strong>Since:</strong> <?php echo $AllGroup['group_date']; ?><br>
        					
        					<div class="description">
        					    <strong>Description:</strong><br>
        					    <?php echo strip_tags($AllGroup['group_descr']); ?></div>
        					<hr>                       
        				</li>
                    <?php } ?>
        			</ul>
        		</div>
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>