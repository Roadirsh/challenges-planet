<? include(ROOT . "view/layout/header.inc.php"); ?>

<div id="content" class="span10">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add event</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
							<fieldset>
							<div class="control-group">
								<label class="control-label" for="nameEvent">Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="nameEvent" name="nameEvent" type="text" value="" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="nameEvent">Place</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="placeEvent" name="placeEvent" type="text" value="" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="nameEvent">Country</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="countryEvent" name="countryEvent" type="text" value="" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="dateBegin">Begin</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="dateBegin" name="dateBegin" type="date" value="" required>
								</div>
							</div> 
							<div class="control-group">
								<label class="control-label" for="dateEnd">End</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="dateEnd" name="dateEnd" type="date" value="" required>
								</div>
							</div> 
							<div class="control-group">
							    <label class="control-label" >Description</label>
							    <div class="controls">
                                    <textarea class="form-control" rows="5" placeholder="Enter ..."></textarea>
                                </div>
                            </div> 
							<div class="control-group">
							  <label class="control-label" for="imageEvent">Image</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="imageEvent" name="imageEvent" type="file">
							  </div>
							</div>      
							
							<div class="control-group">
							    <label class="checkbox control-label" for="check">Mettre en ligne</label>
							    <div class="controls">
								    <input type="checkbox" id="check" name="check" value="oui">
							    </div>
                            </div>
							<div class="submit">
							  <button type="submit" class="btn btn-primary">Submit</button>
							</div>
						  </fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>