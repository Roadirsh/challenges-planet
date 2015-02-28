<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php }$_SESSION['message'] = null; ?>

<?php if(isset($data['user']) && !empty($data['user']) ){ $user = $data['user']; } ?>
<?php if(isset($data['events'][0]) && !empty($data['events'][0]) ){ $events = $data['events']; } ?>
<?php if(isset($data['groups'][0]) && !empty($data['groups'][0]) ){ $groups = $data['groups']; } ?>

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

                        <!-- VERSION 2  -->
                        <!-- <div class="medium-4 columns school-profil">
                            <h3>School</h3>
                            <p>EEMI</p>
                        </div> -->

                        <span id="location">
                            <img src="img/icon-location.png" alt="icon-location" title="location"/>
                            <a href="<?php echo $user['user_site']; ?>" alt="" title=""><?php echo $user['user_site']; ?></a>
                        </span>

                    </div>

                    <div class="clearfix">
                        <div class="medium-6 columns general-profil">
                            <h2>My information</h2>
                            <p>
                                Phone: <?php echo $user['phone_num']; ?><br>
                                Adress : <?php echo $user['ad_type']; ?><br>
                                <?php echo $user['ad_num']; ?> <?php echo $user['ad_street']; ?><br>
                                <?php echo $user['ad_zipcode']; ?> <?php echo $user['ad_city']; ?><br>
                                <?php echo ucfirst($user['ad_country']); ?>
                            </p>
                            <!-- A mettre en commentaire si tu veux bosser sur le edit -->
                            <?php if(isset($_SESSION[PREFIX . 'userID']) && $_SESSION[PREFIX . 'userID'] == $user['user_id']){ ?>
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
                                    <?php if(isset($_SESSION[PREFIX . 'userID']) && $_SESSION[PREFIX . 'userID'] == $user['user_id']){ ?>
                                        <a class="modif" href="#">Edit</a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="medium-12 right general-profil">
                                <div class="medium-3 first-info"><p>Password<p></div>
                                <!-- A mettre en commentaire si tu veux bosser sur le edit -->
                                <?php if(isset($_SESSION[PREFIX . 'userID']) && $_SESSION[PREFIX . 'userID'] == $user['user_id']){ ?>
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
                        
                        <?php if(isset($events)){ ?>
                            <?php foreach ($events as $key => $event) { ?>
                            <div class="medium-6 columns">
                                <div class="wrapper clearfix event-profil">
                                    <div class="medium-6 columns img" style="background:url('<?php echo EVENT . 'mini/' . $event['event_img']; ?>'); background-size: cover;" >
                                    </div>

                                    <div class="medium-6 columns">
                                        <h2><?php echo $event['event_name']; ?></h2>
                                        <span>
                                            <?php echo formDate($event['event_begin'], 0); ?> - <?php echo formDate($event['event_end'], 0); ?>
                                        </span>
                                        <a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $event['event_id']; ?>" class="button-submit">See my event </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="medium-6 columns">
                                <div class="wrapper clearfix event-profil">
                                    <div class="medium-6 columns img">
                                    </div>

                                    <div class="medium-6 columns">
                                        NOTHING BITCH
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="teams" class="tab clearfix">
                        
                        <?php if(isset($groups)){ ?>
                            <?php foreach ($groups as $key => $group) { ?>
                                Name : <?php echo $group['group_name']; ?><br>
                                IMG : <?php echo $group['group_img']; ?><br>
                                Date : <?php echo formDate($group['group_date'], 0); ?><br>
                                Event : <?php echo $group['event_name']; ?><br>
                                Event date : <?php echo formDate($group['event_begin'], 0); ?> - <?php echo formDate($group['event_end'], 0); ?><br>
                                Goal : <?php echo $group['group_money']; ?> €<br>
                                Fund : <?php echo $group['helped']; ?> €<br>
                                <?php $percent = number_format(($group['helped'] / $group['group_money']) *100, 0); ?> 
                                <?php /** If they have more then asked **/ ?>
                                <?php if($percent > 100){ $percent = 100;} ?>
                                data ="<?php echo $percent; ?>"<br>
                            <?php } ?>
                        <?php } else { ?>
                            Sorry, nothing to show ! 
                        <?php } ?>

                </div>
            </div>
        </div>
    </div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
