<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span> Add a event</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
							<fieldset>
							<div class="control-group">
								<label class="control-label" for="nameEvent">Nom de l'événement</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="nameEvent" name="nameEvent" type="text" value="" required>
								</div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="descrEvent">Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="descrEvent" name="descrEvent" rows="3" required></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="imageEvent">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="imageEvent" name="imageEvent" type="file">
							  </div>
							</div>      
							<div class="control-group">
								<label class="control-label" for="dateBegin">Date de début</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="dateBegin" name="dateBegin" type="date" value="" required>
								</div>
							</div> 
							<div class="control-group">
								<label class="control-label" for="dateEnd">Date de fin</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="dateEnd" name="dateEnd" type="date" value="" required>
								</div>
							</div> 
							<div class="control-group">
								<div class="controls">
								<label class="control-label checkbox" for="check">
									<input type="checkbox" id="check" name="check" value="oui">
									Mettre en ligne
								 </label>
								</div>
							  </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Enregistrer</button>
							</div>
						  </fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>