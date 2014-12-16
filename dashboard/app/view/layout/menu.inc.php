<div class="container-fluid-full">
    <div class="row-fluid">
    <!-- start: Main Menu-->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li>
                        <a href="<? echo MODULE . 'page' . ACTION . 'home'; ?>"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a>
                        <ul>
                            <li><a class="submenu" href="<? echo MODULE . 'user' . ACTION . 'seeuser'; ?>"><i class="icon-eye-open"></i><span class="hidden-tablet"><em> See all users</em></span></a></li>
                            <li><a class="submenu" href="<? echo MODULE . 'user' . ACTION . 'adduser'; ?>"><i class="icon-plus"></i><span class="hidden-tablet"><em> Add a users</em></span></a></li>
                        </ul>	
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-leaf"></i><span class="hidden-tablet"> Projects</span></a>
                        <ul>
                            <li><a class="submenu" href="<? echo MODULE . 'project' . ACTION . 'seeproject'; ?>"><i class="icon-eye-open"></i><span class="hidden-tablet"><em> See all project</em></span></a></li>
                            <li><a class="submenu" href="<? echo MODULE . 'project' . ACTION . 'addproject'; ?>"><i class="icon-plus"></i><span class="hidden-tablet"><em> Add a project</em></span></a></li>
                        </ul>	
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-dashboard"></i><span class="hidden-tablet"> Events</span></a>
                        <ul>
                            <li><a class="submenu" href="<? echo MODULE . 'event' . ACTION . 'seeevent'; ?>"><i class="icon-eye-open"></i><span class="hidden-tablet"><em> See all events</em></span></a></li>
                            <li><a class="submenu" href="<? echo MODULE . 'event' . ACTION . 'addevent'; ?>"><i class="icon-plus"></i><span class="hidden-tablet"><em> Add a event</em></span></a></li>
                        </ul>	
                    </li>
                    <li><a href='<? echo MODULE . 'page' . ACTION . 'team'; ?>'><i class="icon-beaker"></i><span class="hidden-tablet"> Team</span></a></li>
                </ul>
            </div>
        </div>
<!--end: Main Menu -->
