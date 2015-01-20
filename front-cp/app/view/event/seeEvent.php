<? include(ROOT . "view/layout/header.inc.php"); ?>
<? if(isset($data['events']) && !empty($data['events']) ){ $events = $data['events']; } ?>
<div class="list-events">
	<div class="head clearfix">
		<h1>Dynamics and charity challenges</h1>
		<p class="medium-8">Find any best sports events specially reserved for the students with the aim of helping charitable and humanitarian associations. Begin your adventure by joining an event or by creating your !</p>
		<div class="medium-9 clearfix">
			<span class="columns medium-6 number-events">45 events</span>
			<div class="columns medium-6 pagination">Page <span>1 </span>2 3</div>
		</div>
	</div>

	<div class="main-contain clearfix">
		<div class="sidebar-sort medium-3 columns">
			<h2>Search and sort</h2>
			<form class="search-bar" method="get" action="">
				<input type="text" size="21">
				<div class="number-teams">
					<span>Number of teams</span>
					<div>
						<input type="checkbox" name="1-15" value="1-15"> 1-15
					</div>
					<div>
						<input type="checkbox" name="15-50" value="15-50"> 15-50
					</div>
					<div>
						<input type="checkbox" name="+50" value="+50"> More than 50
					</div>
				</div>

				<div class="begin-race">
					<span>Beginning of the race</span>
					<div>
						<input type="checkbox" name="-1 week" value="-1 week"> Less of one week
					</div>
					<div>
						<input type="checkbox" name="2-3 week" value="2-3 week"> 2-3 weeks
					</div>
					<div>
						<input type="checkbox" name="+1month" value="+1month"> More than one month
					</div>
					<div>
						<input type="checkbox" name="+6month" value="+6month"> More than 6 months
					</div>
				</div>

				<div class="kind-race">
					<span>Kind of race</span>
					<div>
						<input type="checkbox" name="earth" value="earth"> Earth
					</div>
					<div>
						<input type="checkbox" name="sea" value="sea"> Sea
					</div>
					<div>
						<input type="checkbox" name="air" value="air"> Air
					</div>
					<div>
						<input type="checkbox" name="car" value="car"> Car
					</div>
					<div>
						<input type="checkbox" name="boat" value="boat"> Boat
					</div>
					<div>
						<input type="checkbox" name="surf" value="surf"> Surf
					</div>
					<div>
						<input type="checkbox" name="bike" value="bike"> Bike
					</div>
				</div>
			</form>
		</div>
		<div class="events medium-9 columns">
		<? foreach($events as $k => $e){ ?>
			<div class="clearfix">
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/vignette-event-4l.png">
						</div>
						<div class="infos medium-6 columns">
							<h2>4L trophy</h2>
							<span>32nd edition</span>
							<span>2015, July 5th</span>
						</div>
						<div class="medium-6 columns teams">
							<h3>12 teams</h3>
							<a href="<? echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . '1'; ?>" class="button-submit">Let's see this event !</a>
						</div>
					</div>
				</div>
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/vignette-event-edhec-sea.png">
						</div>
						<div class="infos medium-6 columns">
							<h2>EDHEC Trophy sea race</h2>
							<span>12nd edition</span>
							<span>2015, May 4th</span>
						</div>

						<div class="medium-6 columns teams">
							<h3>11 teams</h3>
							<a href="<? echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . '2'; ?>" class="button-submit">Let's see this event !</a>
						</div>
					</div>
				</div>
			</div>
			<? } ?>
			<div class="clearfix">
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/vignette-event-edhec-earth.png">
						</div>
						<div class="infos medium-6 columns">
							<h2>EDHEC Trophy earth race</h2>
							<span>12nd edition</span>
							<span>2015, May 24th</span>
						</div>

						<div class="medium-6 columns teams">
							<h3>8 teams</h3>
							<a href="" class="button-submit">Let's see this event !</a>
						</div>
					</div>
				</div>
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/ready.jpg" alt="">
						</div>
						<div class="medium-6 columns adventure">
							<a href="" class="button-submit">Ready for your adventure ?</a>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

</div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>