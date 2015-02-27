<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php }$_SESSION['message'] = null; ?>

<?php if(isset($data['user']) && !empty($data['user']) ){ $user = $data['user']; } ?>
<?php if(isset($data['events'][0]) && !empty($data['events'][0]) ){ $events = $data['events']; } ?>


<?php include(ROOT . "view/layout/header.inc.php"); ?>

    <div class="see-user tabs-user">
        <div class="clearfix">
            <div class="medium-3 columns menu-profil">
                <ul class="tab-links">
                    <li class="active"><a href="#profil">My account</a></li>
                    <li><a href="#events">My events</a></li>
                    <li><a href="#teams">My teams</a></li>
                </ul>
            </div>
            <div class="tab-content clearfix">
                <div id="profil" class="medium-9 tab active columns content-profil">
                    <div class="clearfix">
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

                        <span id="location">
                            <img src="img/icon-location.png" alt="icon-location" title="location"/>
                            <a href="<?php echo $user['user_site']; ?>" alt="" title=""><?php echo $user['user_site']; ?></a>
                        </span>

                    </div>

                    <div class="clearfix">
                        <div class="medium-6 columns general-profil">
                            <h2>My information</h2>
                            <p>
                                Phones: <?php echo $user['phone_num']; ?><br>
                                Adress : <?php echo $user['ad_type']; ?><br>
                                <?php echo $user['ad_num']; ?> <?php echo $user['ad_street']; ?><br>
                                <?php echo $user['ad_zipcode']; ?> <?php echo $user['ad_city']; ?><br>
                                <?php echo $user['ad_country']; ?>
                            </p>
                            <!-- A mettre en commentaire si tu veux bosser sur le edit -->
                            <?php if(isset($_SESSION['userID']) && $_SESSION['userID'] == $user['user_id']){ ?>
                                <a class="modif" href="#">Edit information</a>
                            <?php } ?>
                        </div>
                        <div id="account" class="medium-6 columns">
                            <div class=" content-profil clearfix">
                                <h2>My account</h2> 
                            </div>

                            <div class="medium-12 general-profil">
                                <div class="medium-3 first-info"><p>Mail adress<p></div>
                                <div class="medium-5 second-info"><p><?php echo $user['user_mail']; ?></p></div>
                                <div class="medium-4 third-info">
                                    <!-- A mettre en commentaire si tu veux bosser sur le edit -->
                                    <?php if(isset($_SESSION['userID']) && $_SESSION['userID'] == $user['user_id']){ ?>
                                        <a class="modif" href="#">Edit</a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="medium-12 right general-profil">
                                <div class="medium-3 first-info"><p>Password<p></div>
                                <!-- A mettre en commentaire si tu veux bosser sur le edit -->
                                <?php if(isset($_SESSION['userID']) && $_SESSION['userID'] == $user['user_id']){ ?>
                                    <div class="medium-5 second-info"><input type="password" value="<?php echo $user['user_password']; ?>" /></div>
                                    <div class="medium-4 third-info"><a class="modif" href="#">Edit</a></div>
                                <?php } else { ?>
                                    <p>Please log in to modify your password</p>
                                <?php } ?>
                            </div>
                        </div>                
                    </div>
                </div>

                <div id="events" class="tab clearfix">
                    <div class="medium-9 columns right content-profil general-profil">
                        <h1>MY EVENTS</h1>

                        <div class="medium-6 columns">
                            <div class="wrapper clearfix event-profil">
                                <div class="medium-6 columns img">
                                </div>

                                <div class="medium-6 columns">
                                    <h2>4L trophy</h2>
                                    <span>32ND EDITION
                                        2015,<br/> JULY 5TH
                                    </span>
                                    <a href="" class="button-submit">See my event </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="teams" class="tab clearfix">   
                </div>
            </div>
        </div>
    </div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
