<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php include(ROOT . "view/layout/menutop.inc.php"); ?>
<?php include(ROOT . "view/layout/menu.inc.php"); ?>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add a user
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="content" class="span10">
			<div class="row-fluid sortable">
				<div class="box-content">
                    <div class="box box-success">
                        <div class="box-body">
        					<form class="form-horizontal" enctype="multipart/form-data" action="?module=user&action=adduser" method="post">
        					    
        						<div class="form-left">
        						<h3 class="box-title">Users Basic Information</h3>
        							<?php if($data) { ?>
        								    <div class="alert alert-danger"  role="alert">This pseudo has already been taken !</div>
        							<?php } ?>
        							<div class="control-group">
        								<label class="control-label">Type:</label>
        								<div class="">
        									<select name="type">
        										<option value="student">Student</option>
        										<option value="organisme">Organism</option>
        										<option value="admin">Admin</option>
        									</select>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="firstname">Lastname:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="firstname" id="firstname" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="lastname">Firstname:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="lastname" id="lastname" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="birthday">D.O.B:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="birthday" id="birthday" type="date" value="" max="<?=date('Y-m-d', strtotime('-13 years'))?>" min="1900-01-01" 	required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="mail">Mail:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="mail" id="mail" type="email" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="phoneNumber">Phone: </label>
        								<div class="controls">
        									<input class="input-large focused" name="phoneNumber" id="phoneNumber" type="text" title='The phone number must be between 6 and 14 numbers and begin with a "+".' pattern="^\+(?:[0-9]?){6,14}[0-9]$" placeholder="+33xxxxxxx">
        								</div>

        							</div>
        							<div class="control-group">
        								<label class="control-label" for="pseudo">Login:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="pseudo" id="pseudo" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="password">Password:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="password" id="password" type="password" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="profil">Profil pic':</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="profil" id="profil" type="file">
        								</div>
        							</div>
        							
        						</div>
                                <div class="form-left">
                                    <h3 class="box-title">Users Home Address</h3>
        							<div class="control-group">
        								<label class="control-label" for="numRueHome">Street number:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="numRueHome" id="numRueHome" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="nomRueHome">Street name:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="nomRueHome" id="nomRueHome" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="zipcodeHome">Zip code:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="zipcodeHome" id="zipcodeHome" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="cityHome">Town:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="cityHome" id="cityHome" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="countryHome">Country:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="countryHome" id="countryHome" type="text" value="" required>
        								</div>
        							</div>
        							

                                </div>
                                <div class="form-left">
                                    <h3 class="box-title">Users Invoice Address</h3>
        							<div class="control-group">
        								<label class="control-label" for="numRueInvoice">Street number:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="numRueInvoice" id="numRueInvoice" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="nomRueInvoice">Street name:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="nomRueInvoice" id="nomRueInvoice" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="zipcodeInvoice">Zip code:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="zipcodeInvoice" id="zipcodeInvoice" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="cityInvoice">Town:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="cityInvoice" id="cityInvoice" type="text" value="" required>
        								</div>
        							</div>
        							<div class="control-group">
        								<label class="control-label" for="countryInvoice">Country:</label>
        								<div class="controls">
        									<input class="input-xlarge focused" name="countryInvoice" id="countryInvoice" type="text" value="" required>
        								</div>
        							</div>
        							
        							
        							<div class="form-actions">
        								<input type="submit" class="btn btn-primary">
        								<button class="btn">Cancel</button>
        							</div>
                                </div>
        					</form>
						</div>
                    </div>
				</div>
            </div>
		</div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<?php include(ROOT . "view/layout/footer.inc.php"); ?>