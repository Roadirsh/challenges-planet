<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add a Project Team
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Project</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	    <div id="content" class="span10">
		     <?php if(!empty($_SESSION['message'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; ?></div>
            <?php $_SESSION['message'] = ''; } ?>
	        <div class="row-fluid sortable">
					<div class="box-content">
	                    <div class="box box-info">
	                        <div class="box-body">
							<form class="form-horizontal" enctype="multipart/form-data" action="?module=project&action=addproject" method="post">
							  <fieldset>
								<div class="control-group">
									<label class="control-label" for="student">Ajouter un étudiant</label>
									<div class="controls">
										<select class="users" name="student[]" multiple="multiple" style="width:100%;" required>
										  <option></option>
										  <?php foreach($data[1] as $student) {
											  echo '<option value="'.$student["user_id"].'">'.$student["user_pseudo"]. " - ".$student["user_mail"].'</option>';
										  }
										  ?>
										  
										</select>									
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="event">Lier à l'événement:</label>
									<div class="controls">
									  <select class="combobox" name="event" required>
										  <option></option>
										  <?php foreach($data[0] as $event) {
											  echo '<option value="'.$event["event_id"].'">'.$event["event_name"].'</option>';
										  }
										  ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="name">Titre du groupe de projet</label>
									<div class="controls">
									  <input class="input-xlarge focused" id="name" name="name" type="text" value="" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="money">Montant recherché</label>
									<div class="controls">
									  <input class="input-xlarge focused" id="money" name="money" type="number" min="1" max="10000" value="" required>
									</div>
								</div>
	                            <div class="control-group">
	                                <label>Description</label>
	                                <textarea class="form-control" rows="5" placeholder="Enter ..." name="descr"></textarea>
	                            </div>   
	                            <div class="control-group">
	                                <label>Description du projet</label>
	                                <textarea class="form-control" rows="5" placeholder="Enter ..." name="project"></textarea>
	                            </div>  
	                            <div class="control-group">
	                                <label>Description du budget</label>
	                                <textarea class="form-control" rows="5" placeholder="Enter ..." name="budget"></textarea>
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
	                </div>
				</div>
			</div><!--/span-->
		</div><!--/row-->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<script type="text/javascript">
  /*
$(document).ready(function(){
    $('.combobox').combobox();
  });
*/
  $('.users').select2();

</script>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>