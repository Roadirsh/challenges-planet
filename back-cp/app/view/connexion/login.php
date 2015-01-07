<?php include(ROOT . "view/layout/header.inc.php"); ?>
	
	<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
                    <?if(!empty($_SESSION['message'])){ ?>
                        <div class="alert alert-warning" role="alert"><? echo $_SESSION['message']; ?></div>
                    <? $_SESSION['message'] = ''; } ?>
					<h2>Login to enter !</h2>
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
							
							<!-- <label class="remember" for="remember"> <input type="checkbox" id="remember" />Remember me</label> -->

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>
					<hr>
					<!-- <h3><a href="#">Forgot Password?</a></h3> -->
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
</div><!--/fluid-row-->

<?php include(ROOT . "view/layout/footer.inc.php"); ?>