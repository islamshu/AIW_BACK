<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu"
    data-col="2-columns">
    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" target="_blank" href="<?php echo e(route('dashboard')); ?>">
                            
                            <h3 class="brand-text"><?php echo e(get_general_value('website_name_'. app()->getLocale())); ?></h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                      
                       
                     
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <span class="mr-1"><?php echo e(__('مرحبا')); ?>,
                                    <span class="user-name text-bold-700"><?php echo e(auth()->user()->firstName); ?></span>
                                </span>
                                <span class="avatar avatar-online profile-image">
                                    <img src="<?php echo e(asset('backend/user.png')); ?>"
                                        alt="avatar" ><i></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="<?php echo e(route('edit_profile')); ?>" ><i
                                        class="ft-user"></i> <?php echo e(__('الملف الشخصي')); ?></a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><i
                                        class="ft-power"></i> <?php echo e(__('تسجيل خروج')); ?></a>
                            </div>
                        </li>
                        
                        <li class="dropdown dropdown-language nav-item">
    <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-bs-toggle="dropdown">
        <?php if(app()->getLocale() == 'ar'): ?>
            <span class="fi fi-sa me-1"></span>
            <span class="selected-language">العربية</span>
        <?php else: ?>
            <span class="fi fi-us me-1"></span>
            <span class="selected-language">English</span>
        <?php endif; ?>
    </a>

    <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item d-flex align-items-center gap-2"
           href="<?php echo e(route('language.switch', 'ar')); ?>">
            <span class="fi fi-sa"></span>
            العربية
        </a>

        <a class="dropdown-item d-flex align-items-center gap-2"
           href="<?php echo e(route('language.switch', 'en')); ?>">
            <span class="fi fi-us"></span>
            English
        </a>
    </div>
</li>

                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                <i class="ficon ft-bell"></i>
                                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                             
                                <li class="scrollable-container media-list w-100">
                                    <!-- سيتم إضافة الإشعارات هنا عبر JavaScript -->
                                </li>
                               
                            </ul>
                        </li>
                        
                      
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/inc/nav.blade.php ENDPATH**/ ?>