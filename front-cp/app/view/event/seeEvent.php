<?php include(ROOT . "view/layout/header.inc.php"); ?>
<?php if(isset($data['events']) && !empty($data['events']) ){ $events = $data['events']; } ?>
<?php if(isset($data['type']) && !empty($data['type']) ){ $tpe = $data['type']; } ?>
<?php if(isset($data['nb_team']) && !empty($data['nb_team']) ){ $nbteam = $data['nb_team']; } ?>
<?php if(isset($data['search'])){ $search = $data['search']; } ?>
<?php if(isset($data['begin']) && !empty($data['begin']) ){ $begin = $data['begin']; } ?>
<?php if(isset($data['count']) && !empty($data['count']) ){ $count = $data['count']; } ?>

<div class="list-events clearfix">
	<div class="head clearfix">
		<h1>Dynamics and charity challenges</h1>
		<p class="medium-8">Find any best sport events specially reserved for the students with the aim of helping charitable and humanitarian associations. Begin your adventure by joining an event or by creating yours !</p>
		<span class="medium-12 number-events">
			    <?php if(isset($events) && !empty($events)){ 
			        	echo titleEvent($count['count'], $search, 'event'); // count || array search || title;
			        } elseif(!empty($search[1] )){ 
			        	echo "Sorry, we don't have any projects for <span class='active'>'" . $search[1] . "'</span>";  
			        } else {
			        	echo "Sorry, we don't have any events at all</span>";
			    	} ?>
                <?php if(isset($tpe) && !empty($tpe)){ ?>
                    <span class="active"><?php echo ucfirst($tpe); ?></span>
                <?php } elseif(isset($nbteam) && !empty($nbteam)){ ?>
                    <span class="active"><?php echo $nbteam; ?></span>
                <?php }?>
		</span>
	</div>

	<div class="main-contain clearfix">
		<a href="#form-search" class="hide-for-large-up show-for-small-up popup-with-form sidebar-sort-mobile">Search and sort</a>
		<form id="form-search" class="search-bar mfp-hide white-popup-block" method="post" action="<?php echo MODULE . 'event' . ACTION . 'seeevent'; ?>">
			<input type="text" size="21">
				
				<div class="number-teams">
					<span>Number of teams</span>
					<div <?php if(isset($nbteam) && $nbteam =='1-15'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="1-15" onclick='submit();'> 1-15
					</div>
					<div <?php if(isset($nbteam) && $nbteam =='15-50'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="15-50" onclick='submit();'> 15-50
					</div>
					<div <?php if(isset($nbteam) && $nbteam =='+50'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="+50" onclick='submit();'> More than 50
					</div>    
				</div>
				
				<div class="begin-race">
					<span>Beginning of the race</span>
					<div>
						<input type="checkbox" name="begin" value="1week" onclick='submit();'> Less of one week
					</div>
					<div>
						<input type="checkbox" name="begin" value="2-3week" onclick='submit();'> 2-3 weeks
					</div>
					<div>
						<input type="checkbox" name="begin" value="1month" onclick='submit();'> More than one month
					</div>
					<div>
						<input type="checkbox" name="begin" value="6month" onclick='submit();'> More than 6 months
					</div>
				</div>

				<div class="kind-race">
					<span>Kind of race</span>
					<div <?php if(isset($tpe) && $tpe =='earth'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="earth" onchange='submit();'> Earth
					</div>
					<div <?php if(isset($tpe) && $tpe  =='sea'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="sea" onchange='submit();'> Sea
					</div>
					<div <?php if(isset($tpe) && $tpe  =='air'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="air" onchange='submit();'> Air
					</div>
					<div <?php if(isset($tpe) && $tpe  =='car'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="car" onchange='submit();'> Car
					</div>
					<div <?php if(isset($tpe) && $tpe  =='boat'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="boat" onchange='submit();'> Boat
					</div>
					<div <?php if(isset($tpe) && $tpe  =='surf'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="surf" onchange='submit();'> Surf
					</div>
					<div <?php if(isset($tpe) && $tpe  =='bike'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="bike" onchange='submit();'> Bike
					</div>
				</div>
		</form>
		<div class="show-for-large-up sidebar-sort medium-3 columns">
			<h2>Search and sort</h2>
			<form class="search-bar" method="post" action="<?php echo MODULE . 'event' . ACTION . 'seeevent'; ?>">
				<input type="text" name="search" value="" > <!-- onclick='' -->
				
				<div class="number-teams">
					<span>Number of teams</span>
					<div <?php if(isset($nbteam) && $nbteam =='1-15'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="1-15" onclick='submit();'> 1-15
					</div>
					<div <?php if(isset($nbteam) && $nbteam =='15-50'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="15-50" onclick='submit();'> 15-50
					</div>
					<div <?php if(isset($nbteam) && $nbteam =='+50'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="nb_team" value="+50" onclick='submit();'> More than 50
					</div>    
				</div>
				
				<div class="begin-race">
					<span>Beginning of the race</span>
					<div>
						<input type="checkbox" name="begin" value="1week" onclick='submit();'> Less of one week
					</div>
					<div>
						<input type="checkbox" name="begin" value="2-3week" onclick='submit();'> 2-3 weeks
					</div>
					<div>
						<input type="checkbox" name="begin" value="1month" onclick='submit();'> More than one month
					</div>
					<div>
						<input type="checkbox" name="begin" value="6month" onclick='submit();'> More than 6 months
					</div>
				</div>

				<div class="kind-race">
					<span>Kind of race</span>
					<div <?php if(isset($tpe) && $tpe =='earth'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="earth" onchange='submit();'> Earth
					</div>
					<div <?php if(isset($tpe) && $tpe  =='sea'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="sea" onchange='submit();'> Sea
					</div>
					<div <?php if(isset($tpe) && $tpe  =='air'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="air" onchange='submit();'> Air
					</div>
					<div <?php if(isset($tpe) && $tpe  =='car'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="car" onchange='submit();'> Car
					</div>
					<div <?php if(isset($tpe) && $tpe  =='boat'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="boat" onchange='submit();'> Boat
					</div>
					<div <?php if(isset($tpe) && $tpe  =='surf'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="surf" onchange='submit();'> Surf
					</div>
					<div <?php if(isset($tpe) && $tpe  =='bike'){ ?> class="active" <?php }?>>
						<input type="checkbox" name="type" value="bike" onchange='submit();'> Bike
					</div>
				</div>
			</form>
		</div>
		<div class="events large-9 medium-12 clearfix columns">
		<?php if(isset($events[0]) && !empty($events[0]) ){ ?>
		<?php foreach($events as $k => $e){ ?>
				<div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div style="background:url('<?php echo EVENT . 'mini/' . $e['event_img']; ?>'); background-position: right;background-size: cover;" class="img large-6 medium-12 columns">
						</div>
						<div class="infos large-6 medium-12 columns">
							<h2><?php echo $e['event_name']; ?></h2>
							<span><b><?php echo $e['event_type']; ?></b> race</span>
							<span class="date"><?php echo formDate($e['event_begin'], 0); ?> - <?php echo formDate($e['event_end'], 0); ?></span>
						</div>
						<div class="medium-12 large-6 columns teams">
						    <?php if($e['event_nb_team'] == 0){ $team = 'no teams yet'; } ?>
						    <?php if($e['event_nb_team'] == 1){ $team = $e['event_nb_team'] . ' team'; } ?>
						    <?php if($e['event_nb_team'] > 1){ $team = $e['event_nb_team'] . ' teams'; } ?>
							<h3><?php echo $team; ?></h3>
							<a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $e['event_id']; ?>" class="button-submit">Let's see this event !</a>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php } else { ?>
			    <div class="event medium-6 columns">
					<div class="wrapper clearfix">
						<div class="img large-6 medium-12 columns">
							<img src="http://sd.keepcalm-o-matic.co.uk/i/keep-calm-and-carry-your-team-32.png">
						</div>
						<div class="infos large-6 medium-12 columns">
							<h2>Sorry</h2>
							<span>No events for this request</span>
						</div>
						<div class="medium-12 large-6 columns teams">
							<a href="<?php echo MODULE . 'event' . ACTION . 'seeevent' ?>" class="button-submit">Back to all events</a>
						</div>
					</div>
				</div>
            <?php } ?>
			<div class="event medium-6 columns">
				<div class="wrapper clearfix">
					<div class="ready img large-6 medium-12 columns">
					</div>
					<div class="medium-12 large-6 columns adventure">
						<a href="<?php echo MODULE . 'event' . ACTION . 'addevent'; ?>" class="button-join join">Ready for your adventure ?</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="medium-12 pagination">
		<?php 
		if(isset($count['count']) && !empty($count['count'])){
			/* * * * * * * * * * * * * * * * * * * * * * * * *
		    * PAGINATION
		    */
			$limit = ceil($count['count'] / LIMIT);
			for ($i=1; $i <= $limit; $i++) { 
				if($_GET['page'] == $i){ ?>
			    <a class="select" href="<?php echo MODULE . 'event' . ACTION . 'seeevent' . PAGE . $i; ?>" title="" alt="" ><?php echo $i; ?></a>
			<?php } else { ?>
				<a href="<?php echo MODULE . 'event' . ACTION . 'seeevent' . PAGE . $i; ?>" title="" alt="" ><?php echo $i; ?></a>
			<?php } ?>
		<?php } 
		} ?>
	</div>
</div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>