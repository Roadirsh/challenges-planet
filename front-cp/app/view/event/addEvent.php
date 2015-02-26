<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php }$_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['topevent']) && !empty($data['topevent']) ){ $topdev = $data['topevent']; } ?>

		<div class="form-join-create clearfix">

			<div id="basic-waypoint" class="head-join-create clearfix">
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
	                    <?php foreach($topdev as $k => $topev){ ?>
						<div class="sticker columns large-3 medium-4">
							<div class="wrapper">
								<div class="img" style="background:url('<?php echo EVENT . 'mini/' . $topev['event_img']; ?>'); background-position: right;background-size: cover;">
									<div class="hover">
										<span>Join this event !</span>
									</div>
								</div>
								<h2><? echo substr($topev['event_name'], 0, 15); ?> <small> ...</small></h2>
								<span class="info-event"><?php echo mb_strimwidth($topev['event_location'], 0, 20, "..."); ?><small> ...</small> 
								<br> <div class="date"><?php echo formDate($topev['event_begin'], 0); ?> - <?php echo formDate($topev['event_end'], 0); ?></div></span>

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
							<img src="img/add_icon.svg">
							<span>Create your own event !</span>							
						</div>
					</div>
				</div>
			</div>

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
			            			<label class="name-event" for="name" >Name (required)</label>
									<div>
										<input class="name-event" id="" name="name" class="" type="text" maxlength="45" value="" required /> 
									</div> 
									<label class="" for="place">City (required)</label>
									<div>
										<input id="place" name="place" class="" type="text" maxlength="170" value="" required /> 
									</div>
									<label for="">Location (required)</label> 
									<select name="country" required>
										<!-- Include avec l'ensemble des pays -->
										<?php require_once(ROOT . 'view/layout/country.inc.php'); ?>
									</select>

									<div class="clearfix date">
										<div class="medium-4 from columns">
											<label for="date-from">Beginning date (required)</label>
											<div>
												<input class="input-xlarge focused" id="dateBegin" name="from" type="date" value="" required>
											</div>
										</div>
										<div class="medium-4 to columns">
											<label for="date-to">Ending date (required)</label>
											<div>
												<input class="input-xlarge focused" id="dateEnd" name="end" type="date" value="" required>
											</div>
										</div>
										<div class="medium-4 to columns">
											<label for="type">Type (required)</label>
											<div>
												<select id="type" name="type">
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
			            		</div>					
							
								<div class="medium-4 columns second">
									<div class="fileupload clearfix">
										<img src="img/camera.png">
										<span class="desc">Add a cover, it's better !</span>
										<div class="custom-file-upload">
										    <input type="file" id="file" name="myfiles[]" multiple />
										</div>
										<span class="info">(size : 1280px * 490px)</span>
									</div>
								</div>
				       		</div>
							<label class="" for="description">Your idea</label> <!-- onblur="this.value=''" -->
							<div>
								<textarea onblur="this.value=''" onfocus="javascript: this.value=''" id="description" name="descr">Tell us more about your idea, which goal ? Which caritative challenge ? Which sport ?</textarea>
							</div>

							<a href="" onClick="ga('send', 'event', 'link','clic', 'validate-createv3');"><input id="saveForm" class="button-submit" type="submit" name="submit" value="Ready for your adventure !" /></a>
						</form>
			       	</div>
			 
			        <div id="tab2" class="tab">
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
				<h1><span>Join </span>the <span class="blue">name event</span></h1>
			    <ul class="tab-links">
			        <li class="active"><a href="#tab1">Edit</a></li>
			        <li><a href="#tab2">Preview</a></li>
			    </ul>

			    <p>Hi, build your own team and get ready !</p>
			 
			    <div class="tab-content">
			        <div id="tab1" class="tab active">
			        
			            <form id="form_join" class="" name="form_join" enctype="multipart/form-data" action="?module=event&action=" method="post" >

			            	<div class="clearfix">
			            		<div class="medium-4 columns event-info">
				            		<label class="team-name" for="name">Name of your team (required)</label>
				            		<input class="name" type="text" id="name">

				            		<label for="">Event informations</label>
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
											<img src="img/camera.png">
											<span class="desc">Add a cover, it's better !</span>
											<div class="custom-file-upload">
											    <!--<label for="file">File: </label>--> 
											    <input type="file" id="file" name="myfiles" multiple />
											</div>
											<span class="info">(size : px * px)</span>
									</div>
			            		</div>
			            	</div>

			            	<div class="clearfix">
			            		<div class="medium-6 columns add-mates">
			            			<label for="">Add your mates ! (required)</label>
			            			<div class="mates">
			            				<input onfocus="javascript: this.value=''" onblur="this.value='Email of your mate'" value="Email of your mate" type="email">
			            				<input onfocus="javascript: this.value=''" onblur="this.value='Email of your mate'" value="Email of your mate" type="email">
			            				<input onfocus="javascript: this.value=''" onblur="this.value='Email of your mate'" value="Email of your mate" type="email">
			            				<input onfocus="javascript: this.value=''" onblur="this.value='Email of your mate'" value="Email of your mate" type="email">
			            			</div>
			            		</div>
			            		<div class="medium-6 columns">
			            			<label for="">Your team</label>
			            			<textarea name="" id="" cols="30" rows="10" onfocus="javascript: this.value=''" onblur="this.value=''">Tell us more about your team !</textarea>
			            		</div>
			            	</div>

			            	<div class="clearfix">
			            		<div class="medium-6 columns team-goal">
			            			<label for="">Your goal</label>
			            			<textarea name="" id="" cols="30" rows="10" onfocus="javascript: this.value=''" onblur="this.value=''">Why this event ? Explain your motivation here !</textarea>
			            		</div>
			            		<div class="medium-6 columns">
			            			<label for="">Your budget</label>
			            			<textarea name="" id="" cols="30" rows="10" onfocus="javascript: this.value=''" onblur="this.value=''">Detail your buget and explain it !</textarea>
			            		</div>
			            	</div>
			
							<a href="arrivee.html" onClick="ga('send', 'event', 'link','clic', 'validate-createv3');"><input id="saveForm" class="button-submit" type="submit" name="submit" value="ready for your adventure !" /></a>
						</form>
			       	</div>
			 
			        <div id="tab2" class="tab">
						<p>This service is currently unavailable. I hope that will not last too long :)</p>
			        </div>
			    </div>
			</div>
		</div>

		<?php include(ROOT . "view/layout/footer.inc.php"); ?>