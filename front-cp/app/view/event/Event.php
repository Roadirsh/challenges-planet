<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php if(isset($data['events']) && !empty($data['events']) ){ $events = $data['events']; } ?>
<?php if(isset($data['type']) && !empty($data['type']) ){ $tpe = $data['type']; } ?>
<?php if(isset($data['nb_team']) && !empty($data['nb_team']) ){ $nbteam = $data['nb_team']; } ?>

		<div class="list-events clearfix">
			<div class="head clearfix">
				<div class="medium-4 large-3 columns">
					<img src="img/img-event-4ltrophy.png" alt="">
				</div>
				<div class="medium-8 large-9 columns">
					<h1>4L Trophy</h1>
					<p>The largest student strike in Europe ! Marrakech, the final destination of a journey of 10 days and almost 6000 km on the roads of France, Spain and Morocco.</p>
					<div class="clearfix">
						<div class="medium-4 columns location"><span>Location :</span> Europe</div>
						<div class="medium-4 columns date-begin"><span>Date from :</span> 01/03/2015</div>
						<div class="medium-4 columns date-finish"><span>Date to :</span> 13/04/2015</div>
					</div>
					<span class="medium-12 number-teams-event">12 teams</span>
				</div>
			</div>

			<div class="main-contain clearfix">
				<a href="#form-search" class="hide-for-large-up show-for-small-up popup-with-form sidebar-sort-mobile">Search and sort</a>
				<form id="form-search" class="search-bar mfp-hide white-popup-block" method="posst" action="">
					<input type="text" size="21">
						
						<div class="team-progress">
							<span>Team Progress</span>
							<div>
								<input type="checkbox" name="need-help" value="need-help" onclick='submit();'> Help them, they need you !
							</div>
							<div>
								<input type="checkbox" name="almost" value="almost" onclick='submit();'> Just a little bit of help !
							</div>
							<div>
								<input type="checkbox" name="done" value="done" onclick='submit();'> It's Done ! Thank you !
							</div>    
						</div>
						
						<div class="team-budget">
							<span>Budget</span>
							<div>
								<input type="checkbox" name="budget" value="2000" onclick='submit();'> From to 2000 €
							</div>
							<div>
								<input type="checkbox" name="budget" value="6000" onclick='submit();'> From to 6000 €
							</div>
							<div>
								<input type="checkbox" name="budget" value="10 000" onclick='submit();'> From to 10 000 €
							</div>
						</div>

				</form>
				<div class="show-for-large-up sidebar-sort medium-3 columns">
					<h2>Search and sort</h2>
					<form class="search-bar" method="post" action="">
						<input type="text" size="21">
						
						<div class="team-progress">
							<span>Team Progress</span>
							<div>
								<input type="checkbox" name="need-help" value="need-help" onclick='submit();'> Help them, they need you !
							</div>
							<div>
								<input type="checkbox" name="almost" value="almost" onclick='submit();'> Just a little bit of help !
							</div>
							<div>
								<input type="checkbox" name="done" value="done" onclick='submit();'> It's Done ! Thank you !
							</div>    
						</div>
						
						<div class="team-budget">
							<span>Budget</span>
							<div>
								<input type="checkbox" name="budget" value="2000" onclick='submit();'> From to 2000 €
							</div>
							<div>
								<input type="checkbox" name="budget" value="6000" onclick='submit();'> From to 6000 €
							</div>
							<div>
								<input type="checkbox" name="budget" value="10 000" onclick='submit();'> From to 10 000 €
							</div>
						</div>
						
					</form>
				</div>
				<div class="teams large-9 medium-12 clearfix columns">
					<div class="team-wrapper columns medium-4">
						<div class="wrapper done">
							<div class="img">
								<img src="img/team1.jpg" alt="">
								<div class="hover done">
									<span>It's done thank you !</span>
								</div>
							</div>
							<div class="title-team">Parisian Challenge</div>
							<div class="chief-team">Julien Michout</div>
							<div class="date">Oct 23, 2014</div>
							<div class="progressteam">
								<span class="validate"></span>
								<div class="number"><span>100 %</span><br>goal reached !</div>
								<div id="progressteam1" class="good"></div>
							</div>
						</div>
					</div>

					<div class="team-wrapper columns medium-4">
						<div class="wrapper">
							<div class="img">
								<img src="img/team2.jpg" alt="">
								<div class="hover">
									<span>They need you<br>help them</span>
								</div>
							</div>
							<div class="title-team">SPI Dauphine Boyzz</div>
							<div class="chief-team">Eric Loiseau</div>
							<div class="date">Nov 14, 2014</div>
							<div class="progressteam">
								<div class="clearfix">
									<div class="columns medium-4 small-4 numbers"><span>3900 €</span><br>goals</div>
									<div class="columns medium-4 small-4 funded"><span>95 %</span><br>funded</div>
									<div class="columns medium-4 small-4 daysleft"><span>2</span><br>days left</div>
								</div>
								<div id="progressteam2" class="notyet"></div>
							</div>
						</div>
					</div>

					<div class="team-wrapper columns medium-4">
						<div class="wrapper">
							<div class="img">
								<img src="img/team2.jpg" alt="">
								<div class="hover">
									<span>They need you<br>help them</span>
								</div>
							</div>
							<div class="title-team">SPI Dauphine Boyzz</div>
							<div class="chief-team">Eric Loiseau</div>
							<div class="date">Nov 14, 2014</div>
							<div class="progressteam">
								<div class="clearfix">
									<div class="columns medium-4 small-4 numbers"><span>3900 €</span><br>goals</div>
									<div class="columns medium-4 small-4 funded"><span>95 %</span><br>funded</div>
									<div class="columns medium-4 small-4 daysleft"><span>2</span><br>days left</div>
								</div>
								<div id="progressteam2" class="notyet"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="medium-12 pagination">
				<a class="previous-link" href="">&lt;</a>
				<a class="select">1 </a>
				<a>2</a>
				<a>3</a>
				<a class="next-link" href="">&gt;</a>
			</div>

		</div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>