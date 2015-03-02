<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>


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
				You would to help <?php echo $_SESSION["donation_team"]; ?> for <?php echo $_SESSION["donation_event"]; ?>
			</h2>
			<div class="info-team clearfix">
				<div class="img-team medium-2 columns">
					<img src="<?php echo PROJECT . $_SESSION["donation_team_img"]; ?>" alt="">
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
	</div>
	<div class="wrapper info-payment">
		<form action="<?php echo MODULE . 'cart' . ACTION . 'confirmation'; ?>" method="post">

			<div class="cart-contain">
				<div class="bg">
					<h2>Select your means of payment</h2>
				</div>	
					
					<div class="means-payment">
						<input type="checkbox" name="payment" value="visa" id="visa" checked>
						<img src="img/credit/visa.png" alt="">
					</div>			
			
				<div class="bg">
				</div>
			</div>
			<div class="clearfix">
				<a href="<?php echo MODULE . 'cart' . ACTION . 'seeinfocart'; ?>" class="before" >Precedent</a>
				<input class="help" type="submit" value="Continue">
			</div>
		</form>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>