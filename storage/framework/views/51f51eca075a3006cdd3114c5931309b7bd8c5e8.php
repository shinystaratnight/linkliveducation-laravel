<?php $aa = $_SERVER['REQUEST_URI']; ?>
<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidingbbr sidebar-content">
            <div class="side-header side-content bg-white-op">
                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times"></i>
                </button>
                <a class="h5 text-white" href="<?php echo e(URL::to('admin/dashboard')); ?>">
                    <span class="h4 font-w600 sidebar-mini-hide"><?php echo e(getcong('site_name')); ?></span>
                </a>
            </div>
            <div class="side-content">
                <ul class="nav-main">
                    <li class="hov-cl">
                        <a class="<?php echo e(classActivePath('dashboard')); ?>" href="<?php echo e(URL::to('admin/dashboard')); ?>">
                            <span class="side-add"><i class="si si-speedometer"></i>
                            </span>
                            <span class="sidebar-mini-hide side-add2">Dashboard</span>
                        </a>
                    </li>
                    <li class="hov-cl <?php if ($aa == '/admin/users') {
    echo 'open';
} ?>">
                        <a class="<?php echo e(classActivePath('users')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-users"></i></span>
                            <span class="sidebar-mini-hide side-add2">Users</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a  href="<?php echo e(URL::to('admin/users')); ?>" ><i class="fa fa-users"></i>All Users</a></li>
                        </ul>
                    </li>
                    <!----------- Course Categories Start ----------------->
                    <li class="hov-cl <?php if ($aa == '/admin/pages/course_category' || $aa == '/admin/pages/add_course_category') {
    echo 'open';
} ?>">
                        <a class="<?php echo e(classActivePath('Course Categories')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Course Categories </span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('add_course_category')); ?>" href="<?php echo e(URL::to('admin/pages/add_course_category')); ?>" ><i class="fa fa-users"></i>Add New Category</a></li>
                            <li><a  href="<?php echo e(URL::to('admin/pages/course_category')); ?>" ><i class="fa fa-users"></i>All Categories</a></li>
                        </ul>
                    </li>
                    <li class="hov-cl <?php if ($aa == '/admin/pages/add_course_subcategory' || $aa == '/admin/pages/course_subcategory') {
    echo 'open';
} ?>">
                        <a class="<?php echo e(classActivePath('Course Subcategories')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Course SubCategories</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('course_subcategory')); ?>" href="<?php echo e(URL::to('admin/pages/add_course_subcategory')); ?>" ><i class="fa fa-users"></i>Add New Subcategory</a></li>
                            <li><a  href="<?php echo e(URL::to('admin/pages/course_subcategory')); ?>" ><i class="fa fa-users"></i>All SubCategories</a></li>
                        </ul>
                    </li>
                    <!----------- Course Categories End ----------------->
                    <!----------- Test Categories Start ----------------->
                    <li class="hov-cl <?php if ($aa == '/admin/pages/test_category' || $aa == '/admin/pages/add_test_category') {
    echo 'open';
} ?>">
                        <a class="<?php echo e(classActivePath('Test Categories')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Test Categories </span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('add_test_category')); ?>" href="<?php echo e(URL::to('admin/pages/add_test_category')); ?>" ><i class="fa fa-users"></i>Add New Category</a></li>
                            <li><a  href="<?php echo e(URL::to('admin/pages/test_category')); ?>" ><i class="fa fa-users"></i>All Categories</a></li>
                        </ul>
                    </li>
                    
                    
                    <li class="hov-cl <?php if ($aa == '/admin/pages/add_test_subcategory' || $aa == '/admin/pages/test_subcategory') {
    echo 'open';
} ?>">
                        <a class="<?php echo e(classActivePath('Test Subcategories')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Test SubCategories</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('test_subcategory')); ?>" href="<?php echo e(URL::to('admin/pages/add_test_subcategory')); ?>" ><i class="fa fa-users"></i>Add New Subcategory</a></li>
                            <li><a  href="<?php echo e(URL::to('admin/pages/test_subcategory')); ?>" ><i class="fa fa-users"></i>All SubCategories</a></li>
                        </ul>
                    </li>
                    <!----------- Test Categories End ----------------->
                    <!----------- Test Create Start ----------------->

                    <li class="hov-cl <?php if ($aa == '/admin/pages/add_test_subcategory' || $aa == '/admin/pages/test_subcategory') {
                        echo 'open';
                    } ?>">
                        <a class="<?php echo e(classActivePath('Test Subcategories')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Tests</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('test_subcategory')); ?>" href="<?php echo e(URL::to('admin/test/create')); ?>" ><i class="fa fa-users"></i>Add New Test</a></li>
                            <li><a  href="<?php echo e(URL::to('admin/tests')); ?>" ><i class="fa fa-users"></i>All Tests</a></li>
                        </ul>
                    </li>
                    
                    <li class="hov-cl">
                        <a href="<?php echo e(URL::to('admin/results')); ?>">
                            <span class="side-add">   <i class="fa fa-file"></i></span>
                            <span class="sidebar-mini-hide side-add2">Results</span>
                        </a>
                    </li>
                    <!----------- Test Create End ----------------->
                    <!-----------add video start----------------------->
                    <li class="hov-cl">
                        <a class="<?php echo e(classActivePath('video')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">Course Video</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('video')); ?>" href="<?php echo e(URL::to('admin/pages/video')); ?>" ><i class="fa fa-users"></i> Add video</a></li>
                            <li><a class="<?php echo e(classActivePath('allvideos')); ?>" href="<?php echo e(URL::to('admin/pages/allvideos')); ?>" ><i class="fa fa-users"></i> All videos</a></li>
                        </ul>
                    </li>
                    <!-----------add video end----------------------->
                    <!-----------add video start----------------------->
                    <li class="hov-cl">
                        <a class="<?php echo e(classActivePath('vlog')); ?> nav-submenu" href="javascript:void(0);" data-toggle="nav-submenu" >
                            <span class="side-add"><i class="fa fa-file-video-o"></i></span>
                            <span class="sidebar-mini-hide side-add2">VLog</span>
                        </a>
                        <ul class="sub-menu-de">
                            <li><a class="<?php echo e(classActivePath('vlog')); ?>" href="<?php echo e(URL::to('admin/vlog')); ?>" ><i class="fa fa-users"></i> Add VLog</a></li>
                            <li><a class="<?php echo e(classActivePath('allvlog')); ?>" href="<?php echo e(URL::to('admin/allvlog')); ?>" ><i class="fa fa-users"></i> All VLog</a></li>
                        </ul>
                    </li>
                    <!-----------add video end----------------------->
                    <li class="hov-cl">
                        <a class="<?php echo e(classActivePath('orders')); ?>" href="<?php echo e(URL::to('admin/orders')); ?>">
                            <span class="side-add">   <i class="fa fa-cog"></i></span>
                            <span class="sidebar-mini-hide side-add2">Orders</span>
                        </a>
                    </li>
                    <li class="hov-cl">
                        <a class="<?php echo e(classActivePath('settings')); ?>" href="<?php echo e(URL::to('admin/settings')); ?>">
                            <span class="side-add">   <i class="fa fa-cog"></i></span>
                            <span class="sidebar-mini-hide side-add2">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav><?php /**PATH /home/scholer1/public_html/resources/views/admin/sidebar.blade.php ENDPATH**/ ?>