<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['topevent']) && !empty($data['topevent']) ){ $topev = $data['topevent']; } ?>

		<div class="form-join-create clearfix">

			<div class="head-join-create clearfix">
				<div class="join-event columns medium-9">
					<div class="clearfix">
						<h1><? echo JOIN; /* DEFINED IN conf_define */ ?></h1>
						<form class="search-bar" method="post" action="">
							<input type="text" size="21" name="search">
							<!-- icon -->
							<input class="icon-search" type="submit" value="" >
						</form>
					</div>
					<?php if(isset($topdev) && !empty($topdev) ){ ?>
	                    <?php foreach($topev as $k => $topev){ ?>
						<div class="sticker columns large-3 medium-4">
							<div class="wrapper">
								<div class="img">
									<img src="img/event/<? echo $topev['event_img']; ?>">
									<div class="hover">
										<span>Join this event !</span>
									</div>
								</div>
								<h2><? echo $topev['event_name']; ?></h2>
								<span class="info-event"><? echo $topev['event_location']; ?> - EDITION <? echo substr($topev['event_date'], 0, 4); ?></span>
							</div>
						</div>
						<?php } ?>
					<?php } else { ?>
						<div class="tabs">
							<p>Sorry, we don't have any events to join</p>
						</div>
					<?php } ?>
				</div>
				<div class="create-event columns medium-3">
					<div class="create-box">
						<div class="wrapper">
							<img src="img/add_icon.svg">
							<span>Create your own event !</span>							
						</div>
					</div>
				</div>
			</div>

			<div class="tabs">
				<h1><span>Create </span>your own event !</h1>
			    <ul class="tab-links">
			        <li class="active"><a href="#tab1">Edit</a></li>
			        <li><a href="#tab2">Preview</a></li>
			    </ul>

			    <p>Hi, do you have an idea of sportive event which could help the planet ?</br>Let's create it !</p>
			 
			    <div class="tab-content">
			        <div id="tab1" class="tab active">
			        
			            <form id="form_create" class="" name="form_create" enctype="multipart/form-data" action="?module=event&action=addevent" method="post" >

			            	<div class="clearfix">
			            		<div class="medium-8 columns first">
			            			<label class="" for="name" >Name (required)</label>
									<div>
										<input id="" name="name" class="" type="text" maxlength="45" value="" required autofocus /> 
									</div> 
									<label class="" for="place">City (required)</label>
									<div>
										<input id="place" name="place" class="" type="text" maxlength="170" value="" required /> 
									</div> 
									<select name="country" required>
										<!-- Include avec l'ensemble des pays -->
										<?php require_once(ROOT . 'view/layout/country.inc.php'); ?>
									</select>

									<div class="clearfix date">
										<div class="medium-6 from columns">
										
										<label for="date-from">Beginning date (required)</label>
										<div>
											<input class="input-xlarge focused" id="dateBegin" name="from" type="date" value="" required>
										</div>
									</div>
										<div class="medium-6 to columns">
											<label for="date-to">Ending date (required)</label>
											<div>
												<input class="input-xlarge focused" id="dateEnd" name="end" type="date" value="" required>
											</div>
										</div>
									</div>
			            		</div>					
							
								<div class="medium-4 columns second">
									<div class="fileupload clearfix">
										<img src="img/camera.png">
										<span>Add a cover, it's better !</span>
										<input  type="file" name="cover"/>
									</div>
								</div>
				       		</div>
								 
								<label class="" for="description">Tell us more about your idea ! </label>
									<div>
										<textarea id="description" name="descr"  required></textarea> 
									</div> 
			    
								<a href="arrivee.html" onClick="ga('send', 'event', 'link','clic', 'validate-createv3');"><input id="saveForm" class="button-submit" type="submit" name="submit" value="Validate" /></a>
						</form>
			       	</div>
			 
			        <div id="tab2" class="tab">
						<p>This service is currently unavailable.

I hope that will not last too long :)</p>
			        </div>
			    </div>
			</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>