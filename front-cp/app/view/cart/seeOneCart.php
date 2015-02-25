<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<a href="<?php echo MODULE . 'cart' . ACTION . 'seeinfocart'; ?>" >seeinforcart.php</a>

<div class="cart">
	<ul class="actions">
		<li>
			<a class="active" href="">Sponsorise</a>
		</li>
		<li>
			<a href="#">Informations</a>
		</li>
		<li>
			<a href="">Payment</a>
		</li>
		<li>
			<a href="">Confirmation</a>
		</li>
	</ul>

	<h1 class="title-action">Sponsorise</h1>
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
			<div class="bg">
				<div>
					<span>Total amount :</span>
					<span class="price"><?php echo $_SESSION["donation_amount"]; ?> €</span>	
				</div>
			</div>
		</div>
		<div class="clearfix">
			<a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject'; ?>" class="before" >Precedent</a>
			<a href="<?php echo MODULE . 'cart' . ACTION . 'paiement'; ?>" class="help"> Continue</a>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>