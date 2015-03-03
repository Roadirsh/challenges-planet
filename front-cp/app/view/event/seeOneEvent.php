<?php include(ROOT . "view/layout/header.inc.php"); ?>


<?php if(isset($data['event']) && !empty($data['event']) ){ $event = $data['event']; } ?>
<?php if(isset($data['groups']) && !empty($data['groups']) ){ $groups = $data['groups']; } else { $groups = 0; }?>
<?php if(isset($data['groups']['groups']) && !empty($data['groups']['groups']) ){ $groups = $data['groups']['groups']; } ?>
<?php if(isset($data['done']) && !empty($data['done']) ){ $done = $data['done']; } ?>
<?php if(isset($data['count']) && !empty($data['count']) ){ $count = $data['count'][0]['COUNT(*)']; } ?>

        <div class="list-events clearfix">
            <div class="head clearfix">
                <div class="img medium-4 large-3 columns" style="background:url('<?php echo EVENT . "mini/" .$event['event_img']; ?>'); background-position: center;background-size: cover;">
                </div>
                <div class="medium-8 large-9 columns">
                    <h1><?php echo $event['event_name']; ?></h1>
                    <p><?php echo $event['event_decr']; ?></p>
                    <div class="clearfix">
                        <div class="medium-4 columns location"><span>Location : </span><?php echo $event['event_location']; ?></div>
                        <div class="medium-4 columns date-begin"><span>Beginning date : </span><?php echo formDate($event['event_begin'], 0); ?></div>
                        <div class="medium-4 columns date-finish"><span>Ending date : </span><?php echo formDate($event['event_end'], 0); ?></div>
                    </div>
                    <span class="medium-12 number-teams-event">
                        <?php echo titleOneEvent($groups, 'team'); ?>
                    </span>
                </div>
            </div>

            <div class="main-contain clearfix">
                <?php // $form = '<a href="#form-search" class="hide-for-large-up show-for-small-up popup-with-form sidebar-sort-mobile">Search and sort</a>
                //     <form id="form-search" class="search-bar mfp-hide white-popup-block" method="post" action="<?php echo MODULE . 'event' . ACTION . 'seeoneevent'; ? >">
                //     <input type="text" size="21">
                        
                //         <div class="team-progress">
                //             <span>Team Progress</span>
                //             <div>
                //                 <input type="checkbox" name="help" value="need" onchange="submit();"> Help them, they need you !
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="help" value="almost" onchange="submit();"> Just a little bit of help !
                //             </div>
                //             <div>
                //                 // <input type="checkbox" name="help" value="done" onchange="submit();"">IT\'s Done ! Thank you !
                //             </div>    
                //         </div>
                        
                //         <div class="team-budget">
                //             <span>Budget</span>
                //             <div>
                //                 <input type="checkbox" name="budget" value="2000" onchange="submit();"> From to 2000 €
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="budget" value="6000" onchange="submit();"> From to 6000 €
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="budget" value="10000" onchange="submit();"> From to 10 000 €
                //             </div>
                //         </div>

                // </form>
                // <div class="show-for-large-up sidebar-sort medium-3 columns">
                //     <h2>Search and sort</h2>
                //     <form class="search-bar" method="post" action="<?php echo MODULE . 'event' . ACTION . 'seeoneevent'; ? >">
                //         <input type="text" size="21" name="search">
                        
                //         <div class="team-progress">
                //             <span>Team Progress</span>
                //             <div>
                //                 <input type="checkbox" name="help" value="need" onchange="submit();"> Help them, they need you !
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="help" value="almost" onchange="submit();"> Just a little bit of help !
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="help" value="done" onchange="submit();"> It\'s Done ! Thank you !
                //             </div>    
                //         </div>
                        
                //         <div class="team-budget">
                //             <span>Budget</span>
                //             <div>
                //                 <input type="checkbox" name="budget" value="2000" onchange="submit();"> From 0 € to 2000 €
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="budget" value="6000" onchange="submit();"> From 2000 € to 6000 €
                //             </div>
                //             <div>
                //                 <input type="checkbox" name="budget" value="10000" onchange="submit();"> From 6000 € to 10 000 €
                //             </div>
                //         </div>
                        
                //     </form>
                // </div>'; ?>
                <div class="teams large-9 medium-12 clearfix columns">

                    <?php if(isset($done[0]['group_id']) && !empty($data['done'][0]['group_id']) ){ ?>
                        <?php $i = 1;
                        foreach ($done as $key => $done) { ?>
                        <div class="team-wrapper columns medium-4">
	                        <div class="wrapper done">
	                            <div class="img" style="background:url('<?php echo PROJECT . $done['group_img']; ?>'); background-position: top left;background-size: cover;">
	                                <div class="hover done">
	                                    <span>It's done thank you !</span>
	                                </div>

	                            </div>
	                            <div class="title-team"><?php echo $done['group_name']; ?></div>
	                            <div class="date">Created on <?php echo formDate($done['group_date'], 2); ?></div>
	                            <div class="progressteam">
	                                <span class="validate"></span>
	                                <div class="number"><span>100 %</span><br>goal reached !</div>
	                                <div class="progress-team-done good"></div>
	                            </div>
	                        </div>
	                    </div>
                        <?php $i ++; } ?>
                    <?php } ?>
                    <?php if(!empty($groups[0]['group_id'])){ ?>
                        <?php $i = 1;
                        foreach ($groups as $key => $g) { ?>
                            <div class="team-wrapper columns medium-4">
                                <div class="wrapper">
                                    <div class="img" style="background:url('<?php echo PROJECT . $g['group_img']; ?>'); background-position: top left;background-size: cover;">
                                        <a href="<?php echo MODULE . 'project' . ACTION . 'seeoneproject' . ID . $g['group_id']; ?>" alt="" title="" >
                                            <!-- <img src="img/group/<?php echo $g['group_img']; ?>" alt=""> -->
                                            <div class="hover">
                                                <span>They need you<br>help them</span>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="title-team"><?php echo $g['group_name']; ?></div>
                                    <div class="date">Created on <?php echo formDate($g['group_date'], 2); ?></div>
                                    <div class="progressteam">
                                        <div class="clearfix">
                                            <div class="columns medium-4 small-4 numbers"><span><?php echo $g['group_money']; ?> €</span><br>goals</div>
                                            <div class="columns medium-4 small-4 funded"><span><?php  echo number_format(($g['group_needed'] / $g['group_money']) *100, 0); ?>  %</span><br>funded</div>
                                            <div class="columns medium-4 small-4 daysleft">
                                                <span>
                                                    <?php $diff = (new DateTime('now'))->diff(new DateTime($event['event_end'])); ?>
                                                    <?php echo $diff->format('%a'); //%a take the lot Y-m-d ?>
                                                </span>
                                                <br>days left</div>
                                        </div>
                                        <?php  $percent = number_format(($g['group_needed'] / $g['group_money']) *100, 0); ?>
                                        <div <?php echo $i; ?> data="<?php echo $percent; ?>" class="progress-team notyet"></div>
                                    </div>
                                </div>
                            </div>
                        <?php $i ++; } ?>
                    <?php } ?> 
                </div>
            </div>
            
                <div class="medium-12 pagination">
                    <?php 
                        /* * * * * * * * * * * * * * * * * * * * * * * * *
                        * PAGINATION
                        */
                        if(!empty($count)){
                            $limit = ceil($count / LIMIT);
                            for ($i=1; $i <= $limit; $i++) { 
                                if($_GET['page'] == $i){ ?>
                                <a class="select" href="<?php echo MODULE . 'event' . ACTION . 'seeevent' . PAGE . $i; ?>" title="" alt="" ><?php echo $i; ?></a>
                            <?php } else { ?>
                                <a href="<?php echo MODULE . 'event' . ACTION . 'seeevent' . PAGE . $i; ?>" title="" alt="" ><?php echo $i; ?></a>
                            <?php }
                            }
                        } 
                    ?>
                </div>

        </div>


<?php include(ROOT . "view/layout/footer.inc.php"); ?>