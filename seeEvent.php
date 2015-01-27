<? include(ROOT . "view/layout/header.inc.php"); ?>
<? if(isset($data['events']) && !empty($data['events']) ){ $events = $data['events']; } ?>
<? if(isset($data['type']) && !empty($data['type']) ){ $tpe = $data['type']; } ?>
<? if(isset($data['nb_team']) && !empty($data['nb_team']) ){ $nbteam = $data['nb_team']; } ?>
<div class="list-events">
	<div class="head clearfix">
		<h1>Dynamics and charity challenges</h1>
		<p class="medium-8">Find any best sports events specially reserved for the students with the aim of helping charitable and humanitarian associations. Begin your adventure by joining an event or by creating your !</p>
		<div class="medium-9 clearfix">
			<span class="columns medium-6 number-events">
			    <? if(isset($events[0]) && !empty($events[0])){ ?>
			        <? if(count($events) == 1){ echo count($events) . ' event for : '; 
			        } else {echo count($events) . ' events for : '; } ?>
                <? } ?>
                <? if(isset($tpe) && !empty($tpe)){ ?>
                    <span class="active"><? echo ucfirst($tpe); ?></span>
                <? } elseif(isset($nbteam) && !empty($nbteam)){ ?>
                    <span class="active"><? echo $nbteam; ?></span>
                <? }?>
			</span>
			<div class="columns medium-6 pagination">Page <span>1 </span>2 3</div>
		</div>
	</div>

	<div class="main-contain clearfix">
		<div class="sidebar-sort medium-3 columns">
			<h2>Search and sort</h2>
			<form class="search-bar" method="post" action="">
				<input type="text" size="21">
				
				<div class="number-teams">
					<span>Number of teams</span>
					<div <? if(isset($nbteam) && $nbteam =='1-15'){ ?> class="active" <? }?>>
						<input type="checkbox" name="nb_team" value="1-15" onclick='submit();'> 1-15
					</div>
					<div <? if(isset($nbteam) && $nbteam =='15-50'){ ?> class="active" <? }?>>
						<input type="checkbox" name="nb_team" value="15-50" onclick='submit();'> 15-50
					</div>
					<div <? if(isset($nbteam) && $nbteam =='+50'){ ?> class="active" <? }?>>
						<input type="checkbox" name="nb_team" value="+50" onclick='submit();'> More than 50
					</div>    
				</div>
				
				<div class="begin-race">
					<span>Beginning of the race</span>
					<div>
						<input type="checkbox" name="begin" value="-1 week" onclick='submit();'> Less of one week
					</div>
					<div>
						<input type="checkbox" name="begin" value="2-3 week" onclick='submit();'> 2-3 weeks
					</div>
					<div>
						<input type="checkbox" name="begin" value="+1month" onclick='submit();'> More than one month
					</div>
					<div>
						<input type="checkbox" name="begin" value="+6month" onclick='submit();'> More than 6 months
					</div>
				</div>

				<div class="kind-race">
					<span>Kind of race</span>
					<div <? if(isset($tpe) && $tpe =='earth'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="earth" onchange='submit();'> Earth
					</div>
					<div <? if(isset($tpe) && $tpe  =='sea'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="sea" onchange='submit();'> Sea
					</div>
					<div <? if(isset($tpe) && $tpe  =='air'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="air" onchange='submit();'> Air
					</div>
					<div <? if(isset($tpe) && $tpe  =='car'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="car" onchange='submit();'> Car
					</div>
					<div <? if(isset($tpe) && $tpe  =='boat'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="boat" onchange='submit();'> Boat
					</div>
					<div <? if(isset($tpe) && $tpe  =='surf'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="surf" onchange='submit();'> Surf
					</div>
					<div <? if(isset($tpe) && $tpe  =='bike'){ ?> class="active" <? }?>>
						<input type="checkbox" name="type" value="bike" onchange='submit();'> Bike
					</div>
				</div>
			</form>
		</div>
		<div class="events medium-9 clearfix columns">
		<? if(isset($events[0]) && !empty($events[0]) ){ ?>
		<? foreach($events as $k => $e){ ?>
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/event/<? echo $e['event_img']; ?>">
						</div>
						<div class="infos medium-6 columns">
							<h2><? echo $e['event_name']; ?></h2>
							<span><b><? echo $e['event_type']; ?></b> race</span>
							<small><? echo formDate($e['event_begin'], 0); ?> - <? echo formDate($e['event_end'], 0); ?></small>
						</div>
						<div class="medium-6 columns teams">
						    <? if($e['event_nb_team'] == 0){ $team = 'no teams yet'; } ?>
						    <? if($e['event_nb_team'] == 1){ $team = $e['event_nb_team'] . ' team'; } ?>
						    <? if($e['event_nb_team'] > 1){ $team = $e['event_nb_team'] . ' teams'; } ?>
							<h3><? echo $team; ?></h3>
							<a href="<? echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $e['event_id']; ?>" class="button-submit">Let's see this event !</a>
						</div>
					</div>
				</div>
			<? } ?>
			<? } else { ?>
			    <div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/gogo.gif">
						</div>
						<div class="infos medium-6 columns">
							<h2>Sorry</h2>
							<span>No events for this request</span>
						</div>
						<div class="medium-6 columns teams">
							<a href="<? echo MODULE . 'event' . ACTION . 'seeevent' ?>" class="button-submit">Back to all events</a>
						</div>
					</div>
				</div>
            <? } ?>
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img medium-6 columns">
							<img src="img/ready.jpg" alt="">
						</div>
						<div class="medium-6 columns adventure">
							<a href="<? echo MODULE . 'event' . ACTION . 'addevent'; ?>" class="button-submit">Ready for your adventure ?</a>
						</div>
					</div>
				</div>

			
		</div>
	</div>

</div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>