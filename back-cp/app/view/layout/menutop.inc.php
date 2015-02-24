<?php  include(ROOT . "conf/conf_url.php"); ?>
           <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php  echo MODULE . 'page' . ACTION . 'home'; ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Challenges PLANET
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                                               <li>
                            <a href="<?php  echo $url['online']; ?>" target="blank" >
                                Online Challenges Planet
                            </a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php  echo $_SESSION['user']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php  echo AVATAR . $_SESSION['userPic']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php  echo $_SESSION['user']; ?> <?php  echo $_SESSION['userF']; ?>
                                        <small>Member since <?php  echo date('D j F Y', strtotime($_SESSION['userDate']) ); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php  echo MODULE . 'user' . ACTION . 'seeoneadmin' . ID . $_SESSION['userID']; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php  echo MODULE . 'log' . ACTION . 'logout'; ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>