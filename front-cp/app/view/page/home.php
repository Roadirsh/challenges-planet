<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ ?>
    <div class="message <?php echo $_SESSION['messtype']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php } $_SESSION['message'] = null; ?>

<?php include(ROOT . "view/layout/header.inc.php"); ?>

<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){ $message = $_SESSION['message']; }?>
<?php if(isset($data['slider']) && !empty($data['slider']) ){ $slider = $data['slider']; } ?>
<?php if(isset($data['group']) && !empty($data['group']) ){ $team = $data['group']; } ?>
<?php if(isset($data['done'][0]) && !empty($data['done'][0]) ){ $done = $data['done'][0]; } ?>
<?php if(isset($data['sponsor']) && !empty($data['sponsor']) ){ $sponsor = $data['sponsor']; } ?>

    <div class="slider">
        <?php $i = 0; ?>
        <?php if(isset($data['slider']) && !empty($data['slider']) ){ ?>
            <?php foreach($slider as $k => $s){ ?>
            <a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $s['event_id']; ?>" onClick="ga('send', 'event', 'link','clic', 'see-eventv3');">
            	<div class="img-slider " index='<?php echo $i; ?>'>
            		<img src="<?php echo EVENT . 'slider/' . $s['event_img']; ?>" alt="">
            		<div class="show-for-small-only caption clearfix">
            			<span><?php echo $s['event_name']; ?></span>
            		</div>
            		<div class="show-for-medium-up slogan-title-event">
            			<h1 class="slogan"><?php echo JOIN ?></h1>
            			<h3><?php echo $s['event_name']; ?></h3>
            			<p><?php echo mb_strimwidth($s['event_decr'], 0, 300, "..."); ?></p>
            			<a href="<?php echo MODULE . 'event' . ACTION . 'seeoneevent' . ID . $s['event_id']; ?>" onClick="ga('send', 'event', 'link','clic', 'see-eventv3');">
            			    <span class="see-event">Let's see the event !</span>
            		</div>
            	</div>
        	<?php $i ++; ?>
            </a>
        	<?php } ?> 
        <?php } ?> 	
    </div>



<h1 class="show-for-small-only slogan"><span>Join </span>the best caritives student challenges</h1>

    <div class="global-content clearfix">
    
		<!-- <a href="<?php //echo MODULE . 'project' . ACTION . 'seeproject'; ?>" onClick="ga('send', 'event', 'link','clic', 'teamv3');">  -->
        <div class="teams clearfix">
		    <h2>Our teams</h2>
    		<section class="first clearfix">
    		    <?php //var_dump($team); ?>
                <?php if(isset($data['group']) && !empty($data['group']) ){ ?>
        		    <?php foreach($team as $k => $t){ ?>
                    <div class="columns large-3 medium-4 team-wrapper">
        				<div class="wrapper">
        					<div class="img">
        						<img src="<?php echo PROJECT . $t['group_img']; ?>" alt="">
        						<div class="hover"><span>They need you<br>help them</span></div>
        					</div>
        					<div class="title-team"><a href="<?php echo MODULE . 'event' . ACTION . 'seeoneproject' . ID . $t['group_id']; ?>" alt="" title=""><?php echo $t['group_name']; ?></a></div>
        					<div class="date"><?php echo $t['event_name']; ?></div>
        					<div class="progressteam">
        						<div class="clearfix">
                                    <div class="columns medium-4 small-4 numbers">
                                        <span><?php echo $t[0]['group_money']; ?> €</span>
                                        <br>goals
                                    </div>
                                    <div class="columns medium-4 small-4 funded">

                                        <span><?php  echo number_format(($t[1]['needed'] / $t[0]['group_money']) *100, 0); ?>  %</span>
                                        </br>funded
                                    </div>
        							<div class="columns medium-4 small-4 daysleft">
        							    <span>
                                            <?php $diff = (new DateTime('now'))->diff(new DateTime($t['event_end'])); ?>
                                            <?php echo $diff->format('%a'); //%a take the lot Y-m-d ?>
        							    </span>
                                        <br>  <!-- Days left -->
                                            DAYS LEFT
                                    </div>
        						</div>
                                <?php $percent = number_format(($t[1]['needed'] / $t[0]['group_money']) *100, 0);?>
        						<div class="progress-team notyet" data-percent="<?php echo $percent; ?>"></div>
        					</div>
        				</div>
        			</div>
        			<?php $i ++; ?>
        			<?php } ?>
                <?php } ?>
                <?php if(isset($data['done'][0]) && !empty($data['done'][0]) ){ ?>
    			<div class="columns large-3 medium-4 team-wrapper">
    				<div class="wrapper done">
    					<div class="img">
    						<img src="img/group/<?php echo $done['group_img']; ?>" alt="">
    						<div class="hover done"><span>It's done thank you !</span></div>
    					</div>
    					<div class="title-team"><?php echo $done['group_name']; ?></div>
    					<div class="date"><?php echo $done['event_name']; ?></div>
    					<div class="progressteam">
    						<span class="validate"></span>
    						<div class="number"><span>100 %</span><br>goal reached !</div>
    						<div class="progress-team-done good"></div>
    					</div>
    				</div>
    			</div>
    			<?php } ?>
            </section>

        </div>
    <!-- </a> -->

	<a href="<?php echo MODULE . 'sponsor' . ACTION . 'seesponsor'; ?>" onClick="ga('send', 'event', 'link','clic', 'sponsorsv3');">
		<div class="sponsors clearfix">
		<h2>Our sponsors</h2>
		<section class="first clearfix">
		    <?php if(isset($data['sponsor']) && !empty($data['sponsor']) ){ ?>
    		    <?php //var_dump($sponsor); ?>
    		    <?php foreach($sponsor as $k => $s){ ?>
    			<a href="<?php echo MODULE . 'sponsor' . ACTION . 'sponsoredevent' . ID . $s['user_id']; ?>">
                    <div class="medium-4 large-3 columns sponsor-wrapper">
        				<div class="wrapper">
                            <div class="img">
                                <img src="img/avatar/<?php echo $s['user_profil_pic']; ?>" alt="">
                                <div class="hover">
                                    <span>They helped them !</span>
                                </div>
                            </div>
        					<!-- <a class="website" href="<?php echo $s['user_site']; ?>" target="blank">Go their website</a>
        					<a class="help sponsored" href="<?php echo MODULE . 'sponsor' . ACTION . 'sponsoredevent' . ID . $s['user_id']; ?>">View events sponsored</a> -->
        				</div>
    			    </div>
    			<?php } ?>
            <?php } ?>
		</section>
		</div>
	</a>		
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
