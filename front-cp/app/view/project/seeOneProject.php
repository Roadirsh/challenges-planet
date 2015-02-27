<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['project']) && !empty($data['project']) ){ $project = $data['project']; } ?>
<?php if(isset($data['sponsors'][0]) && !empty($data['sponsors'][0]) ){ $sponsors = $data['sponsors']; } ?>
<?php if(isset($data['users'][0]) && !empty($data['users'][0]) ){ $users = $data['users']; } ?>
<?php /** Funded % maganement **/ ?>
<?php $percent = number_format(($project['group_given'] / $project['group_money']) *100, 0); ?> 
<?php /** If they have more then asked **/ ?>
<?php if($percent > 100){ $percent = 100;} ?>
<?php $nbSponsor = count($data); ?>
<?php /** Pural management **/ ?>
<?php if($nbSponsor < 2){ $Cie = "Compagnie" ; } else { $Cie = "Compagnies"; } ?>


<form id="choose" class="mfp-hide white-popup-block" method="post" action="">
	<h2>Choose your amount to sponsorise the team !</h2>
	<div>
		<input type="radio" name="donut" value="100" > 100 €
	</div>
	<div>
		<input type="radio" name="donut" value="300"> 300 €
	</div>
	<div>
		<input type="radio" name="donut" value="600"> 600 €
	</div>
	<div>
		<input type="radio" name="donut" value="1200"> 1200 €
	</div>
	<div>
		<input type="radio" name="donut" value="Other"> Other Donation
		<input type="number" name="donut-plus" value="">
	</div>
	<input type="submit" class="join" value="Help this team !" />
</form>


	<div class="see-team clearfix">
		<div class="clearfix contain-team">
			<div class="clearfix">

				<div class="large-5 medium-6 columns team-info">
					<div class="wrapper">
						<div class="cover">
							<img src="<?php echo PROJECT . $project['group_img']; ?>" alt="">
						</div>
						<h2 class="team-title"><?php echo $project['group_name']; ?></h2>
						<div>
							<span class="icon-event">
								<img src="img/icon-car.png" alt="">
							</span>
							<span class="title-event"><?php echo $project['event_name']; ?></span>
						</div>
						<div>
							<span class="icon-calendar">
								<img src="img/icon-calendar.png" alt="">
							</span>
							<span class="date-event"><?php echo formDate($project['event_begin'], 0); ?> - <?php echo formDate($project['event_end'], 0); ?></span>
						</div>
						<div>
							<span class="location">
								<span class="icon-location">
									<img src="img/icon-location.png" alt="">
								</span>
								<span class="country"><?php echo ucfirst($project['event_location']); ?></span>
							</span>
						</div>						
					</div>

				</div>

				<div class="show-for-small-only columns medium-8 team-sponsor">
					<div class="wrapper clearfix">
						<h1>Team progress</h1>
						<div class="clearfix">
							<span class="small-3 columns goal"><span class="bold"><?php echo $project['group_money']; ?> €</span> Goal</span>
							<span class="small-3 columns funded"><span class="bold"><?php echo $percent; ?> %</span> Funded</span>
							<span class="small-3 columns number-sponsor"><span class="bold"><?php echo $nbSponsor; ?></span> <?php echo $Cie; ?></span>
							<span class="small-3 columns days-left"><span class="bold">58</span> <br/>Days</span>
						</div>
						<div class="progress-team"></div>
						<a href="#choose" class="popup-with-form button help">Help them !</a>
					</div>
				</div>

				<div class="large-4 medium-6 columns list-sponsor">
					<div class="wrapper clearfix">
						<h1 class="">They helped them</h1>
						<?php if(!empty($sponsors[0])){ ?>
							<?php $i = 0; ?>
							<?php if($i < 3){
								foreach ($sponsors as $key => $spon) { ?>
									<a class="columns medium-6" href="">
										<img src="<?php echo AVATAR . $spon['user_profil_pic']; ?>" alt="">
									</a>
								<?php $i ++; } ?>
							<?php } ?>
						<?php } ?>
						<?php if(!empty($sponsors[0])){ ?>
							<a class="popup-with-form columns medium-6" href="#list-compagnies">
								<span class="bold">+ 3</span>
								<span>others compagnies</span>
							</a>
						<?php } ?>
					</div>
				</div>

				<div id="list-compagnies" class="mfp-hide white-popup-block clearfix">
				<?php if(!empty($sponsors[0])){ ?>
					<?php $i = 0; ?>
					<?php foreach ($sponsors as $key => $spon) { ?>
						<div class="medium-4 columns">
							<img src="<?php echo AVATAR . $spon['user_profil_pic']; ?>" alt="">
						</div>
					<?php $i ++; } ?>
				<?php } ?>
				</div>

				<div class="large-3 medium-12 show-for-medium-up columns team-sponsor">
					<div class="wrapper clearfix">
						<h1>Team progress</h1>
						<div class="clearfix">
							<span class="large-6 medium-3 columns goal"><span class="bold"><?php echo $project['group_money']; ?> €</span> Goal</span>
							<span class="large-6 medium-3 columns funded"><span class="bold"><?php echo $percent; ?> %</span> Funded</span>
							<span class="large-6 medium-3 columns number-sponsor"><span class="bold"><?php echo $nbSponsor; ?></span> <?php echo $Cie; ?></span>
							<span class="large-6 medium-3 columns days-left">
								<span class="bold">
									<?php $diff = (new DateTime('now'))->diff(new DateTime($project['event_end'])); ?>
                                    <?php echo $diff->format('%a'); //%a take the lot Y-m-d ?>
								</span><br/>Days
							</span>
						</div>
						<div class="progress-team notyet" data="<?php echo $percent; ?>"></div>
						<a href="#choose" class="popup-with-form button help">Help them !</a>
					</div>
				</div>

			</div>

			<div class="clearfix">
					<div class="global-desc-team medium-9 columns clearfix">

						<div class="clearfix">
							<div class="presentation-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our team</h1>
									<p class="desc">
										<?php echo $project['group_descr']; ?>
									</p>
								</div>
							</div>

							<div class="project-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our members</h1>
									<p class="desc">
										<ul class="list-members">
										<?php foreach ($users as $key => $user) { ?>
											<li>
												<img src="<?php echo AVATAR . $user['user_profil_pic']; ?>" alt="">
												<span class="name-user"><?php echo $user['user_pseudo']; ?></span>
											</li>
										<?php } ?>
											
										</ul>
									</p>								
								</div>
							</div>
						</div>

						<div class="clearfix">
							<div class="goal-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our goal</h1>
									<p class="desc">
										<?php echo $project['group_project']; ?>
									</p>								
								</div>
							</div>

							<div class="budget-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our budget</h1>
									<p class="desc">
										<?php echo $project['group_budget']; ?>
									</p>								
								</div>
							</div>							
						</div>

					</div>

					<div class="place-sponsor medium-3 columns">
						<div class="wrapper">
							<div>
								<h1>Choose your emplacement for your logo</h1>
							</div>
							<div class="money">
								<p>To assure the good running of our service, we inform to you that we take 10 % in every paid donation. </p> 
								<p>If all the expenses of maintenance as well as the payment of our employees is made and that we have some money moreover, the latter is put back to the teams which need it.</p>
							</div>
							<div>
								<h2>For 100 €</h2>
								<span>Your logo will be present but will little put forward.</span>
							</div>
							<div>
								<h2>For 300 €</h2>
								<span>Your logo will be visible on small parts of the means of transportation of the race</span>
							</div>
							<div>
								<h2>For 600 €</h2>
								<span>Your logo will be highlighted on the average parts of the means of transportation of the race.</span>
							</div>
							<div>
								<h2>For 1200 €</h2>
								<span>Your logo will be very well highlighted and will be one of the biggest.</span>
							</div>
							<div>
								<h2>Other donations</h2>
								<span>Thank you for your help, which imports the amount it will be valued by the event!</span>
							</div>
							<div>
								<span class="contribution">Your contribution will be automatically refunded if the project doesn't funded</span>
							</div>							
						</div>
					</div>
			</div>
		</div>
	</div>

<? include(ROOT . "view/layout/footer.inc.php"); ?>
