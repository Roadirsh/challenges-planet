<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php }$_SESSION['message'] = null; ?>

<?php if(isset($data['user']) && !empty($data['user']) ){ $user = $data['user']; } ?>
<?php if(isset($data['events'][0]) && !empty($data['events'][0]) ){ $events = $data['events']; } ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

	<div class="see-user">
	    <div class="medium-3 columns menu-profil">
            <ul>
                <li class="selected"><a href="#">My information</a></li>
                <li><a href="#">My account</a></li>
                <li><a href="#">My projects</a></li>
                <li><a href="#">My teams</a></li>
                <li><a href="#">Suivis</a></li>
            </ul>
        </div>
            
        <div id="profil">
            <div class="medium-9 columns content-profil clearfix">
                <h1>My profile</h1>

                <div class="medium-3 columns">
                    <div id="circle"><img src="<?php echo AVATAR . $user['user_profil_pic']; ?>" alt="photo-profil" title="photo-profil"/></div>
                </div>

                <div class="medium-5 columns">
                    <h3><?php echo strtoupper($user['user_firstname']) . ' ' . $user['user_lastname'] ; ?></h3>
                    <p><?php echo $user['age']; ?> years old</p>
                </div>

                <div class="medium-4 columns school-profil">
                    <h3>School</h3>
                    <p>EEMI</p>
                </div>

                <p id="location">
                    <img src="img/icon-location.png" alt="icon-location" title="location"/>
                    <a href="<?php echo $user['user_site']; ?>" alt="" title=""><?php echo $user['user_site']; ?></a>
                </p>

            </div>

            <div class="medium-9 columns right general-profil">
                <h2>My information</h2>
                <p>
                    Phones: <?php echo $user['phone_num']; ?><br>
                    Adress : <?php echo $user['ad_type']; ?><br>
                    <?php echo $user['ad_num']; ?> <?php echo $user['ad_street']; ?><br>
                    <?php echo $user['ad_zipcode']; ?> <?php echo $user['ad_city']; ?><br>
                    <?php echo $user['ad_country']; ?>
                </p>
                <a class="modif" href="#">Edit information</a>
            </div>
        </div>

        <div id="account">
            <div class="medium-9 columns right content-profil clearfix">
                <h1>My account</h1> 
            </div>

            <div class="medium-9 columns right general-profil">
                <div class="medium-3 columns first-info"><p>Mail adress<p></div>
                <div class="medium-5 columns second-info"><p><?php echo $user['user_mail']; ?></p></div>
                <div class="medium-4 columns third-info">
                    <a class="modif" href="#">Edit</a>
                </div>
            </div>

            <div class="medium-9 columns right general-profil">
                <div class="medium-3 columns first-info"><p>Password<p></div>
                <div class="medium-5 columns second-info"><input type="password" value="<?php echo $user['user_password']; ?>" /></div>
                <div class="medium-4 columns third-info"><a class="modif" href="#">Edit</a></div>
            </div>
        </div>

       	<div id="project">
           	<div class="medium-9 columns right content-profil general-profil">
              	<h1>MY PORJECTS</h1>

                <?php if(isset($events[0]) && !empty($events[0])){
                    foreach ($events as $key => $event) { ?>
                        <div class="medium-6 columns">
                            <div class="wrapper clearfix event-profil">
                                <div class="medium-6 columns">
                                    <img src="img/vignette-event-4l.png" alt="event" title="events"/>
                                </div>
                                    <div class="medium-6 columns">
                                        <h4>4L trophy</h4>
                                        <span>32ND EDITION
                                            2015,<br/> JULY 5TH
                                        </span>
                                        <a href="" class="button-submit">Edit your event </a>
                                        <a href="" class="button-submit">See your event </a>
                                    </div>
                            </div>
                       	</div>
                <?php }
                } else { ?>
                    <div class="medium-6 columns">
                        <div class="wrapper clearfix event-profil">
                            <div class="medium-6 columns">
                                <img src="img/vignette-event-4l.png" alt="event" title="events"/>
                            </div>
                                <div class="medium-6 columns">
                                    <h3>Oups !</h3>
                                    <p></p>
                                    <p><a href="" >Start a project<br> right now! </a></p>
                                </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
		</div>
	</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>