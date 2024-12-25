<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ticket Management System</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="shortcut icon" href="<?= base_url("public/assets/media/auth/logo-corporate-5.png") ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <?= link_tag("public/assets/plugins/custom/datatables/datatables.bundle.css") ?>
    <?= link_tag("public/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css") ?>
    <?= link_tag("public/assets/plugins/global/plugins.bundle.css") ?>
    <?= link_tag("public/assets/css/style.bundle.css") ?>
    <?= link_tag("public/assets/js/toastr/jquery.toast.css") ?>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    style="background-image:url('<?= base_url("public/assets/media/patterns/pattern-1.jpg") ?>');background-repeat:no-repeat;background-position:center top;background-size: 100% 250px"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <form id="custom_form" method="post">
        <input type="hidden" name="custom_id" id="custom_id">
        <input type="hidden" name="mode" id="mode">
        <input type="hidden" name="ext_flag" id="ext_flag">
    </form>
    <!--begin::Theme mode setup on page load-->
    <script src="<?= base_url('public/assets/js/toastr/jquery.toast.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>