<? include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['project']) && !empty($data['project']) ){ $project = $data['project']; } ?>
<?php var_dump($project); ?>

	<div class="see-team clearfix">
		<div class="clearfix contain-team">

				<div class="medium-8 columns team-info">
						<div class="cover"></div>
						<h2 class="team-title"><?php echo $project['group_name']; ?></h2>
						<div>
							<span class="icon-event"></span>
							<span class="title-event"></span>
						</div>
						<div>
							<span class="icon-calendar"></span>
							<span class="date-event"></span>
						</div>
				</div>

				<div class="show-for-small-only team-sponsor">
					<h1>Team progress</h1>
					<div class="clearfix">
						<span class="small-4 columns goal"><?php echo $project['group_money']; ?></span>
						<span class="small-4 columns funded">43 %</span>
						<span class="small-4 columns number-sponsor">8 compagnies</span>
						<span class="small-4 columns days-left">58 days left</span>
					</div>
					<div class="progress-team"></div>
					<a href="" class="button help">Help them</a>
				</div>

				<div class="medium-4 show-for-large-up columns list-sponsor">
					<h1 class="">They helped them</h1>
					<div class="column small-3">
						<img src="" alt="">
					</div>
					<div class="column small-3">
						<img src="" alt="">
					</div>
					<div class="column small-3">
						<img src="" alt="">
					</div>
					<div class="column small-3"></div>
				</div>

				<div class="medium-4 show-for-large-up columns team-sponsor">
					<h1>Team progress</h1>
					<div class="clearfix">
						<span class="small-4 columns goal">2 500 €</span>
						<span class="small-4 columns funded">43 %</span>
						<span class="small-4 columns number-sponsor">8 compagnies</span>
						<span class="small-4 columns days-left">58 days left</span>
					</div>
					<div class="progress-team"></div>
					<a href="" class="button help">Help them</a>
				</div>

				<div class="clearfix">
					<div class="global-desc-team medium-9 clearfix">

						<div class="presentation-team medium-6 columns">
							<h1>Our team</h1>
							<p class="desc"></p>

							<div class="clearfix">
								<div class="small-4 columns">
									<img src="" alt="">
								</div>
								<div class="small-4 columns">
									<img src="" alt="">
								</div>
								<div class="small-4 columns">
									<img src="" alt="">
								</div>
							</div>

						</div>

						<div class="project-team medium-6 columns">
							<h1>Our project</h1>
							<p class="desc"></p>
						</div>

						<div class="goal-team medium-6 columns">
							<h1>Our goal</h1>
							<p class="desc"></p>
						</div>

						<div class="budget-team medium-6 columns">
							<h1>Our budget</h1>
							<p class="desc"></p>
						</div>
					</div>

					<div class="place-sponsor medium-3 columns">
						<div>
							<h1>Choose your emplacement for your logo</h1>
						</div>
						<div>
							<span>Your contribution will be automatically refunded if the project doesn't funded</span>
						</div>
						<div>
							<h2>For 100 €</h2>
							<span></span>
						</div>
						<div>
							<h2>For 300 €</h2>
							<span></span>
						</div>
						<div>
							<h2>For 600 €</h2>
							<span></span>
						</div>
						<div>
							<h2>For 1200 €</h2>
							<span></span>
						</div>
						<div>
							<h2>Other donations</h2>
							<span></span>
						</div>
					</div>
				</div>
		</div>
	</div>

<? include(ROOT . "view/layout/footer.inc.php"); ?>
