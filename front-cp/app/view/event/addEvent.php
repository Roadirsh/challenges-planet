<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php }$_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['topevent']) && !empty($data['topevent']) ){ $topdev = $data['topevent']; } ?>

		<div class="form-join-create clearfix">

			<div id="basic-waypoint" class="head-join-create clearfix">
				<div class="join-event columns medium-9">
					<div class="clearfix">
						<h1><?php echo JOIN; /* DEFINED IN conf_define */ ?></h1>
						<form class="search-bar" method="post" action="">
							<input type="text" size="21" name="search">
							<!-- icon -->
							<input class="icon-search" type="submit" value="" >
						</form>
					</div>
					<?php if(isset($topdev) && !empty($topdev) ){ ?>
	                    <?php foreach($topdev as $k => $topev){ ?>
						<div class="sticker columns large-3 medium-4">
							<div class="wrapper">
								<div class="img" style="background:url('<?php echo EVENT . 'mini/' . $topev['event_img']; ?>'); background-position: right;background-size: cover;">
									<div class="hover">
										<span>Join this event !</span>
									</div>
								</div>
								<h2><?php echo substr($topev['event_name'], 0, 15); ?> <small> ...</small></h2>
								<span class="info-event"><?php echo mb_strimwidth($topev['event_location'], 0, 20, "..."); ?><small> ...</small> 
								<br> <span class="date"><?php echo formDate($topev['event_begin'], 0); ?> - <?php echo formDate($topev['event_end'], 0); ?></span></span>

							</div>
						</div>
						<?php } ?>
					<?php } else { ?>
						<div>
							<p>Sorry, we don't have any events to join</p>
						</div>
					<?php } ?>
				</div>
				<div class="create-event columns medium-3">
					<div class="create-box">
						<div class="wrapper">
							<img src="img/add_icon.svg"alt="add">
							<span>Create your own event !</span>							
						</div>
					</div>
				</div>
			</div>


			<div class="main-content">
				<div class="wrapper-info-caritative">
					<div class="info-caritative medium-12 clearfix show-for-large-up">
						<div class="medium-6 columns">
							<div class="clearfix">
								<div class="help medium-12 large-6 columns">
									<p>You have a project which means a lot to you, a sports challenge student and humanitarian ?</p>
								</div>
								<div class="img raid medium-12 large-6 columns">
									<img src="img/img-raid-gesture.png" alt="">
								</div>
							</div>
							<div class="clearfix">
								<div class="img medium-12 large-6 columns">
									<img src="img/img-share-adventure-gesture.png" alt="">
								</div>
								<div class="help help-right adventure medium-12 large-6 columns">
									<p>With your friends, come to live the most beautiful human and united adventure</p>
								</div>
							</div>
						</div>
						<div class="medium-6 columns">
							<div class="img-trophy">
								<img src="img/img-4l-trophy-gesture.png" alt="">
								<span class="help caption">A gesture which you will not be ready to forget...</span>
							</div>
						</div>
					</div>
				</div>

				<div class="tabs form-create-event">

				 
				    <div class="tab-content">
				        <div id="tab1" class="tab active">
				        
				            <form id="form_create" class="" name="form_create" enctype="multipart/form-data" action="<?php echo MODULE . 'event' . ACTION . 'addevent'; ?>" method="post" >
				            	<div class="show-for-large-up run-man"></div>
								<div class="show-for-large-up" id="progress-form-create"></div>
								<div class="show-for-large-up form-create-img clearfix">
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-first">
												<div class="progress-message" id="progress-message-first">Get ready ?</div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-second">
												<div class="progress-message" id="progress-message-second"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-third">
												<div class="progress-message" id="progress-message-third"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-fourth">
												<div class="progress-message" id="progress-message-fourth"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
								</div>
								
								<h1><span>Create </span>your own event !</h1>
								<p>Hi, do you have an idea of sportive event which could help the planet ?<br/>Let's create it !</p>
				            	<div class="clearfix">
				            		<div class="medium-8 columns first">
				            			<label class="name-event" for="name" >Name (required)</label>
										<div>
											<input class="form-create-progress name-event" id="name-event" name="name" type="text" maxlength="45" value=""  required /> 
										</div> 
										<label class="" for="place-error">City (required)</label>
										<div>
											<input id="place" name="place" class="form-create-progress" type="text" maxlength="170" value=""  required /> 
										</div>
										<label for="country">Location (required)</label> 
										<select class="form-create-progress" id="country" name="country" required>
											<!-- Include avec l'ensemble des pays -->
											<?php require_once(ROOT . 'view/layout/country.inc.php'); ?>
										</select>

										<div class="clearfix date">
											<div class="medium-4 from columns">
												<label for="date-from">Beginning date (required)</label>
												<div>
													<input class="form-create-progress input-xlarge focused" id="dateBegin" name="from" type="date" value=""  required>
												</div>
											</div>
											<div class="medium-4 to columns">
												<label for="date-to">Ending date (required)</label>
												<div>
													<input class="form-create-progress form-error input-xlarge focused" id="dateEnd" name="end" type="date" value=""  required>
												</div>
											</div>
											<div class="medium-4 to columns">
												<label for="type">Type (required)</label>
													<select id="type-race" name="type" class="form-create-progress" required>
														<option value="">Type of your race</option>
														<option value="Earth">Earth</option>
														<option value="Sea">Sea</option>
														<option value="Air">Air</option>
														<option value="Car">Car</option>
														<option value="Boat">Boat</option>
														<option value="Surf">Surf</option>
														<option value="Bike">Bike</option>
													</select>
											</div>
										</div>
				            		</div>					
								
									<div class="medium-4 columns second">
										<div class="fileupload clearfix">
											<img src="img/camera.png"alt="camera">
											<span class="desc">Add a cover, it's better ! (required)</span>
											<div class="custom-file-upload">
											    <input class="form-create-progress" type="file" id="file" name="myfiles[]" multiple / required>
											</div>
											<span class="info">(size : 1280px * 490px)</span>
										</div>
									</div>
					       		</div>
								<label class="" for="description">Your idea</label> <!-- onblur="this.value=''" -->
								<div>
									<textarea id="description" placeholder="Tell us more about your idea, which goal ? Which caritative challenge ? Which sport ?" name="descr"></textarea>
								</div>

								<a href="" onClick="ga('send', 'event', 'link','clic', 'validate-createv3');"><input id="saveForm" class="button-submit" type="submit" name="submit" value="Ready for your adventure !" /></a>
							</form>
				       	</div>
				 
				        <div  class="tab">
							<div class="preview-create">
								<div class="clearfix">
									<h2 class="name-event"></h2>
									<div class="medium-5 columns">
										<img src="img/event/slider3.jpg" alt="cover event">
									</div>
									<div class="medium-7 columns">
										<p>Description</p>
									</div>
								</div>
								<div class="clearfix">
			                        <div class="medium-4 columns location"><span>Location : </span> Country, city</div>
			                        <div class="medium-4 columns date-begin"><span>Beginning date : </span></div>
			                        <div class="medium-4 columns date-finish"><span>Ending date : </span></div>
	                    		</div>
							</div>
				        </div>
				    </div>
				</div>

				<div class="tabs form-join-event">
				 
				    <div class="tab-content">
				        <div id="tab3" class="tab active">
				        
				            <form id="form_join" class="" name="form_join" enctype="multipart/form-data" action="?module=event&action=" method="post" >
								<div class="show-for-large-up run-man"></div>
								<div class="show-for-large-up" id="progress-form-join"></div>
								<div class="show-for-large-up form-create-img clearfix">
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-first">
												<div class="progress-message" id="progress-message-join-first">Get ready ?</div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-second">
												<div class="progress-message" id="progress-message-join-second"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-third">
												<div class="progress-message" id="progress-message-join-third"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
									<div class="medium-3 columns">
										<div class="img-form">
											<div class="bg-img-fourth">
												<div class="progress-message" id="progress-message-join-fifth"></div>
											</div>
											<img src="img/logo-form.png" alt="">
										</div>
									</div>
								</div>
								<h1><span>Join </span>the <span class="blue">name event</span></h1>
				    			<p>Hi, build your own team and get ready !</p>
				            	<div class="clearfix">
				            		<div class="medium-4 columns event-info">
					            		<label class="team-name" for="name">Name of your team (required)</label>
					            		<input required class="form-join-progress" type="text" id="name-team">

					            		<label for="info-event">Event informations</label>
					            		<div class="info-event">
					            			<input type="hidden" value="#id" />
					            			<span>Location : </span>
						            		<span>Beginning date : </span>
						            		<span>Ending date : </span>
					            		</div>
				            		</div>
				            		<div>
				            			<label for="file">Add the picture of your team </label>
				            		</div>
				            		<div class="medium-8 columns upload">
				            			
				            				<div class="fileupload clearfix">
												<img src="img/camera.png"alt="camera">
												<span class="desc">Add a cover, it's better !</span>
												<div class="custom-file-upload">
												    <!--<label for="file">File: </label>--> 
												    <input required class="form-join-progress" type="file" id="file1" name="myfiles" multiple />
												</div>
												<span class="info">(size : 587px * 240px)</span>
										</div>
				            		</div>
				            	</div>

				            	<div class="clearfix">
				            		<div class="medium-6 columns add-mates">
				            			<label for="mates">Add your mates ! (required)</label>
				            			<div class="mates">
				            				<input required class="form-join-progress" id="mail-team" placeholder="Email of your mate" type="email">
				            				<input placeholder="Email of your mate" type="email">
				            				<input placeholder="Email of your mate" type="email">
				            				<input placeholder="Email of your mate" type="email">
				            			</div>
				            		</div>
				            		<div class="medium-6 columns">
				            			<label for="your-team">Your team (required)</label>
				            			<textarea class="form-join-progress" required placeholder="Tell us more about your team !"></textarea>
				            		</div>
				            	</div>

				            	<div class="clearfix">
				            		<div class="medium-6 columns team-goal">
				            			<label for="your-goal">Your goal (required)</label>
				            			<textarea class="form-join-progress" required name="" id="" placeholder="Why this event ? Explain your motivation here !"></textarea>
				            		</div>
				            		<div class="medium-6 columns">
				            			<label for="your-budget">Your budget (required)</label>
				            			<textarea class="form-join-progress" required name="" id="" placeholder="Detail your buget and explain it !"></textarea>
				            		</div>
				            	</div>
				
								<input id="saveForm" class="button-submit" type="submit" name="submit" value="ready for your adventure !" />
							</form>
				       	</div>
				 
				        <div id="tab2" class="tab">
							<p>This service is currently unavailable. I hope that will not last too long :)</p>
				        </div>
				    </div>
				</div>
			</div>
		</div>

		<?php include(ROOT . "view/layout/footer.inc.php"); ?>