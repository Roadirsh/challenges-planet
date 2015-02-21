<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['project']) && !empty($data['project']) ){ $project = $data['project']; } ?>


<form id="choose" class="mfp-hide white-popup-block">
	<h2>Choose your amount to sponsorise the team !</h2>
	<div>
		<input type="radio" name="for 100" value="For 100 €"> 100 €
	</div>
	<div>
		<input type="radio" name="for 300" value="For 300 €"> 300 €
	</div>
	<div>
		<input type="radio" name="for 600" value="For 600 €"> 600 €
	</div>
	<div>
		<input type="radio" name="for 1200" value="For 1200 €"> 1200 €
	</div>
	<div>
		<input type="radio" name="other" value="other"> Other Donation
		<input type="number">
	</div>
	<a class="join" href="">Help this team !</a>
</form>


	<div class="see-team clearfix">
		<div class="clearfix contain-team">
			<div class="clearfix">

				<div class="large-5 medium-6 columns team-info">
					<div class="wrapper">
						<div class="cover">
							<img src="img/girlz.jpg" alt="">
						</div>
						<h2 class="team-title"><?php echo $project['group_name']; ?></h2>
						<div>
							<span class="icon-event">
								<img src="img/icon-car.png" alt="">
							</span>
							<span class="title-event">4L Trophy</span>
						</div>
						<div>
							<span class="icon-calendar">
								<img src="img/icon-calendar.png" alt="">
							</span>
							<span class="date-event">date beginning - date ending</span>
						</div>
						<div>
							<span class="location">
								<span class="icon-location">
									<img src="img/icon-location.png" alt="">
								</span>
								<span class="country">France, tamersurville</span>
							</span>
						</div>						
					</div>

				</div>

				<div class="show-for-small-only columns medium-8 team-sponsor">
					<div class="wrapper clearfix">
						<h1>Team progress</h1>
						<div class="clearfix">
							<span class="small-3 columns goal"><span class="bold"><?php echo $project['group_money']; ?> €</span> Goal</span>
							<span class="small-3 columns funded"><span class="bold">43 %</span> Funded</span>
							<span class="small-3 columns number-sponsor"><span class="bold">8</span> Compagnies</span>
							<span class="small-3 columns days-left"><span class="bold">58</span> <br/>Days</span>
						</div>
						<div class="progress-team"></div>
						<a href="#choose" class="popup-with-form button help">Help them !</a>
					</div>
				</div>

				<div class="large-4 medium-6 columns list-sponsor">
					<div class="wrapper clearfix">
						<h1 class="">They helped them</h1>
						<a class="columns medium-6" href="">
							<img src="img/organism/marque1.jpg" alt="">
						</a>
						<a class="columns medium-6" href="">
							<img src="img/organism/marque2.jpg" alt="">
						</a>
						<a class="columns medium-6" href="">
							<img src="img/organism/marque3.jpg" alt="">
						</a>
						<a class="popup-with-form columns medium-6" href="#list-compagnies">
							<span class="bold">+ 3</span>
							<span>others compagnies</span>
						</a>
					</div>
				</div>

				<div id="list-compagnies" class="mfp-hide white-popup-block clearfix">
					<div class="medium-4 columns">
						<img src="img/organism/marque1.jpg" alt="">
					</div>
					<div class="medium-4 columns">
						<img src="img/organism/marque2.jpg" alt="">
					</div>
					<div class="medium-4 columns">
						<img src="img/organism/marque3.jpg" alt="">
					</div>
					<div class="medium-4 columns">
						<img src="img/organism/marque4.jpg" alt="">
					</div>
					<div class="medium-4 columns">
						<img src="img/organism/marque5.jpg" alt="">
					</div>
					<div class="medium-4 columns">
						<img src="img/organism/marque6.jpg" alt="">
					</div>
				</div>

				<div class="large-3 medium-12 show-for-medium-up columns team-sponsor">
					<div class="wrapper clearfix">
						<h1>Team progress</h1>
						<div class="clearfix">
							<span class="large-6 medium-3 columns goal"><span class="bold"><?php echo $project['group_money']; ?> €</span> Goal</span>
							<span class="large-6 medium-3 columns funded"><span class="bold">43 %</span> Funded</span>
							<span class="large-6 medium-3 columns number-sponsor"><span class="bold">8</span> Compagnies</span>
							<span class="large-6 medium-3 columns days-left"><span class="bold">58</span> <br/>Days</span>
						</div>
						<div class="progress-team"></div>
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
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius justo vitae est sagittis, luctus semper nunc elementum. Mauris fringilla ipsum ut quam malesuada gravida. 
									</p>

									<div class="clearfix">
										<div class="small-4 columns">
											<img src="img/avatar.png" alt="">
											<span class="name-user">Fabrice</span>
										</div>
										<div class="small-4 columns">
											<img src="img/avatar2.png" alt="">
											<span class="name-user">Clothide</span>
										</div>
										<div class="small-4 columns">
											<img src="img/avatar3.png" alt="">
											<span class="name-user">Sophie</span>
										</div>
									</div>							
								</div>
							</div>

							<div class="project-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our project</h1>
									<p class="desc">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius justo vitae est sagittis, luctus semper nunc elementum. Mauris fringilla ipsum ut quam malesuada gravida. Proin quis tempus justo. Suspendisse sit amet blandit arcu. Nam faucibus augue lorem. Integer in sapien quis velit sagittis euismod. Nulla sollicitudin ornare orci vitae vestibulum. Aliquam imperdiet felis vel urna euismod, eget tempus lacus scelerisque. Morbi a auctor est. Integer vel facilisis tellus. Pellentesque sed nisi lacus. Phasellus euismod imperdiet augue nec placerat.
									</p>								
								</div>
							</div>
						</div>

						<div class="clearfix">
							<div class="goal-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our goal</h1>
									<p class="desc">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius justo vitae est sagittis, luctus semper nunc elementum. Mauris fringilla ipsum ut quam malesuada gravida. Proin quis tempus justo. Suspendisse sit amet blandit arcu. Nam faucibus augue lorem. Integer in sapien quis velit sagittis euismod. Nulla sollicitudin ornare orci vitae vestibulum. Aliquam imperdiet felis vel urna euismod, eget tempus lacus scelerisque. Morbi a auctor est. Integer vel facilisis tellus. Pellentesque sed nisi lacus. Phasellus euismod imperdiet augue nec placerat.
									</p>								
								</div>
							</div>

							<div class="budget-team medium-12 large-6 columns">
								<div class="wrapper">
									<h1>Our budget</h1>
									<p class="desc">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius justo vitae est sagittis, luctus semper nunc elementum. Mauris fringilla ipsum ut quam malesuada gravida. Proin quis tempus justo. Suspendisse sit amet blandit arcu. Nam faucibus augue lorem. Integer in sapien quis velit sagittis euismod. Nulla sollicitudin ornare orci vitae vestibulum. Aliquam imperdiet felis vel urna euismod, eget tempus lacus scelerisque. Morbi a auctor est. Integer vel facilisis tellus. Pellentesque sed nisi lacus. Phasellus euismod imperdiet augue nec placerat.
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
