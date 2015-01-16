<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add an event
        </h1>
        <ol class="breadcrumb">
            <li><a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Event</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <div id="content" class="span10">

			<div class="row-fluid sortable">
				<div class="box-content">
                    <div class="box box-info">
                        <div class="box-body">
						<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
							<fieldset>
							<div class="control-group">
								<label class="control-label" for="nameEvent">Nom de l'événement</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="nameEvent" name="nameEvent" type="text" value="" required>
								</div>
							</div>
							<div class="control-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" placeholder="Enter ..."></textarea>
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
			</div>
        </div>
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>