<?php include(ROOT . "view/layout/header.inc.php"); ?>

<h2>Formulaire temporaire de login</h2>
<form class="form-horizontal" action="" method="post">
	<fieldset>
		
		<div class="input-prepend" title="Username">
			<span class="add-on"><i class="halflings-icon user"></i></span>
			<input class="input-large span10" name="login" id="username" type="text" placeholder="Username" required autofocus />
		</div>
		<div class="clearfix"></div>

		<div class="input-prepend" title="Password">
			<span class="add-on"><i class="halflings-icon lock"></i></span>
			<input class="input-large span10" name="pwd" id="password" type="password" placeholder="Password" required/>
		</div>
		<div class="clearfix"></div>
		
		<label class="remember" for="remember"> <input type="checkbox" id="remember" />Remember me</label>

		<div class="button-login">	
			<button type="submit" class="btn btn-primary">Login</button>
		</div>
		<div class="clearfix"></div>
</form>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>