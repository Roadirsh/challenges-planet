<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add a Project Team
        </h1>
        <ol class="breadcrumb">
            <li><a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Project</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
<<<<<<< HEAD
    <div id="content" class="span10">
        <div class="row-fluid sortable">
				<div class="box-content">
                    <div class="box box-info">
                        <div class="box-body">
						<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="name">Titre du groupe de projet</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="name" name="name" type="text" value="" required>
=======
	    <div id="content" class="span10">
	        <div class="row-fluid sortable">
					<div class="box-content">
	                    <div class="box box-info">
	                        <div class="box-body">
							<form class="form-horizontal" enctype="multipart/form-data" action="?module=project&action=addproject" method="post">
							  <fieldset>
								<div class="control-group">
									<label class="control-label" for="name">Titre du groupe de projet</label>
									<div class="controls">
									  <input class="input-xlarge focused" id="name" name="name" type="text" value="" required>
									</div>
>>>>>>> 217400ccbf52af8ea135db1f46e347b10d850f81
								</div>
							</div>
                            <div class="control-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" placeholder="Enter ..."></textarea>
                            </div>   
							<div class="control-group">
							  <label class="control-label" for="image">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="image" name="image" type="file">
							  </div>
							</div>
							<div class="control-group">
							    <label class="checkbox" for="check">
								    <input type="checkbox" id="check" name="check" value="oui">
								Mettre en ligne
                                </label>
                            </div>
							<div class="submit">
							  <button type="submit" class="btn btn-primary">Submit</button>
							</div>
							
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>