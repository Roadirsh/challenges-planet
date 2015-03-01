<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

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
			<form action="index.php?module=cart&action=paiement" enctype="multipart/form-data" method="post" class="invoicing">
				<div class="bg">
					<h2>Information of invoicing</h2>
				</div>
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">First name</label>
							<div>
								<input type="text" name="user_firstname" value="<?php if(isset($data['user'][0]['user_firstname'])){ echo $data['user'][0]['user_firstname']; } ?>" required >
							</div>
						</div>
						<div class="medium-6 columns">
							<label for="">Last name</label>
							<div>
								<input type="text" name="user_lastname" value="<?php if(isset($data['user'][0]['user_lastname'])){ echo $data['user'][0]['user_lastname']; } ?>" required>
							</div>
						</div>
					</div>
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">Company</label>
							<div>
								<input type="text" name="user_pseudo" value="<?php if(isset($data['user'][0]['user_pseudo'])){ echo $data['user'][0]['user_pseudo']; } ?>" required>
							</div>
						</div>
						<div class="medium-6 columns">
							<label for="">Logo (width 250px)</label>
							<div>
								<?php if(isset($_SESSION['connect_compte_FRONT']) && $_SESSION['connect_compte_FRONT'] == true) {?>

								<img src="<?php echo AVATAR; if(isset($data['user'][0]['user_profil_pic'])){ echo $data['user'][0]['user_profil_pic']; } ?>" alt="">
								<input type="hidden" name="hidden_user_pic" value="<?php if(isset($data['user'][0]['user_profil_pic'])){ echo $data['user'][0]['user_profil_pic']; } ?>" >
								<?php } ?>
								<input type="file" name="user_pic" <?php if(!isset($_SESSION['connect_compte_FRONT']) || $_SESSION['connect_compte_FRONT'] == false) { echo 'required'; }?>>
							</div>
						</div>
					</div>
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">Adress num</label>
							<div>
								<input type="text" name="invoice_ad_num" value="<?php if(isset($data['info'][0]['ad_num'])){ echo $data['info'][0]['ad_num']; } ?>" required >
							</div>
						</div>
						<div class="medium-6 columns">
							<label for="">Adress street</label>
							<div>
								<input type="text" name="invoice_ad_street" value="<?php if(isset($data['info'][0]['ad_street'])){ echo $data['info'][0]['ad_street']; } ?>" required >
							</div>
						</div>
					</div>
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">City</label>
							<div>
								<input type="text" name="invoice_ad_city" value="<?php if(isset($data['info'][0]['ad_city'])){ echo $data['info'][0]['ad_city']; } ?>" required >
							</div>
						</div>
						<div class="medium-6 columns">
							<label for="">ZIP</label>
							<div>
								<input type="text" name="invoice_ad_zipcode" value="<?php if(isset($data['info'][0]['ad_zipcode'])){ echo $data['info'][0]['ad_zipcode']; } ?>" required >
							</div>
						</div>
					</div>
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">Country</label>
							<div>
								<input type="text" name="invoice_ad_country" value="<?php if(isset($data['info'][0]['ad_country'])){ echo $data['info'][0]['ad_country']; } ?>" required >
							</div>
						</div>
						<div class="medium-6 columns">
							<label for="">Phone number</label>
							<div>
								
								<input class="input-large focused" name="phone_number" id="phone_number" type="text" title="The phone number must be between 6 and 14 numbers and begin with a &quot;+&quot;." value="<?php if(isset($data['phone'][0]['phone_num'])){ echo $data['phone'][0]['phone_num']; } ?>" pattern="^\+(?:[0-9]?){6,14}[0-9]$" placeholder="+33xxxxxxx">
							</div>
						</div>
					</div><div class="clearfix">
						<div class="medium-6 columns">
							<label for="">Email</label>
							<div>
								<input type="email" name="user_mail" value="<?php if(isset($data['user'][0]['user_mail'])){ echo $data['user'][0]['user_mail']; } ?>" required >
							</div>
						</div>
						<?php if(!isset($_SESSION['connect_compte_FRONT']) || $_SESSION['connect_compte_FRONT'] == false) {?>
						<div class="medium-6 columns">
							<label for="">Password</label>
							<div>
								<input type="password" name="user_password">
							</div>
						</div>
						<?php } ?>
					</div>
					
					<div class="clearfix">
						<div class="medium-6 columns">
							<label for="">Website</label>
							<div>
								<input type="text" name="user_site" value="<?php if(isset($data['user'][0]['user_site'])){ echo $data['user'][0]['user_site']; } ?>"  required >
							</div>
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
				<a href="<?php echo MODULE . 'cart' . ACTION . 'seeonecart'; ?>" class="before" >Precedent</a>
				<input class="help" type="submit" value="Continue">
			</div>
		</form>
	</div>
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>