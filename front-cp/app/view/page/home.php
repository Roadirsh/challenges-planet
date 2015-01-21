<? include(ROOT . "view/layout/header.inc.php"); ?>
<? if(isset($data['slider']) && !empty($data['slider']) ){ $slider = $data['slider']; } ?>
<? if(isset($data['group']) && !empty($data['group']) ){ $team = $data['group']; } ?>
<? if(isset($data['done'][0]) && !empty($data['done'][0]) ){ $done = $data['done'][0]; } ?>
<? if(isset($data['sponsor']) && !empty($data['sponsor']) ){ $sponsor = $data['sponsor']; } ?>
<? //var_dump($done); ?>
<div class="slider">
    <? $i = 0; ?>
    <? if(isset($data['slider']) && !empty($data['slider']) ){ ?>
        <? foreach($slider as $k => $s){ ?>
        	<div class="img-slider " index='<? echo $i; ?>'>
        		<img src="img/event/<? echo $s['event_img']; ?>" alt="">
        		<div class="show-for-small-only caption clearfix">
        			<span><? echo $s['event_name']; ?></span>
        		</div>
        		<div class="show-for-medium-up slogan-title-event">
        			<h1 class="slogan"><? echo JOIN ?></h1>
        			<h3><? echo $s['event_name']; ?></h3>
        			<p><? echo mb_strimwidth($s['event_decr'], 0, 300, "..."); ?></p>
        			<a href="<? echo MODULE . 'event' . ACTION . 'seeoneevent'; ?>" onClick="ga('send', 'event', 'link','clic', 'see-eventv3');">
        			    <span class="see-event">Let's see the event !</span></a>
        		</div>
        	</div>
    	<? $i ++; ?>
    	<? } ?> 
    <? } ?> 	
</div>


<h1 class="show-for-small-only slogan"><span>Join </span>the best caritives student challenges</h1>

    <div class="global-content clearfix">
    
    	<div class="services show-for-small-only">
    		<h2>Our services</h2>
    		<img src="img/ourservice.png" alt="">
    		<h3>Join your forces yourself for a better planet</h3>
    		<p>Our platform has been designed to link businesses and students on organising specific sports events.</p>
    
    		<p>All competitions are organised to support sustainable development initiatives and proceeds of those sporting events will be forwarded to charities</p>
    	</div>
		<a href="<? echo MODULE . 'project' . ACTION . 'seeproject'; ?>" onClick="ga('send', 'event', 'link','clic', 'teamv3');"> 
		<div class="teams clearfix">
		    <h2>Our teams</h2>
    		<section class="first clearfix">
    		    <? //var_dump($team); ?>
                <? if(isset($data['group']) && !empty($data['group']) ){ ?>
        		    <? foreach($team as $k => $t){ ?>
                    <div class="columns large-3 medium-4">
        				<div class="wrapper">
        					<div class="img">
        						<img src="img/group/<? echo $t['group_img']; ?>" alt="">
        						<div class="hover"><span>They need you<br>help them</span></div>
        					</div>
        					<div class="title-team"><? echo $t['group_name']; ?></div>
        					<div class="date"><? echo $t['event_name']; ?></div>
        					<div class="progressteam">
        						<div class="clearfix">
        							<div class="numbers"><span><? echo $t[0]['count']; ?></span><br>supporters</div>
        							<div class="daysleft">
        							    <span>
        							        <? echo (date("Y-m-d")-strtotime($t['event_end'])); ?>
                                            <? //echo ($t[0]['group_money']-$t[1]['needed']); ?> 
        							    </span>
                                        <br><? //echo $t[0]['group_money']; ?>  <!-- Days left -->
                                            DAYS LEFT
                                    </div>
        						</div>
                                <? $percent = ($t[1]['needed'] / $t[0]['group_money']) *100;?>
        						<div id="progressteam<? echo $i; ?>" class="notyet" data="<? echo $percent; ?>"></div>
        					</div>
        				</div>
        			</div>
        			<? $i ++; ?>
        			<? } ?>
                <? } ?>
                <? if(isset($data['done'][0]) && !empty($data['done'][0]) ){ ?>
    			<div class="columns large-3 medium-4">
    				<div class="wrapper done">
    					<div class="img">
    						<img src="img/group/<? echo $done['group_img']; ?>" alt="">
    						<div class="hover done"><span>It's done thank you !</span></div>
    					</div>
    					<div class="title-team"><? echo $done['group_name']; ?></div>
    					<div class="date"><? echo $done['event_name']; ?></div>
    					<div class="progressteam">
    						<span class="validate"></span>
    						<div class="number"><span>50</span><br>supporters</div>
    						<div id="progressteam1" class="good"></div>
    					</div>
    				</div>
    			</div>
    			<? } ?>
            </section>

        </div>
    </a>

	<div class="services show-for-medium-up">
		<h2>Our services</h2>
		<img src="img/ourservice.png" alt="">
		<h3>Join your forces for a better planet</h3>
		<p>Our platform has been designed to link businesses and students on organising specific sports events.</p>

		<p>All competitions are organised to support sustainable development initiatives and proceeds of those sporting events will be forwarded to charities</p>
	</div>
	<a href="<? echo MODULE . 'sponsor' . ACTION . 'seesponsor'; ?>" onClick="ga('send', 'event', 'link','clic', 'sponsorsv3');">
		<div class="sponsors clearfix">
		<h2>Our sponsors</h2>
		<section class="first">
		    <? if(isset($data['sponsor']) && !empty($data['sponsor']) ){ ?>
    		    <? //var_dump($sponsor); ?>
    		    <? foreach($sponsor as $k => $s){ ?>
    			<div class="medium-4 large-3 columns">
    				<div class="wrapper">
    					<img src="img/avatar/<? echo $s['user_profil_pic']; ?>" alt="">
    					<a class="website" href="<? echo $s['user_site']; ?>" target="blank">Go their website</a>
    					<a class="sponsored" href="<? echo MODULE . 'sponsor' . ACTION . 'sponsoredevent' . ID . $s['user_id']; ?>">View events sponsored</a>
    				</div>
    			</div>
    			<? } ?>
            <? } ?>
		</section>
		</div>
	</a>		
</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>
