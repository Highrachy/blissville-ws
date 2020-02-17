    <aside class="left-panel">
            
            <div class="user text-center">
                  <img src="<?php URL::display('assets/img/profile/user1.jpg') ?>" class="img-circle img-responsive img-thumbnail" alt="User Image"><br>
                  <strong class="user-name"><?php echo ' '.Session::get('name'); ?></strong>
  
            </div>
            
            
            
            <nav class="navigation">
                <ul class="list-unstyled">

                    <li><a href="<?php URL::display('admin') ?>"><i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span></a></li>

                    <li><a href="<?php URL::display('admin/edit-content') ?>"><i class="fa fa-edit"></i> <span class="nav-label">Edit Contents</span></a></li>

                   <!--  <li class="has-submenu"><a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Edit Contents</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('admin/edit-content') ?>"><i class="fa fa-angle-right"></i> All Pages</a></li>
                            <li><a href="<?php URL::display('contacts/new.php') ?>"><i class="fa fa-angle-right"></i> Home</a></li>
                            <li><a href="<?php URL::display('contacts/bulk-email.php') ?>"><i class="fa fa-angle-right"></i> About Us</a></li>
                        </ul>
                    </li> -->

                    <!-- <li class="has-submenu"><a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Articles</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('campaigns') ?>"><i class="fa fa-angle-right"></i> All Articles</a></li>
                            <li><a href="<?php URL::display('campaigns/new.php') ?>"><i class="fa fa-angle-right"></i> New Article</a></li>
                        </ul>
                    </li> -->

                    <li class="has-submenu"><a href="#"><i class="fa fa-image"></i> <span class="nav-label">Slideshows</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('admin/slideshow') ?>"><i class="fa fa-angle-right"></i> All Slideshows</a></li>
                            <li><a href="<?php URL::display('admin/slideshow/new.php') ?>"><i class="fa fa-angle-right"></i> New Slideshow</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="fa fa-legal"></i> <span class="nav-label">Properties</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('admin/property/') ?>"><i class="fa fa-angle-right"></i> All Properties</a></li>
                            <li><a href="<?php URL::display('admin/property/new.php') ?>"><i class="fa fa-angle-right"></i> New Property</a></li>
                        </ul>
                    </li>
                   <!--  <li class="has-submenu"><a href="#"><i class="fa fa-bullhorn"></i> <span class="nav-label">FAQs</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('templates') ?>"><i class="fa fa-angle-right"></i> All FAQs</a></li>
                            <li><a href="<?php URL::display('templates/new.php') ?>"><i class="fa fa-angle-right"></i> New FAQs</a></li>
                        </ul>
                    </li> -->
<!-- 
                    <li><a href="<?php URL::display('users/logout.php') ?>"><i class="fa fa-map-marker"></i><span class="nav-label">Contact Info</span></a></li>

                    <li class="has-submenu"><a href="#"><i class="fa fa-user"></i> <span class="nav-label">Edit Profile</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php URL::display('templates') ?>"><i class="fa fa-angle-right"></i> Edit Contact Info</a></li>
                            <li><a href="<?php URL::display('templates/new.php') ?>"><i class="fa fa-angle-right"></i> Change Password</a></li>
                        </ul>
                    </li> -->

                    <li><a href="<?php URL::display('admin/users/logout.php') ?>"><i class="fa fa-sign-out"></i><span class="nav-label">Logout</span></a></li>
                   
                </ul>
            </nav>
            
    </aside>

                    