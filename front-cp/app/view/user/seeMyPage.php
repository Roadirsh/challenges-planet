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
                            <form method="post" action="">
                                <!-- id rajouté -->
                                <input class="medium-3 columns" id="mp_pseudo" type="text" name="pseudo" value="<?php echo strtoupper($user['user_pseudo']); ?>" />
                                <a class="modif" href="#" onclick='submit();'>Edit</a>
                            </form>
                            <br><br>
                            <p><?php echo $user['age']; ?> years old</p>
                        </div>

                        <!-- VERSION 2  -->
                        <!-- <div class="medium-4 columns school-profil">
                            <h3>School</h3>
                            <p>EEMI</p>
                        </div> -->

                        <div id="location medium-6">
                            <img src="img/icon-location.png" alt="icon-location" title="location"/>
                            <!-- <a href="<?php echo $user['user_site']; ?>" alt="" title=""> -->
                                <input class="medium-6" type="email" name="text" id="mp_site" value="<?php echo $user['user_site']; ?>" />
                                <a class="modif" href="#" onclick='submit();'>Edit</a>
                            <!-- </a> -->
                            
                        </div>

                    </div>

                    <div class="clearfix">
                        <div class="medium-6 columns general-profil">
                            <h2>My information</h2>
                            <p>
                                Phone: <input type="text" name="phone" id="mp_phone" value="<?php echo $user['phone_num']; ?>" />
                                <a class="modif" href="#">Edit</a><br>
                                Adress : <?php echo $user['ad_type']; ?><br>
                                n° : <input type="text" name="type" value="<?php echo $user['ad_num']; ?>" /> 
                                Street : <input type="text" name="type" value="<?php echo $user['ad_street']; ?>" /><br>
                                Zipcode : <input type="text" name="type" value="<?php echo $user['ad_zipcode']; ?>" />
                                City : <input type="text" name="type" value="<?php echo $user['ad_city']; ?>" /><br>
                                Country : <input type="text" name="type" value="<?php echo ucfirst($user['ad_country']); ?>" />
                            </p>
                            <a class="modif" href="#">Edit</a>
                        </div>
                        <div id="account" class="medium-6 columns">
                            <div class=" content-profil clearfix">
                                <h2>My account</h2> 
                            </div>

                            <div class="medium-12 general-profil">
                                <div class=" first-info"><p>Mail adress<p></div>
                                <div class=" second-info"><input type="email" name="email" value="<?php echo $user['user_mail']; ?>"/></div>
                                <div class=" third-info">
                                    <a class="modif" href="#">Edit</a>
                                </div>
                            </div>

                            <div class="medium-12 right general-profil">
                                <div class="medium-12 first-info"><p>Password<p></div>
                                    <div class="second-info"><input type="password" value="<?php echo $user['user_password']; ?>" /></div>
                                    <div class="third-info"><a class="modif" href="#">Edit</a></div>
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
                                    <div class="medium-6 columns img" style="background:url('<?php echo EVENT . 'mini/' . $event['event_img']; ?>'); background-size: cover; background-position: top right;" >
                                    </div>

                                    <div class="medium-6 info-event columns">
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
                                        You haven't created an event yet !
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div id="teams" class=" tab clearfix">
                
                <?php if(isset($groups)){ ?>
                    <?php foreach ($groups as $key => $t) { ?>
                        <?php $percent = number_format(($t['helped'] / $t['group_money']) *100, 0);?>
                        <?php if($percent <= 100) { ?>
                        <div class="columns large-3 medium-4 team-wrapper">
                            <div class="wrapper">
                                <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title="">
                                    <div class="img" style="background:url('<?php echo PROJECT . $t['group_img']; ?>'); background-position: top left;background-size: cover;">
                                        <div class="hover"><span>They need you<br>help them</span></div>
                                    </div>
                                </a>
                                <div class="title-team"><a href="<?php echo MODULE . 'event' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title=""><?php echo $t['group_name']; ?></a></div>
                                <div class="name"><?php echo $t['event_name']; ?></div>
                                <div class="date"><?php echo formDate($t['event_begin'], 0); ?> - <?php echo formDate($t['event_end'], 0); ?></div>
                                <div class="progressteam">
                                    <div class="clearfix">
                                        <div class="columns medium-4 small-4 numbers">
                                            <span><?php echo $t['group_money']; ?> €</span>
                                            <br>goals
                                        </div>
                                        <div class="columns medium-4 small-4 funded">
                                            <span><?php  echo number_format(($t['helped'] / $t['group_money']) *100, 0); ?>  %</span>
                                            </br>funded
                                        </div>
                                        <div class="columns medium-4 small-4 daysleft">
                                            <span>
                                                <?php $diff = (new DateTime('now'))->diff(new DateTime($t['event_end'])); ?>
                                                <?php echo $diff->format('%a'); ?>
                                            </span>
                                            <br> DAYS LEFT
                                        </div>
                                    </div>
                                    
                                    <div class="progress-team notyet" data-percent="<?php echo $percent; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <?php } else { $percent = 100; ?>
                        <div class="columns large-3 medium-4 team-wrapper">
                            <div class="wrapper done">
                                <div class="img" style="background:url('<?php echo PROJECT . $t['group_img']; ?>'); background-position: left;background-size: cover;">
                                    <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title="">
                                        <div class="hover done"><span>It's done thank you !</span></div>
                                    </a>
                                </div>
                                <div class="title-team"><?php echo $t['group_name']; ?></div>
                                <div class="name"><?php echo $t['event_name']; ?></div>
                                <div class="date"><?php echo formDate($t['event_begin'], 0); ?> - <?php echo formDate($t['event_end'], 0); ?></div>
                                <div class="progressteam">
                                    <span class="validate"></span>
                                    <div class="number"><span>100 %</span><br>goal reached !</div>
                                    <div class="progress-team-done good"></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
