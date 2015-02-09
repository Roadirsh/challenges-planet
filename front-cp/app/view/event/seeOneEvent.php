<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($data['event'][0]) && !empty($data['event'][0]) ){ $event = $data['event'][0]; }else{ $event = null; } ?>
<?php if(isset($data['done'][0]) && !empty($data['done'][0]) ){ $done = $data['done'][0]; }else{ $done = null; } ?>
<?php if(isset($data['groups']) && !empty($data['groups']) ){ $groups = $data['groups']; }else{ $groups = null; } ?>
<?php //var_dump($groups); ?>
        <div class="list-events clearfix">
            <div class="head clearfix">
                <div class="medium-4 large-3 columns">
                    <img src="img/event/<?php echo $event['event_img']; ?>" alt="">
                </div>
                <div class="medium-8 large-9 columns">
                    <h1><?php echo $event['event_name']; ?></h1>
                    <p><?php echo $event['event_decr']; ?></p>
                    <div class="clearfix">
                        <div class="medium-4 columns location"><span>Location : </span><?php echo $event['event_location']; ?></div>
                        <div class="medium-4 columns date-begin"><span>Date from : </span><?php echo formDate($event['event_begin'], 2); ?></div>
                        <div class="medium-4 columns date-finish"><span>Date to : </span><?php echo formDate($event['event_end'], 2); ?></div>
                    </div>
                    <span class="medium-12 number-teams-event"><? echo count($groups); ?> teams needs you</span>
                </div>
            </div>

            <div class="main-contain clearfix">
                <a href="#form-search" class="hide-for-large-up show-for-small-up popup-with-form sidebar-sort-mobile">Search and sort</a>
                <form id="form-search" class="search-bar mfp-hide white-popup-block" method="posst" action="">
                    <input type="text" size="21">
                        
                        <div class="team-progress">
                            <span>Team Progress</span>
                            <div>
                                <input type="checkbox" name="help" value="need" onchange='submit();'> Help them, they need you !
                            </div>
                            <div>
                                <input type="checkbox" name="help" value="almost" onchange='submit();'> Just a little bit of help !
                            </div>
                            <div>
                                <input type="checkbox" name="help" value="done" onchange='submit();'> It's Done ! Thank you !
                            </div>    
                        </div>
                        
                        <div class="team-budget">
                            <span>Budget</span>
                            <div>
                                <input type="checkbox" name="budget" value="2000" onclick='submit();'> From to 2000 €
                            </div>
                            <div>
                                <input type="checkbox" name="budget" value="6000" onclick='submit();'> From to 6000 €
                            </div>
                            <div>
                                <input type="checkbox" name="budget" value="10000" onclick='submit();'> From to 10 000 €
                            </div>
                        </div>

                </form>
                <div class="show-for-large-up sidebar-sort medium-3 columns">
                    <h2>Search and sort</h2>
                    <form class="search-bar" method="post" action="">
                        <input type="text" size="21" name="search">
                        
                        <div class="team-progress">
                            <span>Team Progress</span>
                            <div>
                                <input type="checkbox" name="help" value="need" onchange='submit();'> Help them, they need you !
                            </div>
                            <div>
                                <input type="checkbox" name="help" value="almost" onchange='submit();'> Just a little bit of help !
                            </div>
                            <div>
                                <input type="checkbox" name="help" value="done" onchange='submit();'> It's Done ! Thank you !
                            </div>    
                        </div>
                        
                        <div class="team-budget">
                            <span>Budget</span>
                            <div>
                                <input type="checkbox" name="budget" value="2000" onclick='submit();'> From 0 € to 2000 €
                            </div>
                            <div>
                                <input type="checkbox" name="budget" value="6000" onclick='submit();'> From 2000 € to 6000 €
                            </div>
                            <div>
                                <input type="checkbox" name="budget" value="10000" onclick='submit();'> From 6000 € to 10 000 €
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="teams large-9 medium-12 clearfix columns">
                    <?php if(isset($data['done'][0]['group_id']) && !empty($data['done'][0]['group_id']) ){ ?>
                        <div class="team-wrapper columns medium-4">
	                        <div class="wrapper done">
	                            <div class="img">
	                                <img src="img/group/<?php echo $done['group_img']; ?>" alt="">
	                                <div class="hover done">
	                                    <span>It's done thank you !</span>
	                                </div>
	                            </div>
	                            <div class="title-team"><?php echo $done['group_name']; ?></div>
	                            <div class="date"><?php echo formDate($done['group_date'], 2); ?></div>
	                            <div class="progressteam">
	                                <span class="validate"></span>
	                                <div class="number"><span>100 %</span><br>goal reached !</div>
	                                <div id="progressteam1" class="good"></div>
	                            </div>
	                        </div>
	                    </div>
                    <?php } ?>
                    <?php if(!empty($groups[0]['group_id'])){ ?>
                        <?php $i = 1;
                        foreach ($groups as $key => $g) { ?>
                            <div class="team-wrapper columns medium-4">
                                <div class="wrapper">
                                    <div class="img">
                                        <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $g['group_id']; ?>" alt="" title="" >
                                            <img src="img/group/<?php echo $g['group_img']; ?>" alt="">
                                            <div class="hover">
                                                <span>They need you<br>help them</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="title-team"><?php echo $g['group_name']; ?></div>
                                    <div class="date"><?php echo formDate($g['group_date'], 2); ?></div>
                                    <div class="progressteam">
                                        <div class="clearfix">
                                            <div class="columns medium-4 small-4 numbers"><span><?php echo $g['group_money']; ?> €</span><br>goals</div>
                                            <div class="columns medium-4 small-4 funded"><span><?php  echo number_format(($g['needed'] / $g['group_money']) *100, 0); ?>  %</span><br>funded</div>
                                            <div class="columns medium-4 small-4 daysleft">
                                                <span>
                                                    <?php $diff = (new DateTime('now'))->diff(new DateTime($event['event_end'])); ?>
                                                    <?php echo $diff->format('%a'); //%a take the lot Y-m-d ?>
                                                </span>
                                                <br>days left</div>
                                        </div>
                                        <?php echo $i; ?>
                                        <div id="progressteam<?php echo $i; ?>" class="notyet"></div>
                                    </div>
                                </div>
                            </div>
                        <?php $i ++; } ?>
                    <?php } ?> 
                </div>
            </div>
            
            <div class="medium-12 pagination">
                <a class="previous-link" href="">&lt;</a>
                <a class="select">1 </a>
                <a>2</a>
                <a>3</a>
                <a class="next-link" href="">&gt;</a>
            </div>

        </div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>