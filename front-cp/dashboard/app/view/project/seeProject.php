<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Projects Teams <small>(<? echo count($data); ?>)</small>
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
                <div class="alert alert-success" role="alert"><? echo $_SESSION['message']; ?></div>
            <? $_SESSION['message'] = ''; } ?>
            <!-- search on all the dashboard -->
            <form action="" method="post" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="search" id="search" type="text" value="" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <? if(empty($data)){ ?>
                <div class="alert alert-danger user_event">
    				<center>There is no result to this research</center>
    			</div>
            <? } ?>
        	<div class="box span13" onTablet="span12" onDesktop="span13">
        		<div class="box-content">
        			<ul class="dashboard-list">
        			<?php foreach($data as $k => $AllGroup){ ?>
        				<li class="allgroup">
        					<a href="<? echo MODULE . 'project' . ACTION . 'seeoneproject' . '&id=' . $AllGroup['group_id']; ?>">
        						<img class="projet" alt="Dennis Ji" src="images/group/<? echo $AllGroup['group_img']; ?>">
        					</a>
        					<strong>Name:</strong> <a href="<? echo MODULE . 'project' . ACTION . 'seeoneproject' . '&id=' . $AllGroup['group_id']; ?>"><? echo $AllGroup['group_name']; ?></a><br>
        					<span class="admin_status">
        					    <a class="btn btn-danger del" href="<? echo MODULE . 'project' . ACTION . 'delproject' . ID . $AllGroup['group_id']; ?>">
        							<i class="fa fa-trash-o"></i> 
        						</a>
            					<strong>Status:</strong> 
            				    <?php if($AllGroup['group_valid'] == 1){ ?>
            					    <span class="label label-success">Approved</span><br>   
            				    <? } else { ?>
            				        <span class="label label-warning">Waiting</span><br>  
                                <? } ?> 
        					</span>
        					<strong>Since:</strong> <? echo $AllGroup['group_date']; ?><br>
        					
        					<div class="description">
        					    <strong>Description:</strong><br>
        					    <? echo strip_tags($AllGroup['group_descr']); ?></div>
        					<hr>                       
        				</li>
                    <? } ?>
        			</ul>
        		</div>
            </div>
        </div>
    </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>