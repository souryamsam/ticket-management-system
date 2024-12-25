<?php
if (session()->has('user_info') && session()->has('dashboard_manu_data')) {
    $user = session()->get('user_info');
    $dashboard_data = session()->get('dashboard_manu_data');
    $menu_data=$dashboard_data[0];
    $page_data = $dashboard_data[1];
} else {
    echo 'Session Not Exit';
}
?>
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <div id="kt_app_header" class="app-header" data-kt-sticky="true"
            style="background-image:url('<?= base_url("public/assets/media/patterns/pattern-1.jpg") ?>');background-repeat:no-repeat;background-position:center top;background-size: 100% 250px"
            data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize"
            data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">

            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                id="kt_app_header_container">

                <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="index.html" class="d-lg-none">
                        <img alt="Logo" src="<?= base_url("public/assets/media/logos/default-small.svg") ?>"
                            class="h-30px" />
                    </a>
                </div>
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                    id="kt_app_header_wrapper" style="justify-content: end;">
                    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                        data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                        data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                        data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                        data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                        data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                            id="kt_app_header_menu" data-kt-menu="true">
                            <?php
                            if(!empty($menu_data)){
                                foreach($menu_data as $mrow){
                                    ?>
                                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-0 me-lg-2" id="pages-menu">
                                            <span class="menu-link">
                                                <span class="menu-title text-white"><i
                                                        class="bi <?=$mrow['MENU_ICON']?> text-white fs-8"></i>&nbsp;&nbsp;<?=$mrow['MENU_NAME']?></span>
                                                <span class="menu-arrow d-lg-none"></span>
                                            </span>
                                            <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0">
                                                <div class="menu-active-bg px-4 px-lg-0">
                                                    <div class="d-flex w-100 overflow-auto">
                                                        <ul
                                                            class="nav nav-stretch nav-line-tabs fw-bold fs-6 p-0 p-lg-10 flex-nowrap flex-grow-1">
                                                            <li class="nav-item mx-lg-1">
                                                                <a class="nav-link py-3 py-lg-6 text-active-primary" href="#"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#kt_app_header_menu_pages_account"><?=$mrow['MENU_NAME']?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tab-content py-4 py-lg-8 px-lg-7">
                                                        <div class="tab-pane active w-lg-500px"
                                                            id="kt_app_header_menu_pages_account">
                                                            <div class="row">
                                                                <div class="col-lg-12 mb-6 mb-lg-0">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <?php
                                                                            if (!empty($page_data)) {
                                                                                foreach ($page_data as $i => $prow) {
                                                                                    if ($prow['MENU_ID'] == $mrow['MENU_ID']) {
                                                                                    ?>
                                                                                        <div class="menu-item p-0 m-0">
                                                                                            <a href="<?=base_url($prow['PAGE_NAME'])?>" class="menu-link">
                                                                                                <span class="menu-title"><?=$prow['PAGE_APP_NAME']?></span>
                                                                                            </a>
                                                                                        </div>
                                                                                <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="app-navbar flex-shrink-0">
                        <div class="app-navbar-item ms-1 ms-md-4">
                            <h4 class="mt-2 text-white"><i class="bi bi-people-fill text-white fs-3"></i>&nbsp;
                                Welcome, <?= $user['E_NAME']; ?></h4>
                        </div>

                        <div class="app-navbar-item ms-1 ms-md-4">
                            <a href="#"
                                class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
                                data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                    <span class="path9"></span>
                                    <span class="path10"></span>
                                </i>
                                <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">

                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-night-day fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-moon fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-duotone ki-screen fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">System</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                            <div class="cursor-pointer symbol symbol-35px"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end">
                                <img src="<?= base_url("public/assets/media/avatars/300-9.jpg") ?>" class="rounded-3"
                                    alt="user" />
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-200px"
                                data-kt-menu="true">

                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">My Profile</a>
                                </div>
                                <div class="menu-item px-5">
                                    <a href="<?= base_url('/sign-out'); ?>" class="menu-link px-5">Logout</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1
                                    class="page-heading text-white d-flex fw-bold fs-3 flex-column justify-content-center my-0">
                                    <?= $title ?? $title ?>
                                </h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="<?= base_url() ?>" class="text-muted text-hover-primary">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted"><?= $title ?? $title ?></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <?= view($app_content) ?>
                    </div>
                    <div id="kt_app_footer" class="app-footer" style="border-top: 1px solid rgba(92, 89, 89, 0.155);">
                        <div
                            class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">Copyright - <?= date("Y") ?> | </span>
                                <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Cludo Technology
                                    Consultants LLP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
</div>