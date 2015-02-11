<?php include(ROOT . "view/layout/header.inc.php"); ?>

<div class="contain">
    <div class="signup">
		<form id="form-signup" action="" method="post" class="clearfix">
	    	<div class="classic-login">
	    		<fieldset>
	    			<h1>Increase your challenge and your help for the planet</h1>
		            <label for="email">Email</label>
		            <input id="sign-up-email" name="email" type="text" placeholder="" required>
		            <label for="password">Password</label>
		            <input id="sign-up-password" name="pwd" type="password" placeholder="" required>
		            <input type="submit" class="button-submit" value="sign up" alt="sign up">
		            <input type="checkbox" value="subscribe" name="subscribe"> <span>Don't miss nothing of our news events and their progress ! With our newsletter</span>
		        </fieldset>
	    	</div>
	    	<div class="">
	    		<fieldset>
	    			<h1>Or sign up with your favorite social media !</h1>
	    			<div class="social-sign-up">
	    				<a href="#"><img src="img/fb-login.png">Sign up with Facebook</a>
	    			</div>
	    		</fieldset>
	    		<fieldset>
	    			<span>Have you already an account ? </span><a class="connect popup-with-form" href="#form-login">Log you here !</a>
	    		</fieldset>
	    	</div>
	    </form>
	</div>
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>