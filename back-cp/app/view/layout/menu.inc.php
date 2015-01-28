        <!-- <div class="wrapper row-offcanvas row-offcanvas-left"> -->
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<? echo AVATAR . $_SESSION['userPic']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <? echo $_SESSION['userPseudo']; ?> !</p>
                        </div>
                    </div>
                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<? echo MODULE . 'user' . ACTION . 'seeuser'; ?>"><i class="fa fa-angle-double-right"></i> See users</a></li>
                                <li><a href="<? echo MODULE . 'user' . ACTION . 'adduser'; ?>"><i class="fa fa-angle-double-right"></i> Add user</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Projects</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<? echo MODULE . 'project' . ACTION . 'seeproject'; ?>"><i class="fa fa-angle-double-right"></i> See projects</a></li>
                                <li><a href="<? echo MODULE . 'project' . ACTION . 'addproject'; ?>"><i class="fa fa-angle-double-right"></i> Add project</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-leaf"></i>
                                <span>Events</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<? echo MODULE . 'event' . ACTION . 'seeevent'; ?>"><i class="fa fa-angle-double-right"></i> See events</a></li>
                                <li><a href="<? echo MODULE . 'event' . ACTION . 'addevent'; ?>"><i class="fa fa-angle-double-right"></i> Add event</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="<? echo MODULE . 'page' . ACTION . 'team'; ?>">
                                <i class="fa fa-cogs"></i> <span>Team</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>