<?php include(ROOT . "view/layout/header.inc.php"); ?>
        <? echo '<h1>VAR_DUMP: All sponsors who allready gave a bit</h1>';
        var_dump($data['sponsors']); ?>

        <div class="list-sponsors">
        	<div class="medium-8 clearfix">
        		<h1>They helped them</h1>
        		<p></p>
	        	<a href="">
	        		<div class="medium-4 columns" >
	        			<div class="wrapper">
	        				<div class="img" style="background:url('img/img-4l-trophy-gesture.png'); background-position: center;background-size: cover;">
	        					<div class="hover">
	        						<span>See this sponsor</span>
	        					</div>
	        				</div>
	        				<span class="name-user">TAMER</span>
	        				<span class="number-team">Helped <span>6</span> teams</span>
	        		</div>
	        	</div>
	        	</a>
        	</div>
        </div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>