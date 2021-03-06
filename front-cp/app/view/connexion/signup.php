<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<div class="contain">
    <div class="signup">
		<form id="form-signup" action="<?php echo MODULE . 'log' . ACTION . 'signup'; ?>" method="post" class="clearfix">
	    	<div class="classic-login">
	    		<fieldset>
	    			<h1>Increase your challenge and your help for the planet</h1>
		            <label for="sign-up-email">Email</label>
		            <input id="sign-up-email" name="email" type="text" placeholder="">
		            <label for="sign-up-password">Password</label>
		            <input id="sign-up-password" name="pwd" type="password" placeholder="">
		            <input type="submit" class="button-submit" value="sign up">
		            <?php // FOR THE V2, WE WILL MAKE A NL ?>
		            <?php //<input type="checkbox" value="subscribe" name="subscribe"> <span>Don't miss nothing of our news events and their progress ! With our newsletter</span>?>
		        </fieldset>
	    	</div>
	    	<div class="">
	    		<?php // CONNEXION WITH FACEBOOK IN A V2 ?>
	    		<?php // <fieldset>
	    			// <h1>Or sign up with your favorite social media !</h1>
	    			// <div class="social-sign-up">
	    				//<a href="#"><img src="img/fb-login.png">Sign up with Facebook</a>
	    			// </div>
	    		// </fieldset> ?>
	    		<fieldset>
	    			<span>Have you already an account ? </span><a class="connect popup-with-form" href="#form-login">Log you here !</a>
	    		</fieldset>
	    	</div>
	    </form>
	</div>
</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>