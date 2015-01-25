<div class="container row"> <!-- CONTAINER -->
    <div class="header"> <!-- HEADER -->
		<div class="logo show-for-small-only">
			<a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><img src="img/logo_mobile.png" alt=""></a>
		</div>

		 <nav class="show-for-small-only menu-mobile">
			<ul>
				<li><a href="<? echo MODULE . 'event' . ACTION . 'seeevent'; ?>">let's see events</a></li>
				<li><a href="#">they helped them</a></li>
				<li class="join"><a href="<? echo MODULE . 'event' . ACTION . 'addevent'; ?>">ready for your adventure ?</a></li>
				<li class="clearfix">
				    <a class="connect popup-with-form" href="#form-login">Login</a>
				    <a href="<? echo MODULE . 'log' . ACTION . 'signup'; ?>" class="register">Sign up</a>
				</li>
				<li>
				    <a target="_blank" href="https://www.facebook.com/challengesplanet?fref=ts">
				        <img src="img/fb.png" height="42" width="44" alt=""></a>
                    <a href="https://twitter.com/ChallPlanet" target="_blank">
                        <img src="img/twitter.png" alt=""></a>
                    <a href="https://plus.google.com/116420885451887262970/about" target="_blank">
                        <img src="img/google+.png" alt=""></a>
				</li>
			</ul>
		</nav>


		<nav class="show-for-medium-up menu clearfix">

			<div class="logo show-for-medium-up">
				<a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><img src="img/logo.png"alt=""></a>
			</div>
			<ul class="first-nav">
				<li><a href="<? echo MODULE . 'event' . ACTION . 'seeevent'; ?>">let's see events</a></li>
				<li class="helped"><a href="#">they helped them</a></li>
				<li class="join"><a href="<? echo MODULE . 'event' . ACTION . 'addevent'; ?>" onClick="ga('send', 'event', 'link','clic', 'create-eventv3');">ready for your adventure ?</a></li>
			</ul>
			<ul class="second-nav clearfix">
			    <? if(isset($_SESSION['user']) && !empty($_SESSION['user']) || isset($_SESSION['userMail']) && !empty($_SESSION['userMail']) ) {?>
			    <!-- DESIGN TEMPORAIRE -->
				<li><a class="connect " href="">Mon compte</a></li>
				<li><a class="register" href="<? echo MODULE . 'log' . ACTION . 'logout'; ?>"><img src="img/logout.png" width="20px;"/></a></li>
				<!-- /DESIGN TEMPORAIRE -->
				<? } else { ?>
				<li><a class="connect popup-with-form" href="#form-login" onClick="ga('send', 'event', 'link','clic', 'connect3');">Login</a></li>
				<li><a class="register" href="<? echo MODULE . 'log' . ACTION . 'signup'; ?>" onClick="ga('send', 'event', 'link','clic', 'registerv3');">Sign up</a></li>
                <? } ?>
				<ul class="social-media clearfix">
					<li><a target="_blank" href="https://www.facebook.com/challengesplanet?fref=ts">
					    <img src="img/fb.png" width="20" alt=""></a></li>
					<li><a target="_blank" href="https://twitter.com/ChallPlanet">
					    <img src="img/twitter.png" width="20" alt=""></a></li>
					<li><a target="_blank" href="https://plus.google.com/116420885451887262970/about">
					    <img src="img/google+.png" width="20" alt=""></a></li>
				</ul>
			</ul>
		</nav>

	    <form id="form-login" class="clearfix mfp-hide white-popup-block" method="post" action="?module=log&action=login">
	    	<div class="classic-login medium-6 columns">
	    		<fieldset>
	    			<h1>Start your challenge here !</h1>
		            <label for="name">Email</label>
		            <input id="email" name="email" type="text" placeholder="" required>
		            <label for="password">Password</label>
		            <input id="password" name="pwd" type="password" placeholder="" required>
		            
		            <a href="#" class="columns medium-6">forgot password ?</a>
		            <a href="#" class="columns medium-6">forgot email ?</a>
		            
		            <input type="submit" class="button-submit" value="Login"  alt="login">
		        </fieldset>
	    	</div>
	    	<div class="medium-6 columns">
	    		<fieldset>
	    			<h1>Or sign up with your favorite social media !</h1>
	    			<div class="social-sign-up">
	    				<a href="#"><img src="img/fb-login.png">Sign up with Facebook</a>
	    				<a href="#"><img src="img/google+_login.png">Sign up with Google +</a>
	    				<a href="<? echo MODULE . 'log' . ACTION . 'signup'; ?>">Or sign up with your email !</a>
	    			</div>
	    		</fieldset>
	    	</div>
	    </form>
    </div><!--/ HEADER -->