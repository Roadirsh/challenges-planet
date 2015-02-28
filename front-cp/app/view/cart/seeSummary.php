<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<div class="cart">

	<h1 class="title-action summary">Thank you very much for your payment, you will not regret your gesture !</h1>
	<div class="wrapper">
		<div class="cart-contain">
			<div class="bg">
				<h2>Summary of your sponsoring</h2>
			</div>
			<h2 class="sponsorise-team">
				You helped <?php echo $_SESSION['donation_team']; ?> for <?php echo $_SESSION['donation_event']; ?>
			</h2>
			<div class="info-team clearfix">
				<div class="img-team medium-2 columns">
					<img src="<?php echo PROJECT . $_SESSION['donation_team_img']; ?>" alt="">
				</div>
				<div class="medium-10 columns desc-team">
					<span>Thank you to sponsorise this team !</span>
					<span>Guaranteed on 1 year on the vehicle</span>
					<span class="price">Amount : <?php echo $_SESSION['donation_amount']; ?> €</span>
				</div>
			</div>
			<div class="bg">
				<div class="mess">
					<span>You will receive a mail of your payment soon !</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>