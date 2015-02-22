<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>
<a href="<?php echo MODULE . 'cart' . ACTION . 'seeonecart'; ?>" >seeonecart.php</a>

<div class="cart">

	<h1 class="title-action summary">Thank you very much for your payment, you will not regret your gesture !</h1>
	<div class="wrapper">
		<div class="cart-contain">
			<div class="bg">
				<h2>Summary of your sponsoring</h2>
			</div>
			<h2 class="sponsorise-team">
				You helped name-team for name-event
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
					<span>You will receive a mail of your payment soon !</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>