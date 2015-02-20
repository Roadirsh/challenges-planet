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
                <h1>My profil</h1>

                <div class="medium-3 columns">
                    <div id="circle"><img src="img/team4.jpg" alt="photo-profil" title="photo-profil"/></div>
                </div>

                <div class="medium-5 columns">
                    <h3>Shat Shatounet</h3>
                    <p>22 years old</p>
                </div>

                <div class="medium-4 columns school-profil">
                    <h3>School</h3>
                    <p>EEMI</p>
                </div>

                <p id="location"><img src="img/location.svg" alt="location" title="location"/>Paris</p>

            </div>

            <div class="medium-9 columns right general-profil">
                <h2>My descritpion</h2>
                <p>Hi, my name is Shat Shatounet and I am a current member of the French web team. My highest accelade to date is a silver Cat at the European Championships cats and hope to build on this with your help. </p>
                <a class="modif" href="#">Edit information</a>
            </div>
        </div>

        <div id="account">
            <div class="medium-9 columns right content-profil clearfix">
                <h1>My account</h1> 
            </div>

            <div class="medium-9 columns right general-profil">
                <div class="medium-3 columns first-info"><p>Mail adress<p></div>
                <div class="medium-5 columns second-info"><p>ShatShatounet@gmail.com</p></div>
                <div class="medium-4 columns third-info"><a class="modif" href="#">Edit</a></div>
            </div>

            <div class="medium-9 columns right general-profil">
                <div class="medium-3 columns first-info"><p>Password<p></div>
                <div class="medium-5 columns second-info"><p>**************</p></div>
                <div class="medium-4 columns third-info"><a class="modif" href="#">Edit</a></div>
            </div>
        </div>

       	<div id="project">
           	<div class="medium-9 columns right content-profil general-profil">
              	<h1>MY PORJECTS</h1>

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
            </div>
		</div>
	</div>

<?php include(ROOT . "view/layout/footer.inc.php"); ?>