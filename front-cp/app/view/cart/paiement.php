<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<a href="<?php echo MODULE . 'cart' . ACTION . 'confirmation'; ?>" >confirmation.php</a>

<div class="cart">
	<ul class="actions">
		<li>
			<a href="">Sponsorise</a>
		</li>
		<li>
			<a href="">Informations</a>
		</li>
		<li>
			<a class="active" href="">Payment</a>
		</li>
		<li>
			<a href="">Confirmation</a>
		</li>
	</ul>

	<h1 class="title-action">Payment</h1>
	<div class="wrapper">
		<div class="cart-contain">
			<div class="bg"></div>
			<h2 class="sponsorise-team">
				You would to help name-team for name-event
			</h2>
			<div class="info-team clearfix">
				<div class="img-team medium-2 columns">
					<img src="img/avatar/jeremie.jpg" alt="">
				</div>
				<div class="medium-10 columns desc-team">
					<span>Thank you to sponsorise this team !</span>
					<span>Guaranteed on 1 year on the vehicle</span>
					<span class="price">Amount : price €</span>
				</div>
			</div>
			<div class="bg">
				<div>
					<span>Total amount :</span>
					<span class="price">price €</span>					
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper info-payment">
		<div class="cart-contain">
			<div class="bg">
				<h2>Select your means of payment</h2>
			</div>

			<form action="" class="means-payment">
				<div>
					<input type="radio" id="master-card">
					<img src="img/credit/mastercard.png" alt="">
				</div>
				<div>
					<input type="radio" id="visa">
					<img src="img/credit/visa.png" alt="">
				</div>
				<div>
					<input type="radio" id="cirrus">
					<img src="img/credit/cirrus.png" alt="">
				</div>
				<div>
					<input type="radio" id="american-express">
					<img src="img/credit/american-express.png" alt="">
				</div>
				<div>
					<input type="radio" id="mestro">
					<img src="img/credit/mestro.png" alt="">
				</div>
				<div>
					<input type="radio" id="american-express">
					<img src="img/credit/paypal2.png" alt="">
				</div>				
		
			</form>

			<div class="bg">
			</div>
		</div>
		<div class="clearfix">
			<a class="before" href="">Precedent</a>
			<a class="help" href="">Continue</a>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>