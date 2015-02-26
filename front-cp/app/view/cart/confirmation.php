<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<a href="<?php echo MODULE . 'cart' . ACTION . 'seesummary'; ?>" >seesummary.php</a>

<div class="cart">
	<ul class="actions">
		<li>
			<a href="">Sponsorise</a>
		</li>
		<li>
			<a href="">Informations</a>
		</li>
		<li>
			<a href="">Payment</a>
		</li>
		<li>
			<a class="active" href="">Confirmation</a>
		</li>
	</ul>

	<h1 class="title-action">Confirmation</h1>
	<div class="wrapper">
		<div class="cart-contain">
			<div class="bg"></div>
			<h2 class="sponsorise-team">
				You would to help <?php echo $_SESSION["donation_team"]; ?> for <?php echo $_SESSION["donation_event"]; ?>
			</h2>
			<div class="info-team clearfix">
				<div class="img-team medium-2 columns">
					<img src="<?php echo AVATAR . $_SESSION["donation_team_img"]; ?>" alt="">
				</div>
				<div class="medium-10 columns desc-team">
					<span>Thank you to sponsorise this team !</span>
					<span>Guaranteed on 1 year on the vehicle</span>
					<span class="price">Amount : <?php echo $_SESSION["donation_amount"]; ?> €</span>
				</div>
			</div>
			<div class="bg clearfix confirmation">
				<div class="medium-6 columns choose">
					<span>You choose :</span>
					<img src="img/credit/visa.png" alt="">				
				</div>
				<div class="medium-6 columns validate">
					<a href="" class="join">Validate</a>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper info-payment">
		<div class="cart-contain">
			<div class="bg">
				<h2>Thank you for help !</h2>
			</div>

			<div class="clearfix plus-info">
				<div class="medium-6 columns">
					<img src="img/icon-info-payment.png" alt="">
					<span>Thank for your contribution !</span>
					<p>With this help you contribute to finance a team but also an association which will help the planet must to be better !</p>
					<p>To assure the good running of our service, we inform to you that we take 10 % in every paid donation.
					If all the expenses of maintenance as well as the payment of our employees is made and that we have some money moreover, the latter is put back to the teams which need it.</p>
				</div>
				<div class="medium-6 columns">
					<img src="img/icon-info-mail.png" alt="">
					<span>Information</span>
					<p>A recapitulative e-mail of your sponsoring and payment will be sent to you in the minutes who follows the validation !</p>
				</div>
			</div>

			<div class="bg">
				<a class="before" href="<?php echo MODULE . 'cart' . ACTION . 'paiement'; ?>">Precedent</a>
			</div>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>