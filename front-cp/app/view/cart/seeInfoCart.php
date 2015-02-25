<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>
<a href="<?php echo MODULE . 'cart' . ACTION . 'paiement'; ?>" >paiement.php</a>

<div class="cart">
	<ul class="actions">
		<li>
			<a  href="">Sponsorise</a>
		</li>
		<li>
			<a class="active" href="">Informations</a>
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
			<div class="bg">
				<h2>Information of invoicing</h2>
			</div>
			<form action="post" class="invoicing">
				<div class="clearfix">
					<div class="medium-6 columns">
						<label for="">First name</label>
						<div>
							<input type="text">
						</div>
					</div>
					<div class="medium-6 columns">
						<label for="">Last name</label>
						<div>
							<input type="text">
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="medium-6 columns">
						<label for="">Company</label>
						<div>
							<input type="text">
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="medium-6 columns">
						<label for="">Adress line 1</label>
						<div>
							<input type="text">
						</div>
					</div>
					<div class="medium-6 columns">
						<label for="">Adress line 2</label>
						<div>
							<input type="text">
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="medium-6 columns">
						<label for="">City</label>
						<div>
							<input type="text">
						</div>
					</div>
					<div class="medium-6 columns">
						<label for="">ZIP</label>
						<div>
							<input type="text">
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="medium-6 columns">
						<label for="">Country</label>
						<div>
							<input type="text">
						</div>
					</div>
					<div class="medium-6 columns">
						<label for="">Phone number</label>
						<div>
							<input type="text">
						</div>
					</div>
				</div>

			</form>
			<div class="bg">
				<div>
					<span>Total amount :</span>
					<span class="price"><?php echo $_SESSION["donation_amount"]; ?> €</span>					
				</div>
			</div>
		</div>
		<div class="clearfix">
			<a class="before" href="">Precedent</a>
			<a class="help" href="">Continue</a>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>