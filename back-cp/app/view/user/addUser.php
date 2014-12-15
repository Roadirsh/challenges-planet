<? include(ROOT . "view/layout/header.inc.php"); ?>
<? include(ROOT . "view/layout/menutop.inc.php"); ?>
<? include(ROOT . "view/layout/menu.inc.php"); ?>

<div id="content" class="span10">

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="firstname">Nom:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="firstname" type="text" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="lastname">Prenom:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="lastname" type="text" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="birthday">Date de naissance:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="birthday" type="date" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="mail">Mail:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="mail" type="email" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="pseudo">Pseudo:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="pseudo" type="text" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="password">Mot de passe:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="password" type="password" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="name">Photo de profil:</label>
									<div class="controls">
										<input class="input-xlarge focused" id="name" type="file" value="">
									</div>
								</div>
								
								<div class="form-actions">
									<input type="submit" class="btn btn-primary">
									<button class="btn">Cancel</button>
								</div>
							</fieldset>
						</form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>