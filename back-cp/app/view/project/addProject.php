<?php // $logger->log('test', 'loadapp', "Chargement de la vue home.php", Logger::GRAN_MONTH); ?>
<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span> Add a project</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="name">Titre du groupe de projet</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="name" name="name" type="text" value="" required>
								</div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="descr">Description</label>
							  <div class="controls">
								<textarea class="cleditor" id="descr" name="descr" rows="3" required></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="image">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="image" name="image" type="file">
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